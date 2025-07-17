@extends('layouts.app')
@section('content')
		
	<div class="colorlib-loader"></div>

	<div id="page">
		@include('includes.header')

		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="/">Home</a></span> / <span>Order Complete</span></p>
					</div>
				</div>
			</div>
		</div>

		<div class="colorlib-product">
			<div class="container">
				<div class="row row-pb-lg">
					<div class="col-sm-10 offset-md-1">
						<div class="process-wrap">
							<div class="process text-center">
								<p><span>01</span></p>
								<h3>Shopping Cart</h3>
							</div>
							<div class="process text-center">
								<p><span>02</span></p>
								<h3>Checkout</h3>
							</div>
							<div class="process text-center active">
								<p><span>03</span></p>
								<h3>Order Complete</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8 offset-lg-2">
						<div class="alert alert-success text-center">
							<h2><i class="icon-check"></i> Thank You For Your Order!</h2>
							<p>Your order has been received and is being processed.</p>
						</div>

						<div class="order-details">
							<h3>Order Details</h3>
							<div class="row">
								<div class="col-md-6">
									<p><strong>Order Number:</strong> #{{ $order->order_number }}</p>
									<p><strong>Date:</strong> {{ $order->created_at->format('F j, Y') }}</p>
									<p><strong>Total:</strong> ${{ number_format($order->total_amount, 2) }}</p>
								</div>
								<div class="col-md-6">
									<p><strong>Payment Method:</strong> {{ $order->payment_method ?? 'Not specified' }}</p>
									<p><strong>Status:</strong> <span class="badge badge-primary">{{ ucfirst($order->status) }}</span></p>
								</div>
							</div>
						</div>

						<div class="order-items mt-5">
							<h3>Order Items</h3>
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>Product</th>
											<th>Price</th>
											<th>Quantity</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
										@foreach($order->items as $item)
										<tr>
											<td>{{ $item->product->product_name }}</td>
											<td>${{ number_format($item->price, 2) }}</td>
											<td>{{ $item->quantity }}</td>
											<td>${{ number_format($item->price * $item->quantity, 2) }}</td>
										</tr>
										@endforeach
									</tbody>
									<tfoot>
										<tr>
											<th colspan="3">Subtotal</th>
											<td>${{ number_format($order->total_amount, 2) }}</td>
										</tr>
										<tr>
											<th colspan="3">Shipping</th>
											<td>Free</td>
										</tr>
										<tr>
											<th colspan="3">Total</th>
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
									@endif
								</div>
								<div class="col-md-6">
									<h3>Contact Information</h3>
									<p>
										<strong>Email:</strong> {{ $order->address->email ?? $order->customer->email }}<br>
										<strong>Phone:</strong> {{ $order->address->phone ?? $order->customer->phone }}
									</p>
								</div>
							</div>
						</div>

						<div class="text-center mt-5">
							<a href="/products" class="btn btn-primary">Continue Shopping</a>
							<a href="/view-orders" class="btn btn-outline-primary">View Your Orders</a>
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
	</style>

@endsection