@extends('layouts.master')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Plans
            <small>Add a new plan</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('admin.plans.list') }}">Plans</a></li>
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
                        <h3 class="box-title">Add New Plan</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="plan_add_form" action="{{ route('admin.plans.add.post') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Carrier Name*</label>
                                    <select class="form-control" name="carrier" id="carrier" required>
                                        <option value="" selected="true" disabled>Select Carrier</option>
                                        @foreach($all_carriers as $ac)
                                            <option value="{{ $ac->id }}">{{ $ac->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Plan Name*</label>
                                    <input type="text" name="plan_name" id="plan_name" class="form-control" placeholder="Enter ..." required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Description*</label>
                                    <textarea name="plan_description" id="plan_description" class="form-control" rows="3" placeholder="Enter ..." required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Plan Price*</label>
                                    <input type="number" name="plan_price" id="plan_price" class="form-control" placeholder="Enter ..." required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Plan Discount</label><br/>
                                    <label class="switch">
                                        <input type="checkbox" name="plan_discount" id="plan_discount">
                                        <span class="slider round"></span>
                                    </label>
                                    <input type="hidden" name="new_plan_discont" id="new_plan_discont" value="0"/>
                                </div>
                                <div id="plan_discount_container" class="form-group col-md-2" style="display: none;">
                                    <label>Plan Discount Percentage</label>
                                    <input type="number" name="plan_discount_percentage" id="plan_discount_percentage" class="form-control" placeholder="Enter ..." value="0" required>
                                </div>
                            </div>
                            <div class="checkbox">
                                <label style="font-weight: 700;">
                                    <input type="checkbox" name="most_popular_plan"> Most Popular Plan
                                </label>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 img-upload">
                                    <div class="row">
                                        <label class="col-md-12">Plan Logo*</label>
                                        <img id="img_preview" class="col-md-4" alt="plan image" src="{{URL::asset('/images/plans/plan-preview.png')}}"/>
                                    </div>
                                    <div class="row">
                                        <label class="custom-img-upload col-md-4" id="img-up-btn">Add an image</label>
                                        <input type="file" name="plan_logo" id="plan_logo" onchange="document.getElementById('img_preview').src = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
            
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" id="plan_submit_btn">Save</button>
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