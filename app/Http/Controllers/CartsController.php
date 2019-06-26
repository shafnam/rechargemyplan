<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartItem;
use App\Carrier;
use App\Plan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
 
use Illuminate\Http\Request;
 
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addItem ($item_id, Request $request){

        //get carrier details
        $carrier_id = $request->get('carrier_id');
        $carrier_details = Carrier::where('id', $carrier_id)->first();

        //get plan details
        $plan_details = Plan::where('id', $item_id)->first();
        
        $validator = Validator::make($request->all(),[
            'phone_number' => 'required|required_with:confirm_phone_number|same:confirm_phone_number|size:14'
        ]);
        if($validator->fails()){
            return redirect(route('carriers.view.get',[$carrier_id]))
                ->withErrors($validator)
                ->withInput()
                ->with('item_id', $item_id);
        }

        $cart = Cart::where('user_id',Auth::user()->id)->first();
 
        if(!$cart){
            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->save();
        }

        $recharge_number = CartItem::where('recharge_number', '=', $request->get('phone_number'))->first();
        
        if ($recharge_number === null) {
            // recharge number doesn't exist add new item
            //dd($recharge_number);
            $cartItem = new CartItem();
            $cartItem->cart_id = $cart->id;
            $cartItem->item_id = $item_id;
            $cartItem->item_name = $plan_details->name;
            $cartItem->carrier_name = $carrier_details->name;
            $cartItem->item_price = $plan_details->price;
            $cartItem->item_discount_check	= $plan_details->discount_check;
            $cartItem->item_discount_percentage = $plan_details->discount_percentage;
            $cartItem->item_type = $request->get('item_type');
            $cartItem->recharge_number = $request->get('phone_number');
            $cartItem->item_logo = $plan_details->logo;
            $cartItem->save();
        } else{
            // Update Item
            //dd($recharge_number);
            $item_details = CartItem::where('recharge_number', '=', $request->get('phone_number'))->first();
            $cartItem = CartItem::find($item_details->id);
            //dd($cartItem);
            $cartItem->cart_id = $cart->id;
            $cartItem->item_id = $item_id;
            $cartItem->item_name = $plan_details->name;
            $cartItem->carrier_name = $carrier_details->name;
            $cartItem->item_price = $plan_details->price;
            $cartItem->item_discount_check	= $plan_details->discount_check;
            $cartItem->item_discount_percentage = $plan_details->discount_percentage;
            $cartItem->item_type = $request->get('item_type');
            $cartItem->recharge_number = $request->get('phone_number');
            $cartItem->item_logo = $plan_details->logo;
            $cartItem->save();
        }       
 
        //return redirect('/cart');
        //return $request->get('phone_number');
        return redirect(route('carriers.view.get',[$carrier_id]))->with('success_messge',"Item successfully added to the cart...");
    }

    public function showCart(){
        
        $cart = Cart::where('user_id',Auth::user()->id)->first();
 
        if(!$cart){
            $cart =  new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->save();
        }
 
        $items = $cart->cart_items;
        //dd($items);
        $total = 0;

        foreach($items as $item){
            if($item->plans->discount_check == 1) {
                $price = $item->plans->price - ($item->plans->price * $item->plans->discount_percentage)/100;
            } else {                
                $total += $item->plans->price;
                //dd($total);
            }
        }
 
        return view('cart.view',['items'=>$items,'total'=>$total]);
    }
 
    public function removeItem($id){
 
        CartItem::destroy($id);
        return redirect(route('cart'))->with('success_messge',"Item deleted from the cart...");
    }
 
}
