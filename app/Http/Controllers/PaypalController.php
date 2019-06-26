<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Mail;

use App\Invoice;
use App\InvoiceItem;
use App\Cart;
use App\User;
use App\Mail\CustomerInvoiceMail;
use App\Mail\WirelessShopInvoiceMail;

class PaypalController extends Controller
{
    protected $provider;

    public function __construct() {
        $this->provider = new ExpressCheckout();
    }

    public function expressCheckout(Request $request) {
        
        // check if payment is recurring
        $recurring = $request->input('recurring', false) ? true : false;
      
        // get new invoice id
        $invoice_id = Invoice::count() + 500;
        //dd($invoice_id);        
            
        // Get the cart data (paypal relevant)
        $cart = $this->getCart($recurring, $invoice_id);
        //dd($cart['invoice_id']);

        //$cart_items = $cart['items'];
        //dd($cart_items);
        // foreach($cart_items as $cart_item){  
        //     dd($cart_id);
        // }
      
        // send a request to paypal 
        // paypal should respond with an array of data
        // the array should contain a link to paypal's payment system        
        $response = $this->provider->setExpressCheckout($cart, $recurring);

        //dd($cart['invoice_id']);
        //dd($response);
        //dd(sizeof($cart['items']));
      
        // if there is no link redirect back with error message
        if (!$response['paypal_link']) {
          return redirect('/cart')->with(['code' => 'danger', 'message' => 'Something went wrong with PayPal Try Again']);
          // For the actual error message dump out $response and see what's in there
        }

        // create new order invoice
        $invoice = new Invoice();
        $invoice->title = $cart['invoice_description'];
        $invoice->total = $cart['total'];
        $invoice->user_id = Auth::user()->id;
        $invoice->handling_fee = $cart['handling'];
        $invoice->items_count = sizeof($cart['items']);
        $invoice->web_mobile = '1';
        $invoice->save();
        
        // create order invoice items
        
        // get other cart items details from db
        $cart = Cart::where('user_id',Auth::user()->id)->first();
        $cart_items = $cart->cart_items;
        
        foreach($cart_items as $cart_item) {
            $invoice_item = new InvoiceItem();
            $invoice_item->invoice_id = $invoice->id;
            $invoice_item->item_id = $cart_item['item_id'];
            $invoice_item->item_name = $cart_item['item_name'];
            $invoice_item->carrier_name = $cart_item['carrier_name'];
            $invoice_item->item_price = $cart_item['item_price'];
            $invoice_item->item_discount_check = $cart_item['item_discount_check'];
            $invoice_item->item_discount_percentage = $cart_item['item_discount_percentage'];
            $invoice_item->item_type = $cart_item['item_type'];
            $invoice_item->recharge_number = $cart_item['recharge_number'];
            $invoice_item->item_logo = $cart_item['item_logo'];
            //Save one to many relationship
            $invoice->invoice_items()->save($invoice_item); 
        }        

        //dd($response);
      
        // redirect to paypal
        // after payment is done paypal
        // will redirect us back to $this->expressCheckoutSuccess
        return redirect($response['paypal_link']);
    }

