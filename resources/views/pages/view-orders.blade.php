@extends('layouts.app')
@section('content')
		
	<div class="colorlib-loader"></div>

	<div id="page">
		@include('includes.header')

		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="/">Home</a></span> / <span><a href="/account">Account</a></span> / <span>My Orders</span></p>
					</div>
				</div>
			</div>
		</div>

		<div class="colorlib-product">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<h2 class="mb-4">My Orders</h2>
						
						@if($orders->isEmpty())
							<div class="alert alert-info">
								<p>You haven't placed any orders yet.</p>
								<a href="/products" class="btn btn-primary">Browse Products</a>
							</div>
						@else
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead class="thead-primary">
										<tr>
											<th>Order #</th>
											<th>Date</th>
											<th>Items</th>
											<th>Total</th>
											<th>Status</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										@foreach($orders as $order)
										<tr>
											<td>#{{ $order->order_number }}</td>
											<td>{{ $order->created_at->format('M d, Y') }}</td>
											<td>{{ $order->items->sum('quantity') }}</td>
											<td>${{ number_format($order->total_amount, 2) }}</td>
											<td>
												<span>
                                                    @if ($order -> status == 'Completed') 
                                                        <span class="badge badge-success">Completed</span>
                                                    @elseif ($order -> status == 'Processing')
                                                        <span class="badge badge-primary">Processing</span>
                                                    @elseif ($order -> status == 'Cancelled')
                                                        <span class="badge badge-danger">Cancelled</span>
                                                    @elseif($order -> status == 'pending')
                                                        <span class="badge badge-secondary">Pending</span>
                                                    @endif
                                                </span>
											</td>
											<td>
												<a href="{{ url('/view-orders/'.$order -> id) }}" class="btn btn-sm btn-primary">View</a>
												@if($order->status == 'Processing')
													<button class="btn btn-sm btn-outline-danger cancel-order" data-order-id="{{ $order->id }}">Cancel</button>
												@endif
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>

		@include('includes.footer')
	</div>

	<style>
		.table {
			width: 100%;
			margin-bottom: 1rem;
			background-color: transparent;
		}
		.table th {
			background-color: #88C8BC;
			color: white;
			padding: 12px 15px;
		}
		.table td {
			padding: 12px 15px;
			vertical-align: middle;
		}
		.table-bordered {
			border: 1px solid #dee2e6;
		}
		.table-bordered th,
		.table-bordered td {
			border: 1px solid #dee2e6;
		}
		.badge {
			display: inline-block;
			padding: 0.25em 0.4em;
			font-size: 75%;
			font-weight: 700;
			line-height: 1;
			text-align: center;
			white-space: nowrap;
			vertical-align: baseline;
			border-radius: 0.25rem;
		}
		.badge-primary { background-color: #007bff; }
		.badge-success { background-color: #28a745; }
		.badge-danger { background-color: #dc3545; }
		.badge-secondary { background-color: #6c757d; }
	</style>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			// Handle order cancellation
			document.querySelectorAll('.cancel-order').forEach(button => {
				button.addEventListener('click', function() {
					const orderId = this.getAttribute('data-order-id');
					if (confirm('Are you sure you want to cancel this order?')) {
						fetch(`/orders/${orderId}/cancel`, {
							method: 'POST',
							headers: {
								'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
								'Content-Type': 'application/json',
								'Accept': 'application/json'
							}
						})
						.then(response => response.json())
						.then(data => {
							if (data.success) {
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
			});
		});
	</script>

@endsection