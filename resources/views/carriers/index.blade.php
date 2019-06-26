@extends('layouts.app')

@section('style')
    <type="text/css">
        .group {margin-bottom: 6rem;}
        .faq-content {margin-top: 1rem;}
        .faq-content .bgrid {padding: 15px 30px;}
        .bgrid{ position: relative;}
        .discount-image{ position: absolute;z-index: 100;top: 5px;right: 15px; }
        .discount-image img{ width: 60px; }
        .price-text {top: -2px; right: 11px; font-size: 20px;}  
    </type>
@endsection

@section('content')
    
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

@endsection