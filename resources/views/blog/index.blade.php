@extends('layouts.app')

@section('content')
<section id="cart-items">
    <div class="row blog-page">
        <!-- Blog Entries Column -->
        <div class="col-md-12">        
            <h1 class="page-header">Blog</h1>
            @foreach($blogs as $blog) 
            <div class="row"> 
                <div class="col-md-6">    
                    <h2><a href="{{ route('blog.view.get', [$blog->id]) }}">{{ $blog->name }}</a></h2>
                    <p class="lead">By <a href="">{{ $blog->author }}</a></p>
                </div>
                <div class="col-md-6">    
                    <p class="text-right"><i class="ion-clipboard"></i> Posted on <?php echo date('F d Y', strtotime($blog->created_at)); ?></p>
                </div>
                <div class="col-md-12">
                    <img class="img-responsive" src="{{ URL::asset('/images/blogs/'.$blog->featured_image) }}" alt="{{$blog->name}}">
                    <hr>
                    <?php $excerpt=substr($blog->content,0,250); ?>
                    <p><?php echo $excerpt ; ?>...</p>
                    <a class="button checkout" style="width: 135px; text-decoration: none;" href="{{ route('blog.view.get', [$blog->id]) }}">Read More <i class="ion-forward"></i></a>
                    <hr>
                </div>                
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection