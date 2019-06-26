<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Blog;
use App\Cart;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = 0;
        $blogs = Blog::where('status', 1)->get();
        if(Auth::check()) {
            $cart = Cart::where('user_id',Auth::user()->id)->first();
            if($cart != null){
                $items = $cart->cart_items;
            } 
        }

        return view('blog.index',compact('blogs','items'));
        //return 123;
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
        $items = 0;
        if(Auth::check()) {
            $cart = Cart::where('user_id',Auth::user()->id)->first();
            if($cart != null){
                $items = $cart->cart_items;
            } 
        }
        $blog = Blog::where('id', $id)->first();
        $related_blogs = Blog::where('status', 1)->inRandomOrder()->limit(4)->get();
        return view('blog.view',compact('blog','related_blogs','items'));
        //return 123;
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
}
