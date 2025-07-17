@extends('layouts.admin-layout')

@section('content')
    @include('includes.admin-sidenav')
    
    @include('includes.admin-header')
    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Edit Order</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="/admin/orders">Orders</a></li>
                                <li class="breadcrumb-item"><a href="#">Edit Order</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start --> 
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Edit Order</h5>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <form action="{{ url('/admin/orders/edit/'.$order->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $order->id }}">
                                
                                <div class="header">
                                    <h5>Personal Info</h5>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="customer_name">Customer Name</label>
                                            <input type="text" name="customer_name" class="form-control" value="{{ $order->customer->name }}" required disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="customer_email">Customer Email</label>
                                            <input type="email" name="name" class="form-control" value="{{ $order->customer->email }}" required disabled>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label for="customer_phone">Customer Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $order->customer->phone }}" required disabled>
                                </div>
                                <div class="header">
                                    <h5>Order Details</h5>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="order_total">Order Total</label>
                                    <input type="number" name="total_amount" class="form-control" value="{{ $order->total_amount }}" required disabled>
                                </div>
                                <div class="header">
                                    <h5>Shipping Address</h5>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="address_line1">Address Line 1</label>
                                            <input type="text" name="address_1" class="form-control" value="{{ $order->address->address_1 }}" required disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <input type="text" name="city" class="form-control" value="{{ $order->address->city }}" required disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <input type="text" name="state" class="form-control" value="{{ $order->address->state }}" required disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="zip_code">Zip Code</label>
                                            <input type="text" name="zip_code" class="form-control" value="{{ $order->address->zip_code }}" required disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" name="country" class="form-control" value="{{ $order->address->country }}" required disabled>
                                </div>
                                {{-- <hr> --}}
                                <div class="form-group">
                                    <label for="order_status">Order Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Order</button>
                            </form>
                        </div>  
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection