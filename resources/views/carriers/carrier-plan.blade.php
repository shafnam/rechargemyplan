@extends('layouts.app')

@section('content')

    <section id="cart-items" class="carrier-plan">
			
        <div class="row pricing-content">

            <div class="col-twelve with-bottom-line breadcrumb-container">
                
                @if(session()->has('success_messge'))
                    <div id="successMessageAddToCart" class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert" style="margin-top: -30px; margin-right: -10px;">×</button>	
                        <strong><i class="ion-ios-checkmark-outline"></i>{{ session()->get('success_messge') }}</strong>
                    </div>
                @endif
                
                
                @if(count($errors) > 0)
                    @if(!empty(Session::get('item_id')))
                        <?php $item_id = Session::get('item_id') ?>
                        <script>
                            var item_id = "<?php echo $item_id; ?>";
                            $(function() {
                                $("#rechargeModal-"+item_id).modal('show');                                
                            });                            
                            //alert(item_id);
                        </script>
                    @endif
                @endif
                
            </div>
        
            <div class="col-twelve with-bottom-line breadcrumb-container">
                <ol class="breadcrumb">
                    <li><a href="{{ route('carriers') }}">Top Ups</a></li>
                    <li class="current">{{ $carrier->name }}</li>
                </ol>
            </div>

            <div class="col-twelve section-intro">                
                <div class="col-three with-bottom-line">
                    <img src="{{ URL::asset('/images/carriers/logo-'. $carrier->logo ) }}">
                </div>
                <div class="col-nine with-bottom-line">
                    <h3>{{ $carrier->name }} Recharge</h3>
                    <p>{{ $carrier->description }}</p>
                </div>
                <div class="col-three with-bottom-line">
                </div>                
            </div>

            <?php 
				if($carrier->name == 'ROK Mobile') { 				
					$rokSubPlans = array("Verizon", "Sprint" , "AT"); //, "Sprint", "AT"				
					foreach($rokSubPlans as $rokSubPlan)
					{
			?>
						<div class="col-twelve with-bottom-line">
							<h2>ROK <?php if($rokSubPlan == 'AT') { echo 'AT&T'; } else{ echo $rokSubPlan; } ?> Plans</h2>
                        </div>
                        <div class="row">
                            @foreach($carrier_plans as $cp)
                            <?php if (strpos($cp, $rokSubPlan) !== false) { ?>
                            <div class="col-two with-bottom-line">
                                <div class="bgrid">					
                                    <div class="price-block">                       
                                        <div class="top-part <?php echo $rokSubPlan; ?>">
                                            <h4>{{ $cp->carriers->name }} Monthly Plan</h4>                                    
                                            <h1>
                                                <sup>$</sup>
                                                <?php echo $cp->price = str_replace('.00', '', $cp->price); ?>
                                            </h1>
                                            <p>{!! nl2br(e($cp->description)) !!}</p>
                                        </div>                          
                                        
                                        <div class="bottom-part">
                                            {{-- //Add To Cart Button --}}
                                            @if(Auth::check())
                                            <button type="button" class="button large checkout s-c-d-button" data-toggle="modal" data-target="#rechargeModal-{{ $cp->id }}" id="open">Add to cart</button>                           
                                            @else
                                            <a class="button large checkout s-c-d-button" href="{{ route('login') }}">Add to Cart</a>
                                            @endif
                                        </div>
                                        <input type="hidden" name="plan_id" value="{{ $cp->id }}">
                                    </div>                
                                </div>
                            </div>
                            <!-- ITEM MODAL POPUP
                            ========================================================= -->

                            <form role="form" name="add_to_cart_form" class="add_to_cart_form" id="add_to_cart_form_{{ $cp->id }}" class="login-from form-signin" method="POST" action="{{ route('addTocart', $cp->id) }}">
                                {{ csrf_field() }}
            
                                <div class="modal fade" tabindex="-1" role="dialog" class="rmp" id="rechargeModal-{{ $cp->id }}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="alert alert-danger" style="display:none"></div>
                                            <div class="modal-header">
                                                <h4 class="modal-title">{{ $cp->name }}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        @if($errors->any())
                                                            <div class="alert alert-danger">
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                        <li>{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-10 col-md-offset-1">
                                                        <label>Phone Number</label>
                                                        <input type="text" class="form-control" name="phone_number" id="pNumber" placeholder="(012) 345-6789" oncopy="return false" onpaste="return false"/>
                                                        
                                                        <!--<label for="pNumber">Phone Number</label>
                                                        <input type="text" class="form-control" name="phone_number" id="pNumber" placeholder="(012) 345-6789" oncopy="return false" onpaste="return false">-->
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-10 col-md-offset-1">
                                                        <label for="cPNumber">Confirm Phone Number</label>
                                                        <input type="text" class="form-control" name="confirm_phone_number" id="cPNumber" placeholder="(012) 345-6789" oncopy="return false" onpaste="return false">
                                                        <div id="pno-message"></div>
                                                    </div>
                                                </div>
                                                <!-- Other details about the plan -->
                                                <input type="hidden" name="plan_id" value="{{ $cp->id }}" />
                                                <input type="hidden" name="carrier_id" value="{{ $cp->carrier_id }}" />		
                                                <input type="hidden" name="item_type" value="plan" />					
                                            </div>
                                            <div class="modal-footer">
                                            <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button  class="btn btn-success" id="ajaxSubmit">Save changes</button>-->
                                            <button type="submit" class="button large checkout s-c-d-button" id="addRecharge" name="buy_plan" value="submit">
                                                Buy this Plan
                                            </button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                
                            </form>                
                                
                            <!-- / ITEM MODAL POPUP  -->
                            <?php } ?>
                            @endforeach	
                        </div>			
                    <?php
                    }							
                } 
            else {						
			?>
			<div class="row">
                @foreach($carrier_plans as $cp)
                    <div class="col-two with-bottom-line">
                        <div class="bgrid">                                
                            <div class="price-block">                       
                                <div class="top-part <?php if($cp->carriers->name == 'AT&T'){ echo 'ATT'; } else{ echo $cp->carriers->name; } ?>">
                                    <h4>{{ $cp->carriers->name }} Monthly Plan</h4>                                    
                                    <h1>
                                        <sup>$</sup>
                                        <?php echo $cp->price = str_replace('.00', '', $cp->price); ?>
                                    </h1>
                                    <p>{!! nl2br(e($cp->description)) !!}</p>
                                {{-- <img class="hvr-float" src="{{ URL::asset('/images/plans/' .$cp->logo ) }}"> --}}
                                </div>                     
                                
                                <div class="bottom-part">
                                    {{-- //Add To Cart Button --}}
                                    @if(Auth::check())
                                    <button type="button" class="button large checkout s-c-d-button" data-toggle="modal" data-target="#rechargeModal-{{ $cp->id }}" id="open">Add to cart</button>                           
                                    @else
                                    <a class="button large checkout s-c-d-button" href="{{ route('login') }}">Add to Cart</a>
                                    @endif
                                </div>
                                <input type="hidden" name="plan_id" value="{{ $cp->id }}">
                            </div>
                        </div>
                    </div>
                    <!-- ITEM MODAL POPUP
                    ========================================================= -->

                    <form role="form" name="add_to_cart_form" class="add_to_cart_form" id="add_to_cart_form_{{ $cp->id }}" class="login-from form-signin" method="POST" action="{{ route('addTocart', $cp->id) }}">
                        {{ csrf_field() }}

                        <div class="modal fade" tabindex="-1" role="dialog" class="rmp" id="rechargeModal-{{ $cp->id }}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="alert alert-danger" style="display:none"></div>
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{ $cp->name }}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                @if($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-10 col-md-offset-1">
                                                <label>Phone Number</label>
                                                <input type="text" class="form-control" name="phone_number" id="pNumber" placeholder="(012) 345-6789" oncopy="return false" onpaste="return false"/>
                                                
                                                <!--<label for="pNumber">Phone Number</label>
                                                <input type="text" class="form-control" name="phone_number" id="pNumber" placeholder="(012) 345-6789" oncopy="return false" onpaste="return false">-->
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-10 col-md-offset-1">
                                                <label for="cPNumber">Confirm Phone Number</label>
                                                <input type="text" class="form-control" name="confirm_phone_number" id="cPNumber" placeholder="(012) 345-6789" oncopy="return false" onpaste="return false">
                                                <div id="pno-message"></div>
                                            </div>
                                        </div>
                                        <!-- Other details about the plan -->
                                        <input type="hidden" name="plan_id" value="{{ $cp->id }}" />
                                        <input type="hidden" name="carrier_id" value="{{ $cp->carrier_id }}" />		
                                        <input type="hidden" name="item_type" value="plan" />					
                                    </div>
                                    <div class="modal-footer">
                                    <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button  class="btn btn-success" id="ajaxSubmit">Save changes</button>-->
                                    <button type="submit" class="button large checkout s-c-d-button" id="addRecharge" name="buy_plan" value="submit">
                                        Buy this Plan
                                    </button>
                                </div>
                            </div>
                            </div>
                        </div>                        
                    </form>                
                    
                    <!-- / ITEM MODAL POPUP  -->
                @endforeach
			</div>
            <?php
                }			
			?>
        
        </div>

    </section> <!-- /process-->
    
<!-- Plans Section
   ================================================== -->
	{{-- <section id="faq">
			
        <div class="row faq-content">
    
            <div class="section-intro">
                <div class="col-twelve with-bottom-line">
                    <h1 class="h01">Plans</h1>
                </div>   		
            </div>            
        
            <div class="q-and-a block-1-3 block-tab-full group">
                @foreach($carrier_plans as $cp)
                    
                    {{ <div class="bgrid">                    
                        <a class="hvr-float" href="{{ route('carriers.view.get', [$cp->id]) }}">
                            <img src="{{ URL::asset('/images/plans/'.$cp->logo) }}">
                        </a>
                        <h4>{{ $cp->name }}</h4>                    
                    </div> }}
                   
                @endforeach            
            </div>
        
        </div>        
                
    </section> <!-- /top-ups --> --}}

@endsection