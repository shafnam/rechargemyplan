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
                        <h3 class="box-title">Edit Plan Details</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="planr_edit_form" action="{{ route('admin.plans.edit.post',[$plan->id]) }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Carrier Name*</label>
                                    <select class="form-control" name="carrier" id="carrier" required>
                                        @foreach($all_carriers as $ac)
                                            <option value="{{ $ac->id }}" {{ $ac->id == $plan->carrier_id ? 'selected' : '' }}>{{ $ac->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Plan Name*</label>
                                    <input type="text" name="plan_name" id="plan_name" class="form-control" placeholder="Enter ..." value="{{ $plan->name }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Description</label>
                                    <textarea name="plan_description" id="plan_description" class="form-control" rows="3" placeholder="Enter ...">{{ $plan->description }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Plan Price*</label>
                                    <input type="number" name="plan_price" id="plan_price" class="form-control" placeholder="Enter ..." value="{{ $plan->price }}" required readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Plan Discount</label><br/>
                                    <label class="switch">
                                        <input type="checkbox" name="plan_discount" id="plan_discount" {{ $plan->discount_check == '1' ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                    <input type="hidden" name="new_plan_discont" id="new_plan_discont" value="{{ $plan->discount_check }}"/>
                                </div>
                                <div id="plan_discount_container" class="form-group col-md-2" style="display: none;">
                                    <label>Plan Discount Percentage</label>
                                    <input type="number" name="plan_discount_percentage" id="plan_discount_percentage" class="form-control" placeholder="Enter ..." value="{{ $plan->discount_percentage }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>SIM Discount Percentage</label>
                                    <input type="number" name="sim_discount_percentage" id="sim_discount_percentage" class="form-control" placeholder="Enter ..." value="{{ $plan->sim_discount_percentage }}" required>
                                </div>
                            </div>
                            <div class="checkbox">
                                <label style="font-weight: 700;">
                                    <input type="checkbox" name="most_popular_plan" {{ $plan->goto_special_segment == '1' ? 'checked' : '' }}> Most Popular Plan
                                </label>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 img-upload">
                                    <div class="row">
                                        <label class="col-md-12">Plan Logo*</label>
                                        <img id="plan_img_preview" class="col-md-4" alt="plan image" src="{{URL::asset('/images/plans/'. $plan->logo)}}"/>
                                    </div>
                                    <div class="row">
                                        <label class="custom-img-upload col-md-4" id="img-up-btn">Change image</label>
                                        <input type="file" name="plan_logo" id="plan_logo" onchange="document.getElementById('plan_img_preview').src = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Plan Status</label><br/>
                                    <label class="switch">
                                        <input type="checkbox" name="plan_status" id="plan_status" {{ $plan->status == '1' ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                    <input type="hidden" name="new_plan_status" id="new_plan_status" value="{{ $plan->status }}"/>
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