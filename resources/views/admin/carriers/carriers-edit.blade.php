@extends('layouts.master')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Carriers
            <small>Edit details</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('admin.carriers.list') }}">Carriers</a></li>
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
                        <h3 class="box-title">Edit Carrier Details</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="carrier_edit_form" action="{{ route('admin.carriers.edit.post',[$carrier->id]) }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Carrier Name*</label>
                                    <input type="text" name="carrier_name" id="carrier_name" class="form-control" placeholder="Enter ..." value="{{ $carrier->name }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Description</label>
                                    <textarea name="carrier_description" id="carrier_description" class="form-control" rows="3" placeholder="Enter ...">{{ $carrier->description }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 img-upload">
                                    <div class="row">
                                        <label class="col-md-12">Carrier Logo*</label>
                                        <img id="img_preview" class="col-md-4" alt="carrier image" src="{{URL::asset('/images/carriers/'. $carrier->logo)}}"/>
                                        <!--<a href="javascript:void(0);" id="remImg" class="remImg" style="display: none;"><i aria-hidden="true" class="fa fa-close remove-img"></i></a>-->
                                    </div>
                                    <div class="row">
                                        <label class="custom-img-upload col-md-4" id="img-up-btn">Change image</label>
                                        <input type="file" name="carrier_logo" id="carrier_logo" onchange="document.getElementById('img_preview').src = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Carrier Status</label><br/>
                                    <label class="switch">
                                        <input type="checkbox" name="carrier_status" id="carrier_status" {{ $carrier->status == '1' ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                    <input type="hidden" name="new_carrier_status" id="new_carrier_status" value="{{ $carrier->status }}"/>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Plan Status</label><br/>
                                    <label class="switch">
                                        <input type="checkbox" name="plan_status" id="plan_status" {{ $carrier->plan_status == '1' ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                    <input type="hidden" name="new_plan_status" id="new_plan_status" value="{{ $carrier->plan_status }}"/>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>SIM Status</label><br/>
                                    <label class="switch">
                                        <input type="checkbox" name="sim_status" id="sim_status" {{ $carrier->sim_status == '1' ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                    <input type="hidden" name="new_sim_status" id="new_sim_status" value="{{ $carrier->sim_status }}"/>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
            
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" id="carrier_submit_btn">Save</button>
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