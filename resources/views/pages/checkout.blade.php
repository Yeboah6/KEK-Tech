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
						

							<style>

                			/* Spinner Animation */
                			.spinner {
                			    display: inline-block;
                			    width: 20px;
                			    height: 20px;
                			    border: 3px solid rgba(255, 255, 255, 0.3);
                			    border-top: 3px solid #fff;
                			    border-radius: 50%;
                			    animation: spin 1s linear infinite;
                			    margin-right: 8px;
                			    vertical-align: middle;
								background-color: #616161;
                			}
						
                			@keyframes spin {
                			    0% { transform: rotate(0deg); }
                			    100% { transform: rotate(360deg); }
                			}
                
                		</style>
							<h2>Billing Details</h2>
							<form action="{{ url('/delivery-address') }}" method="POST" class="colorlib-form">
							@csrf
							@if (Session::has('success'))
				    	        	<div class="alert alert-success">{{ Session::get('success') }}</div>
				            @endif
				            @if (Session::has('fail'))
				            	<div class="alert alert-danger">{{ Session::get('fail') }}</div>
				            @endif
							<input type="text" name="customer_id" hidden value="{{ $data -> id}}">
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
											<input type="text" id="phoneNumber" name="number" class="form-control" placeholder="Phone Number">
										</div>
									</div>
		               				</div>
									   <div class="my-3">
										<div class="error-message text-danger" class="loading" style="display: none;"></div>
										<div class="sent-message text-success" style="display: none;">Your message has been sent. Thank you!</div>
									  </div>

									  <div class="text-center">
										<button type="submit" class="btn btn-primary">Add Address</button>
									</div>
		            			</form>

						        <!-- ✅ AJAX Script -->
								{{-- <script>
									document.addEventListener("DOMContentLoaded", function () {
    									document.getElementById("contactForm").addEventListener("submit", function (event) {
    									    event.preventDefault(); // Prevent page reload
										
    									    let formData = new FormData(this);
    									    let sendMessageBtn = document.getElementById("sendMessageBtn");
											let loadingImg = `<img class="spinner" src="{{ asset('../assets/images/icons8-spinner.gif') }}" alt="Loading..." width="25">`;
    									    // let loadingImg = document.querySelector(".loading");
    									    let errorMessage = document.querySelector(".error-message");
    									    let sentMessage = document.querySelector(".sent-message");
										
    									    sendMessageBtn.disabled = true;
    									    // loading.style.display = "block";
											sendMessageBtn.innerHTML = loadingImg; // Replace text with spinner
    									    errorMessage.style.display = "none";
    									    sentMessage.style.display = "none";
										
    									    fetch("{{ url('/delivery-address') }}", {
    									        method: "POST",
    									        body: formData,
    									        headers: {
    									            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
    									        }
    									    })
    									    .then(response => response.json())
    									    .then(data => {
    									        sendMessageBtn.disabled = false;
    									        loadingImg.style.display = "none";
											
    									        if (data.success) {
    									            sentMessage.style.display = "block";
    									            sentMessage.innerHTML = data.message;
    									            document.getElementById("contactForm").reset();
    									        } else {
    									            errorMessage.style.display = "block";
    									            errorMessage.innerHTML = data.message;
    									        }
    									    })
    									    .catch(error => {
    									        sendMessageBtn.disabled = false;
    									        loadingImg.style.display = "none";
    									        errorMessage.style.display = "block";
    									        errorMessage.innerHTML = "Something went wrong. Please try again.";
    									    });
    									});
									});

								</script> --}}

						<form action="{{ route('save.address.to.order')}}" method="POST">
							@csrf
							<div class="row">
								<div class="col-md-12 text-center">
									@foreach ($address as $address)
										<input type="text" name="address_id" value="{{ $address -> address_id }}">
									@endforeach
									{{-- @foreach ($joinedCart as $joinedCart) { --}}
										{{-- <input type="text" name="order_id" value="{{ $joinedCart -> order_id }}"> --}}
									{{-- } --}}
									{{-- @endforeach --}}
									<p><button type="submit" class="btn btn-primary">Place Order</button></p>
								</div>
							</div>
						</form>
					</div>

					<div class="col-lg-4">
						<div class="row">
							<div class="col-md-12">
								<div class="cart-detail">
									<h2>Cart Total</h2>
									<ul>
										<li>
											<span>Subtotal</span> <span>${{ number_format($total, 2) }}</span>
											<ul>
												@foreach ($joinedCart as $joinedCart)
													<li>
														<span style="font-weight: bold;">{{ $joinedCart -> cart_quantity }} x {{$joinedCart -> product_name}}</span> <span>{{ isset($joinedCart -> price) ? $joinedCart -> price * $joinedCart -> cart_quantity : 'N/A' }}</span>
													</li>
												@endforeach
											</ul>
										</li>
										<li><span>Order Total</span> <span>${{ number_format($total, 2) }}</span></li>
									</ul>
								</div>
						   </div>

						   <div class="w-100"></div>

						   {{-- <form action="{{ url('/checkout') }}" method="post">
								@if (Session::has('success'))
				    	        	<div class="alert alert-success">{{ Session::get('success') }}</div>
				            	@endif
				            	@if (Session::has('fail'))
				            		<div class="alert alert-danger">{{ Session::get('fail') }}</div>
				            	@endif
								@csrf
								<div class="col-md-12">
									<div class="cart-detail">
										<h2>Payment Method</h2>
										<div class="form-group">
											<div class="col-md-12">
												<div class="radio">
												<label><input type="radio" name="Mobile_money"> Mobile Money</label>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="radio">
												<label for="lname" style="font-weight: bold;">Mobile Number</label>
												<input type="text" id="mobile_number" name="mobile_number" class="form-control" placeholder="Enter Mobile Number" style="width: 260px;">
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<button type="submit" class="btn btn-primary">Make Payment</button>
											</div>
										</div>
									</div>
								</div>
						   </form> --}}
						
						</div>
						
					</div>
				</div>
			</div>
		</div>

		@include('includes.footer')
	</div>

@endsection

