<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Carrier;
use App\Plan;
use App\Cart;

class CarriersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','carrierPlanView']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = 0;
        $all_carriers = Carrier::where('status', 1)->get();
        if(Auth::check()) {
            $cart = Cart::where('user_id',Auth::user()->id)->first();
            if($cart != null){
                $items = $cart->cart_items;
            } 
        }

        return view('carriers.index',compact('all_carriers','items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
    public function carrierPlanView($id){
        $items = 0;
        $carrier_plans =  Plan::where('carrier_id', $id)->where('status',1)->get();
        $carrier = Carrier::where('id',$id)->where('status',1)->first();
        if(Auth::check()) {
            $cart = Cart::where('user_id',Auth::user()->id)->first();
            if($cart != null){
                $items = $cart->cart_items;
            } 
        }
        
        return view('carriers.carrier-plan',compact('carrier_plans','carrier','items'));
        
    }
}
