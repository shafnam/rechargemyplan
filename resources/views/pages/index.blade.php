@extends('layouts.app')

@section('styles')
    
    .group {margin-bottom: 6rem;}
    .faq-content {margin-top: 1rem;}
    .faq-content .bgrid {padding: 15px 30px;}
    .bgrid{ position: relative;}
    .discount-image{ position: absolute;z-index: 100;top: 5px;right: 15px; }
    .discount-image img{ width: 60px; }
    .price-text {top: -2px; right: 11px; font-size: 20px;}  
    
@endsection

@section('content')
<!-- intro section
   ================================================== -->
    <section id="intro">

        <div class="shadow-overlay"></div>

        <div class="intro-content">
            <div class="row">
                <div class="col-twelve">                    
                    <h2>Activate any plan from anywhere for any number</h2>
                    <div class="col-twelve middle-align">
                        <form name="jump">
                            <select onchange="javascript:location.href = this.value;">
                                <option selected disabled>Select Your Carrier</option>
                                @foreach($all_carriers as $ac)
                                    <option value="{{ route('carriers.view.get', [$ac->id]) }}">{{ $ac->name }}</option>                                    
                                @endforeach
                            </select>
                        </form>
                    </div>                    

                    <a class="button stroke smoothscroll" href="#process" title="">Learn More</a>
                </div>  
            </div>   		 		
        </div>
    </section> 
<!-- /intro -->

<!-- Process Section
   ================================================== -->
    <section id="process">  

		<div class="row section-intro">
			<div class="col-twelve with-bottom-line">

				<h1>How it works?</h1>

				<p class="lead">
				RechargeMyPlan™ is the ideal way to add plans to any number for the major carriers available in the USA .</p>

			</div>   		
		</div>

		<div class="row process-content">
		
			<div class="features-list block-1-4 block-s-1-2 block-tab-full group">
			
				<div class="bgrid feature">
					<div class="item" data-item="1">
						<div class="service-content">
							<h3 class="h05">Choose Carrier</h3>
						</div> 
						<span class="icon"><i class="ion-wifi"></i></span>		            
					</div> 	
				</div> <!-- /bgrid -->
				
				<div class="bgrid feature">
					<div class="item" data-item="2">
						<div class="service-content">
							<h3 class="h05">Choose Package</h3>
						</div> 
						<span class="icon"><i class="ion-bag"></i></span>		  		            
					</div> 	
				</div> <!-- /bgrid -->
				
				<div class="bgrid feature">
					<div class="item" data-item="3">
						<div class="service-content">
							<h3 class="h05">Purchase Package</h3>
						</div> 
						<span class="icon"><i class="ion-ios-cart"></i></span>		  		            
					</div> 	
				</div> <!-- /bgrid -->
				
				<div class="bgrid feature">
					<div class="item" data-item="4">
						<div class="service-content">
							<h3 class="h05">Enjoy Talking</h3>
						</div> 
						<span class="icon"><i class="ion-android-contacts"></i></span>		            
					</div> 	
				</div> <!-- /bgrid -->

			</div>

		</div> <!-- /process-content -->

    </section> <!-- /process-->
    
<!-- Top-ups Section
   ================================================== -->
	<section id="faq">
			
        <div class="row faq-content">
    
            <div class="section-intro">
                <div class="col-twelve with-bottom-line">
                    <h1 class="h01">Top Ups</h1>
                </div>   		
            </div>            
        
            <div class="q-and-a block-1-3 block-tab-full group">
                @foreach($all_carriers as $ac)
                    @if($ac->name != 'ROK Verizon Mobile' && $ac->name != 'ROK GSM Mobile')
                        <div class="bgrid">
                            <?php 
                                // $stmnt = $plan_details->viewMaxDiscount($row['carrier_id']);
                                // $DiscountDetails = $stmnt->fetch(PDO::FETCH_ASSOC);
                                // extract($DiscountDetails);
                                // if($LargestDiscount > 0){
                                if(1 == 0){
                            ?>
                            <div class="discount-image">
                                <img  src="{{ URL::asset('/images/starburst.png') }}"/>
                                <p class="price-text">
                                    <span style="font-size: 18px;">Upto</span><br/>
                                    <?php 
                                        // echo $LargestDiscount;
                                    ?>%
                                </p>
                            </div>
                            <?php  } ?>
                                                
                            <a class="hvr-float" href="{{ route('carriers.view.get', [$ac->id]) }}">
                                <img src="{{ URL::asset('/images/carriers/'.$ac->logo) }}">
                            </a>
                            <h4>{{ $ac->name }}</h4>                    
                        </div>
                    @endif
                @endforeach        
            </div>
        
        </div>
        
                
    </section> <!-- /top-ups --> 

<!-- SIMs Section
   ================================================== -->
	{{-- <section id="faq" style="background: #fff;">
	
		<div class="row faq-content">
			
			<div class="section-intro">
				<div class="col-twelve with-bottom-line">
					<h1>SIM Cards</h1>
				</div>   		
			</div>
            
            <div class="q-and-a block-1-3 block-tab-full group">
                @foreach($all_sims as $as)
                   
                    <div class="bgrid">                                            
                        <a class="hvr-float" href="{{ route('sims.view.get', [$as->id]) }}">
                            <img src="{{ URL::asset('/images/sims/'.$as->logo) }}">
                        </a>
                        <h4>{{ $as->name }}</h4>                    
                    </div>
                    
                @endforeach      
            </div>
		</div>
		
    </section> --}} <!-- /sim -->
@endsection