    private function getCart($recurring, $invoice_id) {   
        $items = array();
        $sub_total = 0;
        $handling_fee = 0;
        $total = 0;
        
        if ($recurring) {
            return [
                // if payment is recurring cart needs only one item
                // with name, price and quantity
                'items' => [
                    [
                        'name' => 'Monthly Subscription ' . config('paypal.invoice_prefix') . ' #' . $invoice_id,
                        'price' => 20,
                        'qty' => 1,
                    ],
                ],

                // return url is the url where PayPal returns after user confirmed the payment
                'return_url' => url('/paypal/express-checkout-success?recurring=1'),
                'subscription_desc' => 'Monthly Subscription ' . config('paypal.invoice_prefix') . ' #' . $invoice_id,
                // every invoice id must be unique, else you'll get an error from paypal
                'invoice_id' => config('paypal.invoice_prefix') . '_' . $invoice_id,
                'invoice_description' => "Order #". $invoice_id ." Invoice",
                'cancel_url' => url('/'),
                // total is calculated by multiplying price with quantity of all cart items and then adding them up
                // in this case total is 20 because price is 20 and quantity is 1
                'total' => 20, // Total price of the cart
            ];
        }

        //get cart details 
        $cart = Cart::where('user_id',Auth::user()->id)->first();
        
        if(!$cart){
            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->save();
        }
 
        $cart_items = $cart->cart_items; //the cart items object

        foreach ($cart_items as $cart_item) {

            //Item details array
            array_push($items, [
                'name' => $cart_item->item_name,
                'price' => $cart_item->item_price,
                'qty' => '1'
            ]);

            $sub_total += $cart_item->item_price * 1;
            //(add discount if needed)            
        }

        // Add handling fee
        $handling_fee_val = ((floatval($sub_total) * 0.034) + 0.30);										
        $handling_fee = number_format($handling_fee_val, 2, '.', '');	
        $total = $sub_total + $handling_fee;

        //Return data 
        return [
            // if payment is not recurring cart can have many items
            // with name, price and quantity
            // add items
            'items' => $items,
            // return url is the url where PayPal returns after user confirmed the payment
            'return_url' => url('/paypal/express-checkout-success'),
            // every invoice id must be unique, else you'll get an error from paypal
            'invoice_id' => config('paypal.invoice_prefix') . '_' . $invoice_id,
            //config('paypal.invoice_prefix') . '_' . $invoice_id,
            'invoice_description' => "RMP Order #" . $invoice_id . " Invoice",
            'cancel_url' => url('/cart'),
            'subtotal' => $sub_total,
            'handling' => $handling_fee,
            // total is calculated by multiplying price with quantity of all cart items and then adding them up also add the handling fee to the total
            'total' => $total
        ];

    }

    public function expressCheckoutSuccess(Request $request) {

        // check if payment is recurring
        $recurring = $request->input('recurring', false) ? true : false;

        $token = $request->get('token');

        $PayerID = $request->get('PayerID');

        //dd($request);

        // initaly paypal redirects us back with a token
        // but doesn't provice us any additional data
        // so we use getExpressCheckoutDetails($token)
        // to get the payment details
        $response = $this->provider->getExpressCheckoutDetails($token);
        //dd($response);

        // if response ACK value is not SUCCESS or SUCCESSWITHWARNING
        // we return back with error
        if (!in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            return redirect('/cart')->with(['code' => 'danger', 'message' => 'Error processing PayPal payment']);
        }

        // invoice id is stored in INVNUM
        // because we set our invoice to be xxxx_id
        // we need to explode the string and get the second element of array
        // witch will be the id of the invoice
        //dd($response['INVNUM']);
        $invoice_id = explode('_', $response['INVNUM'])[1];
        
        $paypal_email = $response['EMAIL'];
        $payment_date_time = $response['TIMESTAMP'];
        //dd($paypal_email);

        // get cart data
        $cart = $this->getCart($recurring, $invoice_id);

        //dd($cart);

        // check if our payment is recurring
        if ($recurring === true) {
            
            // if recurring then we need to create the subscription
            // you can create monthly or yearly subscriptions
            $response = $this->provider->createMonthlySubscription($response['TOKEN'], $response['AMT'], $cart['subscription_desc']);
            
            $status = 'Invalid';
            // if after creating the subscription paypal responds with activeprofile or pendingprofile
            // we are good to go and we can set the status to Processed, else status stays Invalid
            if (!empty($response['PROFILESTATUS']) && in_array($response['PROFILESTATUS'], ['ActiveProfile', 'PendingProfile'])) {
                $status = 'Processed';
            }

        } else {

            // if payment is not recurring just perform transaction on PayPal
            // and get the payment status
            $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);
            //dd($payment_status);
            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
            $transaction_id = $payment_status['PAYMENTINFO_0_TRANSACTIONID'];
            //dd($paypal_email);
        }
        //dd($status);
        // find invoice by id
        $invoice = Invoice::find($invoice_id);
        //$invoice = Invoice::find(60);
        //dd($invoice_id);

        // set invoice status and other fields
        $invoice->payment_status = $status; 
        $invoice->paypal_email = $paypal_email;     
        $invoice->transaction_id = $transaction_id; 
        $invoice->order_status = 'P5%'; 
        $invoice->active = '1';  

