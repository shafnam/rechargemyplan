@extends('layouts.app')

@section('content')

    <section id="cart-items">
			
        <div class="row pricing-content shopping-cart">

            @if (Session::has('message'))
                <div id="successMessageCart" class="alert alert-{{ Session::get('code') }}">
                    <p>{{ Session::get('message') }}</p>
                </div>
            @endif

            @if(session()->has('success_messge'))
                <div id="successMessageDeleteCart" class="alert alert-success">
                    <ul>
                        <li><i class="ion-ios-checkmark-outline"></i>{{ session()->get('success_messge') }}</li>
                    </ul>
                </div>
            @endif

            @if(count($items) > 0)
            <div class="col-nine with-bottom-line tab-full mob-full full-cart">
                <div class="box">
                    <div>
                    <h1>Shopping Cart <i class="ion-ios-cart"></i></h1>
                    <p>You currently have {{ $items->count() }} item(s) in your cart.</p>
                    
                    <table class='js-table-data'>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Item</th>
                                <!--<th data-label='Desc'>Description</th>-->
                                <th>Discount (%)</th>
                                <th style="width: 10%;">Price ($)</th>
                                <th style="width: 3%;"> </th>                            
                            </tr>
                        </thead>
                        @foreach($items as $item)
                        <tr>
                            <td><img src="{{ URL::asset('/images/plans/'.$item->plans->logo) }}" style="width: 100px;"></td>
                            <td>
                                {{ $item->plans->name}}<br/>
                                <span>Phone No-<?php if($item->item_type == 'plan'){ echo $item->recharge_number; }?></span>
                            </td>
                            {{--<td>{{ $item->plans->description }}</td>--}}
                            <td>@if(($item->plans->discount_check) != 0)
                                {{$item->plans->discount_percentage}}
                                @endif
                            </td>
                            <td>
                                <?php
                                    if($item->plans->discount_check == 1){
                                        $discounted_price = $item->plans->price - ($item->plans->price * $item->plans->discount_percentage)/100;
                                        echo $discounted_price = number_format($discounted_price, 2);                                        
                                    } else{
                                        echo $item->plans->price;
                                    }
                                ?>
                            </td>
                            <td>
                                <a class="remove-item" data-toggle="modal" data-target="#custom-width-modal{{ $item->id }}"><i class="ion-ios-trash-outline"></i></a>
                                {{--<a class="remove-item" href="{{ route('removeFromCart', $item->id) }}"><i class="ion-ios-trash-outline"></i></a>--}}
                            </td>
                        </tr>

                        <!-- Delete Model -->
                        <form role="form" method="POST" action="{{ route('removeFromCart', $item->id) }}">
                            {{ csrf_field() }}
        
                            <div class="modal fade" tabindex="-1" role="dialog" class="rmp" id="custom-width-modal{{ $item->id }}">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">REMOVE ITEM FROM CART</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="form-group col-md-10 col-md-offset-1">
                                                    <label>Are you sure to remove this item?</label>
                                                </div>
                                            </div>					
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button  class="btn btn-danger">Remove</button>
                                        <!--<button type="submit" class="button large checkout s-c-d-button" id="addRecharge" name="buy_plan" value="submit">
                                            Buy this Plan
                                        </button>-->
                                        </div>
                                    </div>
                                </div>
                            </div>                                
                        </form>   

                        @endforeach
                        
                    </table>                 

                    <a href="{{ route('carriers') }}">
                        <i class="ion-ios-arrow-back"></i> Continue Shopping
                    </a>
                    </div>
                   
                </div>
            </div>

            <div class="col-three tab-full mob-full cart-total tab-full mob-full cart-total">
                <div class="box order-summary">
                    <h1>Order Summary</h1>

                    <table>
                        <tbody>                    
                            <tr>
                                <th>Subtotal</th>
                                <td data-title="Subtotal">$<?php echo $total = number_format($total, 2, '.', ''); ?></td>
                            </tr>
                            <tr>
                                <th>(+) Handling fee</th>
                                <td data-title="Processing fee">
                                    <?php 										
										$processing_fee_val = ((floatval($total) * 0.034) + 0.30);										
										$processing_fee = number_format($processing_fee_val, 2, '.', '');										
										echo '$ '.$processing_fee; 
									?>
                                </td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td data-title="Total">
                                    <strong>
                                        <?php 	
                                            $gTotal = $total + $processing_fee; // here the subTotal is the value after subtracting the discount 
                                            
                                            $gTotal = number_format($gTotal, 2, '.', '');											
                                            echo '$'. $gTotal;
                                        ?>									
                                    </strong>
                                </td>
                            </tr>                    
                        </tbody>
                    </table>
                    <img src="{{ URL::asset('/images/paypal.jpg') }}">

                    <p><span>Pay via PayPal :</span> you can pay with your 
                    credit card if you don’t have a PayPal account.
                    </p>
                    <p class="alert alert-warning">Please double check the phone number entered for refill.
                    No refunds will be generated in case of incorrect phone number.</p>

                    <input id="toggle" type="checkbox" style="margin-bottom: 10px;">

                    <span>I agree to the above condition</span>

                    <a id="to-toggle" class="button large checkout disabled" data-href="{{ URL::route('paypal.express-checkout') }}">Proceed to checkout</a><br />
                    {{-- <input id="toggle" type="checkbox"> Toggle it --}}

                    {{-- <a name="to-toggle" id="to-toggle" class="button large checkout" data-href="checkout.php" style="/*margin-top: 15px; font-size: 1.6rem; opacity: 0.5;*/" disabled="disabled">
                        Proceed to checkout
                    </a> --}}
                </div>

            </div>
            @else
            <div class="col-twelve with-bottom-line tab-full mob-full empty-cart">
                <div class="box">
                    <div class="row">
                        {{-- <div class="col-three">                            
                            
                        </div> --}}
                        <div class="col-nine">
                            <i class="ion-ios-cart-outline"></i>
                            {{-- <img src="{{ URL::asset('/images/your-shopping-cart-is-empty.png' ) }}"> --}}
                            
                            <h1>Looks like you have no items in your shopping cart.</h1>
                            <a href="{{ route('carriers') }}">Click here to continue shopping</a>
                        </div>
                    </div>
                </div>
            </div>

            @endif
    
        </div>

    </section> <!-- /process-->   

@endsection