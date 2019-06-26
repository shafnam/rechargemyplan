@extends('layouts.master')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blogs
            <small>Add a new blog</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('admin.blogs.list') }}">Blogs</a></li>
            <li class="active">Add new</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                @if(session()->has('success_messge'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{{ session()->get('success_messge') }}</li>
                        </ul>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add New Blog</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="blog_add_form" action="{{ route('admin.blogs.add.post') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Blog Name*</label>
                                    <input type="text" name="blog_name" id="blog_name" class="form-control" placeholder="Enter ..." required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-10">
                                    <label>Content*</label>
                                    <textarea name="blog_content" class="summernote"></textarea>
                                    {{-- <textarea class="textarea" name="blog_content" id="blog_content" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" rows="3" placeholder="Enter ..."></textarea> --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 img-upload">
                                    <div class="row">
                                        <label class="col-md-12">Featured Image*</label>
                                        <img id="img_preview" class="col-md-4" alt="blog image" src="{{URL::asset('/images/blogs/blog-preview.png')}}"/>
                                    </div>
                                    <div class="row">
                                        <label class="custom-img-upload col-md-4" id="img-up-btn">Add an image</label>
                                        <input type="file" name="blog_featured_image" id="blog_featured_image" onchange="document.getElementById('img_preview').src = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
            
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" id="blog_submit_btn">Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->        
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
@endsection