        // if payment is recurring lets set a recurring id for latter use
        if ($recurring === true) {
            $invoice->recurring_id = $response['PROFILEID'];
        }

        // save the invoice
        $invoice->save();

        //get invoice item details
        $items = array(); 
        $invoice_details = array();
        $sub_total = 0;
        $invoice_items = $invoice->invoice_items; //the invoice items object
        foreach ($invoice_items as $invoice_item) {
            //Item details array
            array_push($items, [
                'name' => $invoice_item->item_name,
                'price' => $invoice_item->item_price,
                'qty' => '1',
                'carrier_name' => $invoice_item->carrier_name,
                'recharge_number' => $invoice_item->recharge_number
            ]);

            $sub_total += $invoice_item->item_price * 1;
            //(add discount if needed)            
        }

        // Add handling fee
        $handling_fee_val = ((floatval($sub_total) * 0.034) + 0.30);										
        $handling_fee = number_format($handling_fee_val, 2, '.', '');	
        $total = $sub_total + $handling_fee;

        // customer details
        $customer_details = User::where('id', $invoice->user_id)->first();
        $customer_email = $customer_details->email;
        $customer_name = $customer_details->name;
        //dd($customer_details);
        //dd($customer_email);

        //Customer email array
        $invoice_details =  [
            'customer_email' => $customer_email,
            'items' => $items,
            'subtotal' => $sub_total,
            'handling' => $handling_fee,
            'total' => $total
        ];
        //dd($invoice_details['items']);

        //Wirelessshop email array
        $transaction_details =  [
            'customer_email' => $customer_email,
            'customer_name' => $customer_name,
            'paypal_email' => $paypal_email,
            'payment_date_time' => $payment_date_time,
            'items' => $items,
            'subtotal' => $sub_total,
            'handling' => $handling_fee,
            'transaction_id' => $transaction_id,
            'total' => $total,
            'paypal_method' => 'PDT'
        ];
        //dd($transaction_details);

        // App\Invoice has a paid attribute that returns true or false based on payment status
        // so if paid is false return with error, else return with success message
        if ($invoice->paid) {

            //send order email to customer
            Mail::to($customer_email)->send(new CustomerInvoiceMail($invoice_details));

            //send order email to wirelessshop
            Mail::send(new WirelessShopInvoiceMail($transaction_details));
            
            //Delete cart
            $cart = Cart::where('user_id',Auth::user()->id)->first();
            Cart::destroy($cart->id);

            return redirect('/cart')->with(['code' => 'success', 'message' => 'Order ' . $invoice->id . ' has been paid successfully!']);
        }
        
