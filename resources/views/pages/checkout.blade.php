@extends('layouts.app')
@section('content')
		
	<div class="colorlib-loader"></div>

	<div id="page">
		@include('includes.header')
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="/index">Home</a></span> / <span>Checkout</span></p>
					</div>
				</div>
			</div>
		</div>


		<div class="colorlib-product">
			<div class="container">
				<div class="row row-pb-lg">
					<div class="col-sm-10 offset-md-1">
						<div class="process-wrap">
							<div class="process text-center active">
								<p><span>01</span></p>
								<h3>Shopping Cart</h3>
							</div>
							<div class="process text-center active">
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
				<div class="row">
				<div class="col-lg-8">
					<h2>Billing Details</h2>
					<form action="{{ url('/delivery-address') }}" method="POST" class="colorlib-form">
						@csrf
						@if (Session::has('success'))
				    	    	<div class="alert alert-success">{{ Session::get('success') }}</div>
				        @endif
				        @if (Session::has('fail'))
				        	<div class="alert alert-danger">{{ Session::get('fail') }}</div>
				        @endif
		              	<div class="row">
			               <div class="col-md-12">
			                  <div class="form-group">
			                  	<label for="country">Select Country</label>
			                     <div class="form-field">
			                     	<i class="icon icon-arrow-down3"></i>
			                        <select name="country" id="people" class="form-control">
				                      	<option value="#">Select country</option>
				                        <option value="Ghana">Ghana</option>
				                        <option value="Alaska">Alaska</option>
				                        <option value="China">China</option>
				                        <option value="Japan">Japan</option>
				                        <option value="Korea">Korea</option>
				                        <option value="Philippines">Philippines</option>
			                        </select>
			                     </div>
			                  </div>
			               	</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="fname">First Name</label>
									<input type="text" id="fname" name="first_name" class="form-control" placeholder="Your First name">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="lname">Last Name</label>
									<input type="text" id="lname" name="last_name" class="form-control" placeholder="Your Last name">
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="companyname">Company Name</label>
			            			<input type="text" id="companyname" name="company_name" class="form-control" placeholder="Company Name">
			            		</div>
			            	</div>

			            	<div class="col-md-12">
								<div class="form-group">
									<label for="fname">Address</label>
			            			<input type="text" id="address" name="address_1" class="form-control" placeholder="Enter Your Address">
			            		</div>
			            	  	<div class="form-group">
			            	  	  	<input type="text" id="address2" name="address_2" class="form-control" placeholder="Second Address">
			            	  	</div>
			            	</div>
						   
			            	<div class="col-md-12">
								<div class="form-group">
									<label for="companyname">Town/City</label>
			            	    	<input type="text" id="towncity" name="city" class="form-control" placeholder="Town or City">
			            	  	</div>
			            	</div>
						   
							<div class="col-md-6">
								<div class="form-group">
									<label for="stateprovince">State/Province</label>
									<input type="text" id="fname" name="state" class="form-control" placeholder="State Province">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="lname">Zip/Postal Code</label>
									<input type="text" id="zippostalcode" name="zip_code" class="form-control" placeholder="Zip / Postal">
								</div>
							</div>
								
							<div class="col-md-6">
								<div class="form-group">
									<label for="email">E-mail Address</label>
									<input type="email" id="email" name="email" class="form-control" placeholder="State Province">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="Phone">Phone Number</label>
									<input type="text" id="phoneNumber" name="phone" class="form-control" placeholder="Phone Number">
								</div>
							</div>
		               	</div>

						@if(isset($addresses) && count($addresses) > 0)
							<div class="text-center">
								<button type="button" class="btn btn-primary" disabled>You already have an address</button>
								<small class="text-danger d-block mt-2">You cannot add another address.</small>
							</div>
						@else
							<div class="text-center">
								<button type="submit" class="btn btn-primary">Add Address</button>
							</div>
						@endif
		            </form>

						@if(isset($addresses) && count($addresses) > 0)
							<form action="{{ route('save.address.to.order')}}" method="POST">
								@csrf
								<div class="row">
									<div class="col-md-12 text-center">
										@foreach ($addresses as $address)
											<input type="hidden" name="address_id" value="{{ $address->id }}">
											<input type="hidden" name="order_id" value="{{ $orderId }}">
										@endforeach
										<p>
											<button type="submit" class="btn btn-primary">Place Order</button>
										</p>
									</div>
								</div>
							</form>
						@else
							<div class="row">
								<div class="col-md-12 text-center">
									<p>
										<button type="button" class="btn btn-primary" disabled>Place Order</button>
									</p>
									<small class="text-danger">Please add an address to place your order.</small>
								</div>
							</div>
						@endif
					</div>

					<div class="col-lg-4">
						<div class="row">
							<div class="col-md-14">
								<div class="cart-detail">
									<h2>Cart Total</h2>
									<ul>
										<li>
											<span>Subtotal</span> <span>${{ number_format($total, 2) }}</span>
											<ul>
												@foreach ($joinedCart as $joinedCart)
													<li>
														<span style="font-weight: bold;">{{ $joinedCart -> cart_quantity }} x {{$joinedCart -> product -> product_name}}</span> <span>{{ isset($joinedCart -> product -> price) ? $joinedCart -> product -> price * $joinedCart -> cart_quantity : 'N/A' }}</span>
													</li>
												@endforeach
											</ul>
										</li>
										<li><span>Order Total</span> <span>${{ number_format($total, 2) }}</span></li>
									</ul>
								</div>
						   </div>
						   <div class="w-100"></div>
						   <br>
						   <div>
							   <h2>Payment Method</h2>
							   <h4># Cash on Delivery</h4>
							   <p>We accept cash on delivery for orders within Accra.</p> 
							   <h4># Cash before Delivery</h4>
							   <p>For orders outside Accra, payment is required before delivery.</p> 
							   <p>For any inquiries, please contact us at <strong>+233 24 123 4567</strong> or email us at <strong>
						   </div>
						</div>
					</div>
				</div>
			</div>
		</div>

		@include('includes.footer')
	</div>

@endsection

