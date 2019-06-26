@extends('layouts.master')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blogs
        <small>recharge blogs</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">All Blogs</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                <div class="box-header">
                    <h3 class="box-title">All Blogs</h3><br/><br/>
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a href="{{ route('admin.blogs.add.get') }}" class="btn btn-info">Add New</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>                           
                            <th>Name</th>
                            <th>Featured Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach($all_blogs as $ab)
                            <tr>
                                <td>{{ $ab->name }}</td>
                                <td><img src="{{URL::asset('/images/blogs/'. $ab->featured_image )}}" style="width: 250px;"></td>
                                <td>
                                    @if($ab->status == 1)
                                        <span class="label label-success">Published</span>
                                    @else
                                        <span class="label label-danger">Unpublishded</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.blogs.view.get',[$ab->id]) }}" class="btn bg-maroon btn-flat">View</a>
                                    <a href="{{ route('admin.blogs.edit.get',[$ab->id]) }}" class="btn bg-orange btn-flat">Edit</a>
                                @if($ab->status == '1')
                                    <!--Unpublish Function-->
                                    <form action="{{ route('admin.blogs.unpublish', $ab->id) }}" method="POST" onsubmit="return confirm('Do you really want to unpublish?');" style="display: inline;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="submit" class="btn btn-default btn-flat" value="Unpublish">
                                    </form>
                                @else
                                    <!--Publish Function-->
                                    <form action="{{ route('admin.blogs.activate', $ab->id) }}" method="POST" onsubmit="return confirm('Do you really want to publish?');" style="display: inline;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="submit" class="btn btn-info btn-flat" value="Publish">
                                    </form>
                                @endif
                                </td>
                            </tr>
                        @endforeach        
                    </table>
                </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
@endsection