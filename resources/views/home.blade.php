@extends('layouts.app')

@section('content')
<section id="login">
    <div class="shadow-overlay"></div>
        <div class="sdcontainer">
            <div class="row">
                <div class="col-md-12"><h1 style="color: #fff;">My Account</h1></div>
                <div class="col-md-12">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="panel panel-login">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12">
                                <h1>{{ old('tabName') }}</h1>
                                </div>                                
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 my-account">                                        
                                    <ul class="nav nav-tabs" id="tabMenu">
                                        <li class="{{ $tabName == 'home' && old('tabName') != 'account' && old('tabName') != 'password' ? 'active' : '' }}"><a data-toggle="tab" href="#home">My Orders</a></li>
                                        <li class="{{ old('tabName') == 'account' ? 'active' : '' }}"><a data-toggle="tab" href="#account">Account Info</a></li>
                                        <li class="{{ old('tabName') == 'password' ? 'active' : '' }}"><a data-toggle="tab" href="#password">Change Password</a></li>
                                    </ul>                                    
                                    <div class="tab-content">
                                        <div id="home" class="tab-pane fade {{ $tabName == 'home' && old('tabName') != 'account' && old('tabName') != 'password' ? 'active in' : '' }}">
                                            <h3></h3>
                                            <table style="width:100%">
                                                <tr>
                                                    <th>Order #</th>
                                                    <th>Date</th>
                                                    <th>Items</th>
                                                    <th>Total($)</th>
                                                    <th>Order status</th>
                                                    <th>Payment</th>
                                                    <th></th>
                                                </tr>
                                                @foreach($order_details as $od)
                                                <tr>
                                                    <td><?php echo 'RMP_'. $od->id; ?></td>
                                                    <td><?php echo date('M d, Y', strtotime($od->created_at)); ?></td> 
                                                    <td>{{$od->items_count}}</td>
                                                    <td>{{$od->total}}</td>
                                                    <td>
                                                        <div class="status pending">
                                                            @if($od->order_status == 'P5%')
                                                                Pending
                                                            @endif
                                                        </div>
                                                    </td> 
                                                    <td><div class="status completed">{{$od->payment_status}}</div></td>
                                                    <td></td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                        <div id="account" class="tab-pane fade {{ !empty(old('tabName')) && old('tabName') == 'account' ? 'active in' : '' }}">
                                            <h3></h3>
                                            <form role="form" id="customer_info_form" class="account-form" action="{{ route('user.edit.post',[$customer->id]) }}" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>Name</label>
                                                            <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Enter ..." value="{{ $customer->name }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>Email</label>
                                                            <input type="email" name="customer_email" id="customer_email" class="form-control" placeholder="Enter ..." value="{{ $customer->email }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>Mobile Number</label>
                                                            <input type="text" name="customer_phone_number" id="customer_phone_number" class="form-control" placeholder="(012) 345-6789" value="{{ $customer->phone_number }}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>Registered Date and Time</label>
                                                            <input type="text" name="customer_registration_date" id="customer_registration_date" class="form-control" placeholder="Enter ..." value="{{ $customer->created_at }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->                                    
                                                <div class="box-footer">
                                                    <button type="submit" class="button checkout s-c-d-button" id="customer_submit_btn">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div id="password" class="tab-pane fade {{ !empty(old('tabName')) && old('tabName') == 'password' ? 'active in' : '' }}">
                                            <h3></h3>
                                            <form role="form" id="change_password_form" class="account-form" action="{{ route('changePassword') }}" method="post">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="col-md-6 form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                                                            <label>Current Password</label>
                                                            <input type="password" name="current_password" id="current_password" class="form-control" placeholder="..." required>
                                                            @if($errors->has('current_password'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('current_password') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                                                            <label>New Password</label>
                                                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="..." required>
                                                            @if($errors->has('new_password'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('new_password') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 form-group{{ $errors->has('c_new_password') ? ' has-error' : '' }}">
                                                            <label>Confirm New Password</label>
                                                            <input type="password" name="c_new_password" id="c_new_password" class="form-control" placeholder="..." required>
                                                            @if($errors->has('c_new_password'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('c_new_password') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->
                                    
                                                <div class="box-footer">
                                                    <button type="submit" class="button checkout s-c-d-button" id="customer_pasword_submit_btn" style="width: 170px;">Change Password</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>                         
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            //redirect to specific tab
            /*$(document).ready(function () {
                $('#tabMenu a[href="#{{ old('tabName') }}"]').tab('show');
            });*/
        </script>
    
    </section>
@endsection