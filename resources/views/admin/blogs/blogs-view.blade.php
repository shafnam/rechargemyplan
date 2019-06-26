@extends('layouts.master')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blog
            <small>Details</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('admin.blogs.list') }}">Blogs</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Blog Details</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <h2>{{$blog->name}}</h2>
                                <img src="{{URL::asset('/images/blogs/'. $blog->featured_image )}}" style="width: 1100px;">
                                <p>{!! $blog->content !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box -->        
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
@endsection