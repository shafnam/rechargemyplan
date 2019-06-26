@extends('layouts.master')

@section('plans_styles')
    <link href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" />
@stop

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Plans
        <small>recharge plans</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">All Plans</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                <div class="box-header">
                    <h3 class="box-title">All Plans</h3><br/><br/>
                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.plans.add.get') }}" class="btn btn-info">Add New</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="plans" class="table table-hover">
                        <thead>
                            <tr>                           
                                <th>Carrier</th>
                                <th>Name</th>
                                <th>Logo</th>
                                <th>Price($)</th>
                                <th>Status</th>
                                <th style="width: 30%;">Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_plans as $ap)
                            <tr>
                                <td>{{ $ap->carriers->name }}</td>
                                <td>{{ $ap->name }}</td>
                                <td><img src="{{URL::asset('/images/plans/'. $ap->logo )}}" style="width: 120px;"></td>
                                <td>{{ $ap->price }}</td>
                                <td>
                                    @if($ap->status == 1)
                                        <span class="label label-success">Active</span>
                                    @else
                                        <span class="label label-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $ap->description }}</td>
                                <td>
                                    <a href="{{ route('admin.plans.edit.get',[$ap->id]) }}" class="btn bg-orange btn-flat">Edit</a>
                                @if($ap->status == '1')
                                    <!--Deactivate Function-->
                                    <form action="{{ route('admin.plans.deactivate', $ap->id) }}" method="POST" onsubmit="return confirm('Do you really want to deactivate?');" style="display: inline;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="submit" class="btn btn-default btn-flat" value="Deactivate">
                                    </form>
                                @else
                                    <!--Activate Function-->
                                    <form action="{{ route('admin.plans.activate', $ap->id) }}" method="POST" onsubmit="return confirm('Do you really want to activate?');" style="display: inline;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="submit" class="btn btn-info btn-flat" value="Activate">
                                    </form>
                                @endif
                                </td>
                            </tr>
                            @endforeach    
                        </tbody>
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

@section('datatables') 
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}" /></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}" /></script>
@stop

@section('script')
    <script type="text/javascript">
        /*$(function () {
            $('#plans').DataTable()
        });*/
    </script>
@endsection
