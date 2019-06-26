@extends('layouts.master')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Carriers
        <small>recharge carriers</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">All Carriers</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                <div class="box-header">
                    <h3 class="box-title">All Carriers</h3><br/><br/>
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a href="{{ route('admin.carriers.add.get') }}" class="btn btn-info">Add New</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>                           
                            <th>Name</th>
                            <th>Logo</th>
                            <th>Status</th>
                            <th>Plan Status</th>
                            <th>SIM Status</th>
                            <th style="width: 30%;">Description</th>

                            <th>Action</th>
                        </tr>
                        @foreach($all_carriers as $ac)
                            <tr>
                                <td>{{ $ac->name }}</td>
                                <td><img src="{{URL::asset('/images/carriers/'. $ac->logo )}}" style="width: 150px;"></td>
                                <td>
                                    @if($ac->status == 1)
                                        <span class="label label-success">Active</span>
                                    @else
                                        <span class="label label-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if($ac->plan_status == 1)
                                        <span class="label label-success">Active</span>
                                    @else
                                        <span class="label label-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if($ac->sim_status == 1)
                                        <span class="label label-success">Active</span>
                                    @else
                                        <span class="label label-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $ac->description }}</td>
                                <td>
                                    <a href="{{ route('admin.carriers.edit.get',[$ac->id]) }}" class="btn bg-orange btn-flat">Edit</a>
                                @if($ac->status == '1')
                                    <!--Deactivate Function-->
                                    <form action="{{ route('admin.carriers.deactivate', $ac->id) }}" method="POST" onsubmit="return confirm('Do you really want to deactivate?');" style="display: inline;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="submit" class="btn btn-default btn-flat" value="Deactivate">
                                    </form>
                                @else
                                    <!--Activate Function-->
                                    <form action="{{ route('admin.carriers.activate', $ac->id) }}" method="POST" onsubmit="return confirm('Do you really want to activate?');" style="display: inline;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="submit" class="btn btn-info btn-flat" value="Activate">
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