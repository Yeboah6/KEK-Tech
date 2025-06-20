@extends('layouts.admin-layout')

@section('content')

    @include('includes.admin-sidenav')
	<!-- [ Header ] start -->
    @include('includes.admin-header')
	<!-- [ Header ] end -->
	
	

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="feather icon-home"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- seo analytics start -->
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3>{{ $products}}</h3>
                        <h4 class="text-muted">Products</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3>{{ $order }}</h3>
                        <h4 class="text-muted">Orders</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3>{{ $customers}}</h3>
                        <h4 class="text-muted">Customers</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6"></div>
            <div class="col-lg-12">
                <div class="card table-card latest-activity-card">
                    <div class="card-header">
                        <h5>Latest Order</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                    <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless mb-0">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Order ID</th>
                                        <th>Photo</th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>John Deo</td>
                                        <td>#814123</td>
                                        <td><img src="../assets/images/widget/PHONE1.jpg" alt="" class="img-fluid"></td>
                                        <td>Moto G5</td>
                                        <td>10</td>
                                        <td>17-2-2019</td>
                                        <td><label class="badge badge-light-warning">Pending</label></td>
                                        <td>
                                            {{-- <a href="#!"><i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i></a> --}}
                                            <a href="#!"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jenny William</td>
                                        <td>#684898</td>
                                        <td><img src="../assets/images/widget/PHONE2.jpg" alt="" class="img-fluid"></td>
                                        <td>iPhone 8</td>
                                        <td>16</td>
                                        <td>20-2-2019</td>
                                        <td><label class="badge badge-light-primary">Paid</label></td>
                                        <td>
                                            {{-- <a href="#!"><i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i></a> --}}
                                            <a href="#!"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection