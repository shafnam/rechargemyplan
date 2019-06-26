<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Cart;
use App\User;
use App\Invoice;
use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
    */
    public function index(){
        
        $items = 0;        
        $tabName = 'home';        
        
        $customer_id = auth()->user()->id;
        $customer = User::where('id',$customer_id)->first();

        $order_details = Invoice::where('user_id',$customer_id)->get();
        
        if(Auth::check()) {
            $cart = Cart::where('user_id',Auth::user()->id)->first();
            if($cart != null){
                $items = $cart->cart_items;
            } 
        } 
        
        return view('home',compact('items','customer','tabName','order_details'));
        //return view('home',compact('items','customer','tabName'));
    }

    public function accountUpdate($id,Request $request){

        $tabName = 'account';
        $items = 0;
        if(Auth::check()) {
            $cart = Cart::where('user_id',Auth::user()->id)->first();
            if($cart != null){
                $items = $cart->cart_items;
            } 
        }

        $validator = Validator::make($request->all(),[
            'customer_name' => 'required'
        ]);
        if($validator->fails()){
            return redirect(route('user.edit.post',[$id]))
                ->withErrors($validator)
                ->withInput();
        }

        $customer = User::find($id);
        $customer->name = $request->get('customer_name');
        $customer->phone_number = $request->get('customer_phone_number');
        $customer->save();

        //return redirect()->back()->with("success","Details changed successfully !");
        return back()->withInput(['tabName'=>'account'])->with("success","Details changed successfully !");
    }

    public function changePassword(Request $request){
        
        if(!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            // The passwords matches
            return back()->withInput(['tabName'=>'password'])->with("error","Your current password does not match with the password you provided. Please try again.");
            //return redirect()->back()->with("error","Your current password does not match with the password you provided. Please try again.");
        }
        
        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            //Current password and new password are same
            //return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
            return back()->withInput(['tabName'=>'password'])->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        
        $validator = Validator::make($request->all(),[
            'current_password' => 'required',
            //'new_password' => 'required|string|min:6|confirmed',
            'new_password' => 'min:6|required_with:c_new_password|same:c_new_password'
        ]);
        
        if($validator->fails()){
            return redirect(route('changePassword.get'))
                ->withErrors($validator)
                ->withInput();
        }
        
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        return back()->withInput(['tabName'=>'password'])->with("success","Password changed successfully !");
        //return redirect()->back()->with("success","Password changed successfully !");
    }
        
}
