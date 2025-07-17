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
                            <h5 class="m-b-10">Orders</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="/orders">Orders</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- customar project  start -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-sm-6">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="report-table" class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Product</th>
                                        <th>Image</th>
                                        <th>Added Date</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $joinedOrder)
                                        @foreach ($joinedOrder -> items as $item)
                                         <tr>
                                            <td>{{ $joinedOrder -> order_number}}</td>
                                            <td> {{ $joinedOrder -> customer -> name}}</td>
                                            <td>{{ $item -> product -> product_name}}</td>
                                            <td><img src="{{asset('storage/uploads/product-images/'.$item -> product -> product_image)}}" alt="contact-img" title="contact-img" class="rounded mr-3" height="48" /></td>
                                            <td>{{ $item -> created_at->format('d-m-Y') }}</td>
                                            <td>{{ $item -> price }}</td>
                                            <td>
                                                <span>
                                                    @if ($joinedOrder -> status == 'Completed') 
                                                        <span class="badge badge-success">Completed</span>
                                                    @elseif ($joinedOrder -> status == 'Processing')
                                                        <span class="badge badge-primary">Processing</span>
                                                    @elseif ($joinedOrder -> status == 'Cancelled')
                                                        <span class="badge badge-danger">Cancelled</span>
                                                    @elseif($joinedOrder -> status == 'pending')
                                                        <span class="badge badge-secondary">Pending</span>
                                                    @endif
                                                </span>
                                            <td>
                                            <a href="#" 
                                                class="btn btn-info btn-sm view-order" 
                                                data-toggle="modal" 
                                                data-target="#orderDetailsModal"
                                                data-order-number="{{ $joinedOrder->order_number }}"
                                                data-customer-name="{{ $joinedOrder->customer->name }}"
                                                data-customer-email="{{ $joinedOrder->customer->email }}"
                                                data-product-name="{{ $item->product->product_name }}"
                                                data-product-image="{{ asset('storage/uploads/product-images/'.$item->product->product_image) }}"
                                                data-order-date="{{ $joinedOrder->created_at->format('d-m-Y') }}"
                                                data-order-total="${{ number_format($joinedOrder->total_amount, 2) }}"
                                                data-order-status="{{ ucfirst($joinedOrder->status) }}"
                                                data-order-items="{{ $joinedOrder->items->count() }}"
                                                data-order-quantity="{{ $item->quantity }}"
                                                data-item-price="${{ number_format($item->price, 2) }}"
                                                data-address-line1="{{ $joinedOrder->address->address_1 ?? 'N/A' }}"
                                                data-address-city="{{ $joinedOrder->address->city ?? 'N/A' }}"
                                                data-address-state="{{ $joinedOrder->address->state ?? 'N/A' }}"
                                                data-address-zip="{{ $joinedOrder->address->phone ?? 'N/A' }}"
                                                data-address-country="{{ $joinedOrder->address->country ?? 'N/A' }}">
                                                <i class="feather icon-eye"></i>
                                                </a>
                                            <a href="{{url('/admin/orders/edit/'.$joinedOrder -> id) }}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i> </a>
                                            {{-- <a href="{{ url('/admin/orders/delete/'.$joinedOrder -> id)}}" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i> </a> --}}
                                        </td>
                                    </tr>
                                     @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- customar project  end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>

        Display View Product Details
        <div class="modal fade" id="orderDetailsModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 800px;margin-left: -80px;">
                    <div class="modal-header">
                        <h5 class="modal-title">View Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
        
                    <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Order Information</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Order Number:</strong> <span id="modalOrderNumber"></span></p>
                                <p><strong>Order Date:</strong> <span id="modalOrderDate"></span></p>
                                <p><strong>Status:</strong> <span id="modalOrderStatus" class="badge"></span></p>
                                <p><strong>Total Amount:</strong> <span id="modalOrderTotal"></span></p>
                                <p><strong>Items Count:</strong> <span id="modalOrderItems"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Customer Information</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Name:</strong> <span id="modalCustomerName"></span></p>
                                <p><strong>Email:</strong> <span id="modalCustomerEmail"></span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h6>Delivery Address</h6>
                            </div>
                            <div class="card-body">
                                <p><strong>Address:</strong> <span id="modalAddressLine1"></span></p>
                                <p><strong>City:</strong> <span id="modalAddressCity"></span></p>
                                <p><strong>State:</strong> <span id="modalAddressState"></span></p>
                                <p><strong>Number:</strong> <span id="modalAddressZip"></span></p>
                                <p><strong>Country:</strong> <span id="modalAddressCountry"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Product Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img id="modalProductImage" src="" alt="Product Image" class="img-fluid rounded" style="max-height: 200px;">
                            </div>
                            <div class="col-md-8">
                                <h4 id="modalProductName"></h4>
                                <p><strong>Price:</strong> <span id="modalItemPrice"></span></p>
                                <p><strong>Quantity:</strong> <span id="modalItemQuantity"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                $('.view-order').on('click', function() {

            // Set all the modal fields from data attributes
            $('#modalOrderNumber').text($(this).data('order-number'));
            $('#modalOrderDate').text($(this).data('order-date'));
            $('#modalOrderTotal').text($(this).data('order-total'));
            $('#modalOrderItems').text($(this).data('order-items'));
            $('#modalCustomerName').text($(this).data('customer-name'));
            $('#modalCustomerEmail').text($(this).data('customer-email'));
            $('#modalProductName').text($(this).data('product-name'));
            $('#modalItemPrice').text($(this).data('item-price'));
            $('#modalItemQuantity').text($(this).data('order-quantity'));

            // Delivery Address
            $('#modalAddressLine1').text($(this).data('address-line1'));
            $('#modalAddressLine2').text($(this).data('address-line2'));
            $('#modalAddressCity').text($(this).data('address-city'));
            $('#modalAddressState').text($(this).data('address-state'));
            $('#modalAddressZip').text($(this).data('address-zip'));
            $('#modalAddressCountry').text($(this).data('address-country'));
            
            // Set product image
            $('#modalProductImage').attr('src', $(this).data('product-image'));
            
            // Set status badge
            const status = $(this).data('order-status').toLowerCase();
            const badge = $('#modalOrderStatus');
            
            // Remove all badge classes
            badge.removeClass('badge-success badge-primary badge-danger badge-secondary');
            
            // Add the appropriate class based on status
            if (status === 'completed') {
                badge.addClass('badge-success');
            } else if (status === 'processing') {
                badge.addClass('badge-primary');
            } else if (status === 'cancelled') {
                badge.addClass('badge-danger');
            } else {
                badge.addClass('badge-secondary');
            }
            
            // Set the status text
            badge.text($(this).data('order-status'));
        });
                });
            </script>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
                </div>
            </div>
        </div>
        

<!-- [ Main Content ] end -->

    <!-- Required Js -->
    <script src="../assets1/js/vendor-all.min.js"></script>

    <script src="../assets1/js/plugins/jquery.dataTables.min.js"></script>
    <script src="../assets1/js/plugins/dataTables.bootstrap4.min.js"></script>

    <script>
        // DataTable start
        $('#report-table').DataTable();
        // DataTable end
    </script>

@endsection