        return redirect('/cart')->with(['code' => 'danger', 'message' => 'Error processing PayPal payment for Order ' . $invoice->id . '!']);
    }

    public function notify(Request $request) {
        // STEP 1: read POST data
	    // Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
	    // Instead, read raw POST data from the input stream.
        $raw_post_data = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval) {
            $keyval = explode ('=', $keyval);
            if (count($keyval) == 2)
                $myPost[$keyval[0]] = urldecode($keyval[1]);
        }
	    // read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
        $req = 'cmd=_notify-validate';
        if (function_exists('get_magic_quotes_gpc')) {
            $get_magic_quotes_exists = true;
        }
        foreach ($myPost as $key => $value) {
            if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                $value = urlencode(stripslashes($value));
            } else {
                $value = urlencode($value);
            }
            $req .= "&$key=$value";
        }
	
        // Step 2: POST IPN data back to PayPal to validate
        $ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Expect:','Connection: Close'));
        // In wamp-like environments that do not come bundled with root authority certificates,
        // please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set
        // the directory path of the certificate as shown below:
        // curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
        if ( !($res = curl_exec($ch)) ) {
        // error_log("Got " . curl_error($ch) . " when processing IPN data");
            curl_close($ch);
            exit;
        }
        curl_close($ch);
	
	    // inspect IPN validation result and act accordingly
        if (strcmp ($res, "VERIFIED") == 0) {
        
            $logFile = 'ipn_log_'.Carbon::now()->format('Ymd_His').'.txt';
            Storage::disk('local')->put($logFile, print_r($_POST, true));
            
            // The IPN is verified, process it:
            // check whether the payment_status is Completed
            // check that txn_id has not been previously processed
            // check that receiver_email is your Primary PayPal email
            // check that payment_amount/payment_currency are correct
            // process the notification
            // assign posted variables to local variables
                        
            // IPN message values depend upon the type of notification sent.
            // To loop through the &_POST array and print the NV pairs to the screen:
			$invoice = Invoice::where('transaction_id', '=', $_POST['txn_id'])->first();
            $txn_id = $invoice->transaction_id;

            //if ($txn_id === null) {
                // transaction not saved to db save this record
                $invoice_id = explode('_', $_POST['invoice'])[1];
                $paypal_email = $_POST['payer_email'];
                $status = $_POST['payment_status'];
                $transaction_id = $_POST['txn_id'];
                $payment_date_time = $_POST['payment_date'];
                // find invoice by id
                $invoice = Invoice::find($invoice_id);
                // set invoice status and other fields
                $invoice->payment_status = $status; 
                $invoice->paypal_email = $paypal_email;     
                $invoice->transaction_id = $transaction_id; 
                $invoice->order_status = 'P5%'; 
                $invoice->active = '1';
                //save invoice
                $invoice->save();
                //get invoice item details
                $items = array(); 
                $invoice_details = array();
                $sub_total = 0;
                $invoice_items = $invoice->invoice_items; //the invoice items object
                foreach ($invoice_items as $invoice_item) {
                    //Item details array
                    array_push($items, [
                        'name' => $invoice_item->item_name,
                        'price' => $invoice_item->item_price,
                        'qty' => '1',
                        'carrier_name' => $invoice_item->carrier_name,
                        'recharge_number' => $invoice_item->recharge_number
                    ]);

                    $sub_total += $invoice_item->item_price * 1;
                    //(add discount if needed)            
                }
                // Add handling fee
                $handling_fee_val = ((floatval($sub_total) * 0.034) + 0.30);										
                $handling_fee = number_format($handling_fee_val, 2, '.', '');	
                $total = $sub_total + $handling_fee;
                // customer details
                $customer_details = User::where('id', $invoice->user_id)->first();
                $customer_email = $customer_details->email;
                $customer_name = $customer_details->name;
                //Customer email array
                $invoice_details =  [
                    'customer_email' => $customer_email,
                    'items' => $items,
                    'subtotal' => $sub_total,
                    'handling' => $handling_fee,
                    'total' => $total
                ];
                //Wirelessshop email array
                $transaction_details =  [
                    'customer_email' => $customer_email,
                    'customer_name' => $customer_name,
                    'paypal_email' => $paypal_email,
                    'payment_date_time' => $payment_date_time,
                    'items' => $items,
                    'subtotal' => $sub_total,
                    'handling' => $handling_fee,
                    'transaction_id' => $transaction_id,
                    'total' => $total,
                    'paypal_method' => 'IPN'
                ];
                // App\Invoice has a paid attribute that returns true or false based on payment status
                // so if paid is false return with error, else return with success message
                if ($invoice->paid) {
                    //send order email to customer
                    Mail::to($customer_email)->send(new CustomerInvoiceMail($invoice_details));
                    //send order email to wirelessshop
                    Mail::send(new WirelessShopInvoiceMail($transaction_details));                    
                    //Delete cart
                    $cart = Cart::where('user_id',Auth::user()->id)->first();
                    Cart::destroy($cart->id);
                    return redirect('/cart')->with(['code' => 'success', 'message' => 'Order ' . $invoice->id . ' has been paid successfully!']);
                }
            /*} else {
                $invoice->recurring_id = '123';
                $invoice->save();
            }*/
            //foreach($_POST as $key => $value) {
            // echo $key . " = " . $value . "<br>";
            //}
        } 
        else if (strcmp ($res, "INVALID") == 0) {
            // IPN invalid, log for manual investigation
            //echo "The response from IPN was: <b>" .$res ."</b>";
            $logFile = 'ipn_log_'.Carbon::now()->format('Ymd_His').'.txt';
            Storage::disk('local')->put($logFile, print_r($res, true));
        }       
    }
}
