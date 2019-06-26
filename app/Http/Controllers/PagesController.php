<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Carrier;
use App\Cart;
use App\Blog;
use App\ContactEmail;
use App\Mail\SendMail;
use App\Mail\CustomerInvoiceMail;
use App\Mail\WirelessShopInvoiceMail;

class PagesController extends Controller
{
    public function index(){
        $items = 0;
        $all_carriers = Carrier::where('status', 1)->get();
        if(Auth::check()) {
            $cart = Cart::where('user_id',Auth::user()->id)->first();
            if($cart != null){
                $items = $cart->cart_items;
            } 
        }
        //dd($items);
        return view('pages.index',compact('all_carriers','items'));
    }

    /*public function blog(){
        $blogs = Blog::where('status', 1)->get();
        return view('pages.blog',compact('blogs'));
    }*/

    public function contact(){        
        $items = array();
        if(Auth::check()) {
            $cart = Cart::where('user_id',Auth::user()->id)->first();
            if($cart != null){
                $items = $cart->cart_items;
            }        
        }    
        return view('pages.contact',compact('items'));
    }

    public function postContactus(Request $request) {    
        
        $this->validate($request, [
            'fullname' => 'required',
            'email' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);
        //dd('done');

        // Write here your database logic
        $contact_email = new ContactEmail();
        $contact_email->name = $request->get('fullname');
        $contact_email->email = $request->get('email');
        $contact_email->message = $request->get('message');
        $contact_email->save();

        //Send email
        Mail::send(new SendMail());

        // ['text'=>'emails.contact-email'],['name','Shafna'], function ($message){
        //     $message->to('shafna@witellsolutions.com','RMP Contact')->subject('Test Email');
        //     $message->from('testg@gmail.com', 'Customer');
        // }

        return redirect(route('contact'))->with('success_messge',"Stay tuned, Your message was sent successfully..!!");
    }

    public function testEmail() {  

        //get invoice item details
        $items = array(); 
        $invoice_details = array();
        $sub_total = 0;
        //$invoice_items = $invoice->invoice_items; //the invoice items object
        //foreach ($invoice_items as $invoice_item) {
            //Item details array
            array_push($items, [
                'name' => 'Item_1',
                'price' => '20',
                'qty' => '1',
                'carrier_name' => 'Carrier_1',
                'recharge_number' => '1111111111'
            ]);

            $sub_total = 20 * 1;
            //(add discount if needed)            
        //}

        // Add handling fee
        $handling_fee_val = ((floatval($sub_total) * 0.034) + 0.30);										
        $handling_fee = number_format($handling_fee_val, 2, '.', '');	
        $total = $sub_total + $handling_fee;

        // customer details
        //$customer_email = User::where('id', $invoice->user_id)->pluck('email');
        $customer_email = 'shafna@witellsolutions.com';
        //dd($customer_email);

        $invoice_details =  [
            'customer_email' => $customer_email,
            'items' => $items,
            'subtotal' => $sub_total,
            'handling' => $handling_fee,
            'total' => $total
        ];

        $transaction_details =  [
            'customer_email' => $customer_email,
            'customer_name' => $customer_name,
            'items' => $items,
            'subtotal' => $sub_total,
            'handling' => $handling_fee,
            'total' => $total
        ];

        //send order email to customer
        Mail::to($customer_email)->send(new CustomerInvoiceMail($invoice_details));
        //send order email to wirelessshop
        Mail::send(new WShopInvoiceMail($transaction_details));

        return 'success';
    }


}
