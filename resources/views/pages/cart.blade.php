@extends('layouts.app')
@section('content')
		
	<div class="colorlib-loader"></div>

	<div id="page">
		@include('includes.header')

		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="/">Home</a></span> / <span>Shopping Cart</span></p>
					</div>
				</div>
			</div>
		</div>


		<div class="colorlib-product">
			<div class="container">
				<div class="row row-pb-lg">
					<div class="col-md-10 offset-md-1">
						<div class="process-wrap">
							<div class="process text-center active">
								<p><span>01</span></p>
								<h3>Shopping Cart</h3>
							</div>
							<div class="process text-center">
								<p><span>02</span></p>
								<h3>Checkout</h3>
							</div>
							<div class="process text-center">
								<p><span>03</span></p>
								<h3>Order Complete</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="row row-pb-lg">
					<div class="col-md-12">
						<div class="product-name d-flex">
							<div class="one-forth text-left px-4">
								<span>Product Details</span>
							</div>
							<div class="one-eight text-center">
								<span>Price</span>
							</div>
							<div class="one-eight text-center">
								<span>Quantity</span>
							</div>
							<div class="one-eight text-center">
								<span>Total</span>
							</div>
							<div class="one-eight text-center px-4">
								<span>Remove</span>
							</div>
						</div>

						@foreach ($joinedCart as $joinedCart)
						<div class="product-cart d-flex">
							<div class="one-forth">
								<div class="product-img" style="background-image: url({{asset('storage/uploads/product-images/'.$joinedCart -> product -> product_image)}});">
								</div>
								<div class="display-tc">
									<h3>{{$joinedCart -> product -> product_name}}</h3>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<span class="price">{{$joinedCart -> product -> price}}</span>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<p>{{$joinedCart -> cart_quantity}}</p>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									{{ isset($joinedCart -> product -> price) ? $joinedCart -> product -> price * $joinedCart -> cart_quantity : 'N/A' }}
									</span>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<a href="{{url('/remove-from-cart/'.$joinedCart -> id)}}" class="closed"></a>
								</div>
							</div>
						</div>
						@endforeach
						
					</div>
				</div>
				<div class="row row-pb-lg">
					<div class="col-md-12">
						<div class="total-wrap">
							<div class="row">
								<div class="col-sm-8">
									<form action="{{ route('save.to.order')}}" method="POST">
										@csrf
										<div class="row form-group">
											<div class="col-sm-3">
												<a href="/checkout"><input type="submit" value="Proceed to Checkout" class="btn btn-primary"></a>
												<input type="text" hidden name="total" value="{{ number_format($totalPrice) }}" class="form-control">
												<input type="text" hidden name="customer_id" value="{{ auth()->user()->id }}" class="form-control">
												@foreach ($customerCartIds as $cart_id)
													<input type="hidden" class="form-control" name="cart_ids[]" value="{{ $cart_id }}">
												@endforeach
											</div>
										</div>
									</form>
								</div>
								<div class="col-sm-4 text-center">
									<div class="total">
										<div class="sub">
											<p><span>Subtotal:</span> <span>¢{{ number_format($totalPrice, 2) }}</span></p>
											<p><span>Delivery:</span> <span>$0.00</span></p>
										</div>
										<div class="grand-total">
											<p><span><strong>Total:</strong></span> <span>¢{{ number_format($totalPrice, 2) }}</span></p>
										</div>
									</div>
									<br><br>
									<p><span><strong>NB:</strong></span> All Orders within Accra are Payment on Delivery</p>
												<strong><h1>&</h1></strong>
									<p><span><strong>NB:</strong></span> All Orders Outside of Accra are Payment Before Delivery</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		@include('includes.footer')
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="ion-ios-arrow-up"></i></a>
	</div>
	
@endsection

