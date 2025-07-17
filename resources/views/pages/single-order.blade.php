@extends('layouts.app')
@section('content')
		
	<div class="colorlib-loader"></div>

	<div id="page">
		@include('includes.header')

		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="/">Home</a></span> / <span><a href="/view-orders">My Orders</a></span> / <span>Order Details</span></p>
					</div>
				</div>
			</div>
		</div>

		<div class="colorlib-product">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 offset-lg-2">
						<div class="alert alert-info text-center">
							<h2><i class="icon-info"></i> Order Details</h2>
							<p>Here are the details of your order #{{ $order->order_number }}</p>
						</div>

						<div class="order-details">
							<h3>Order Summary</h3>
							<div class="row">
								<div class="col-md-6">
									<p><strong>Order Number:</strong> #{{ $order->order_number }}</p>
									<p><strong>Date:</strong> {{ $order->created_at->format('F j, Y \a\t g:i a') }}</p>
									<p><strong>Payment Method:</strong> {{ $order->payment_method ?? 'Cash on Delivery' }}</p>
								</div>
								<div class="col-md-6">
									<p><strong>Order Total:</strong> ${{ number_format($order->total_amount, 2) }}</p>
									<p><strong>Status:</strong> <span class="badge 
										@if($order->status == 'completed') badge-success
										@elseif($order->status == 'processing') badge-primary
										@elseif($order->status == 'shipped') badge-info
										@elseif($order->status == 'cancelled') badge-danger
										@else badge-secondary
										@endif">
										{{ ucfirst($order->status) }}
									</span></p>
								</div>
							</div>
						</div>

						<div class="order-items mt-5">
							<h3>Order Items ({{ $order->items->count() }})</h3>
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>Product</th>
											<th>Image</th>
											<th>Price</th>
											<th>Quantity</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
										@foreach($order->items as $item)
										<tr>
											<td>{{ $item->product->product_name }}</td>
											<td><img src="{{ asset('storage/uploads/product-images/'.$item->product->product_image) }}" alt="{{ $item->product->product_name }}" class="img-thumbnail" width="80"></td>
											<td>${{ number_format($item->price, 2) }}</td>
											<td>{{ $item->quantity }}</td>
											<td>${{ number_format($item->price * $item->quantity, 2) }}</td>
										</tr>
										@endforeach
									</tbody>
									<tfoot>
										<tr>
											<th colspan="4">Subtotal</th>
											<td>${{ number_format($order->total_amount, 2) }}</td>
										</tr>
										<tr>
											<th colspan="4">Shipping</th>
											<td>Free</td>
										</tr>
										<tr>
											<th colspan="4">Total</th>
											<td>${{ number_format($order->total_amount, 2) }}</td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>

						<div class="customer-details mt-5">
							<div class="row">
								<div class="col-md-6">
									<h3>Shipping Address</h3>
									@if($order->address)
									<address>
										<strong>{{ $order->address->first_name }} {{ $order->address->last_name }}</strong><br>
										{{ $order->address->address_1 }}<br>
										@if($order->address->address_2)
											{{ $order->address->address_2 }}<br>
										@endif
										{{ $order->address->city }}, {{ $order->address->state }} {{ $order->address->zip_code }}<br>
										{{ $order->address->country }}<br>
										<abbr title="Phone">P:</abbr> {{ $order->address->phone }}
									</address>
									@else
										<p>No shipping address provided</p>
									@endif
								</div>
                                <div class="col-md-6">
                                    <h3>Contact Information</h3>
                                    <p>
                                        <strong>Email:</strong> {{ $order->address->email ?? $order->customer->email }}<br>
                                        <strong>Phone:</strong> {{ $order->address->phone ?? $order->customer->phone }}
                                    </p>
                                    
                                    <h3 class="mt-4">Payment Instructions</h3>
                                    @php
										$state = strtolower(trim($order->address->state ?? ''));
										$isAccra = $state === 'greater accra' || $state === 'accra';
                                    @endphp
                                    @if($isAccra)
                                        <div class="alert alert-warning">
                                            <h4><i class="icon-credit-card"></i> Payment on Delivery</h4>
                                            <p>Please prepare exact cash amount for the delivery person.</p>
                                        </div>
                                    @else
                                        <div class="alert alert-warning">
                                            <h4><i class="icon-credit-card"></i> Cash before Delivery</h4>
                                            <p>Please prepare exact cash amount for the delivery person.</p>
                                        </div>
                                    @endif
                                </div>
							</div>
						</div>

						<div class="text-center mt-5">
							<a href="/products" class="btn btn-primary">Continue Shopping</a>
							<a href="/view-orders" class="btn btn-outline-primary">Back to My Orders</a>
							
							@if($order->status == 'processing')
								<button class="btn btn-outline-danger ml-2" id="cancelOrderBtn">Cancel Order</button>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>

		@include('includes.footer')
	</div>

	<style>
		.order-details, .order-items, .customer-details {
			background: #f9f9f9;
			padding: 20px;
			border-radius: 5px;
			margin-bottom: 30px;
		}
		.order-details h3, .order-items h3, .customer-details h3 {
			border-bottom: 1px solid #eee;
			padding-bottom: 10px;
			margin-bottom: 20px;
		}
		.table {
			width: 100%;
			margin-bottom: 1rem;
			color: #212529;
		}
		.table th, .table td {
			padding: 0.75rem;
			vertical-align: top;
			border-top: 1px solid #dee2e6;
		}
		.table thead th {
			vertical-align: bottom;
			border-bottom: 2px solid #dee2e6;
		}
		.img-thumbnail {
			padding: 0.25rem;
			background-color: #fff;
			border: 1px solid #dee2e6;
			border-radius: 0.25rem;
		}
	</style>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			// Cancel order button
			const cancelBtn = document.getElementById('cancelOrderBtn');
			if(cancelBtn) {
				cancelBtn.addEventListener('click', function() {
					if(confirm('Are you sure you want to cancel this order?')) {
						fetch('/orders/{{ $order->id }}/cancel', {
							method: 'POST',
							headers: {
								'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
								'Content-Type': 'application/json',
								'Accept': 'application/json'
							}
						})
						.then(response => response.json())
						.then(data => {
							if(data.success) {
								location.reload();
							} else {
								alert(data.message || 'Failed to cancel order');
							}
						})
						.catch(error => {
							console.error('Error:', error);
							alert('An error occurred while cancelling the order');
						});
					}
				});
			}
		});
	</script>

@endsection