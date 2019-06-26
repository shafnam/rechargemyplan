@extends('layouts.app')

@section('content')
<section id="cart-items" class="blog-details">
    <div class="row">
        <div class="col-twelve tab-full mob-full table-responsive">            
            <div class="row section-intro">
                <div class="col-twelve with-bottom-line">
                    <h1>{{ $blog->name }}</h1>
                    <p class="lead center-al">
                        by <a href="">{{ $blog->author }}</a>
                    </p>
                    <p class="center-al"><i class="ion-clipboard"></i> Posted on <?php echo date('F d Y', strtotime($blog->created_at)); ?></p>                   
                </div>   		
            </div>
            <img src="{{ URL::asset('/images/blogs/'.$blog->featured_image) }}">
            <div class="row section-intro">
                <div class="col-twelve with-bottom-line">
                </div>   		
            </div>
            {!! $blog->content !!}
        </div>    
    </div> <!-- /process-content -->
    
    <div style="height : 50px;"></div>
    
    <!-- related articles content-->
    <div class="row">
        <div class="col-md-12">
            <h3>Related Articles</h3>
            <hr>
            <div class="row">
                
                @foreach($related_blogs as $rb)                
                <div class="col-md-4" style="float: left;">
                <img class="img-responsive" src="{{ URL::asset('/images/blogs/'.$rb->featured_image) }}" alt="{{ $rb->name }}">
                    <hr>
                    <h4>
                        {{$rb->name}}
                    </h4>
                    <a style="width: 135px; text-decoration: none;" href="{{ route('blog.view.get', [$rb->id]) }}"> Read More <i class="ion-forward"></i></a>
                </div>
                @endforeach                
                            
            </div>
        </div>
    </div><!-- related articles content-->
</section>

@endsection