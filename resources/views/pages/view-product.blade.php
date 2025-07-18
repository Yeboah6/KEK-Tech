@extends('layouts.app')
@section('content')

<div id="page">
		@include('includes.header')

		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="/">Home</a></span> / <span>Product Details</span></p>
					</div>
				</div>
			</div>
		</div>


		<div class="colorlib-product">
			<div class="container">
				<div class="row row-pb-lg product-detail-wrap">
					<div class="col-sm-8">
						<div class="owl-carousel">
							<div class="item">
								<div class="product-entry">
									<a href="#" class="prod-img">
										<img src="{{asset('storage/uploads/product-images/'.$product -> product_image)}}" class="img-fluid" alt="{{$product -> product_name}}" style="width: 90%">
									</a>
								</div>
							</div>
							<div class="item">
								<div class="product-entry">
									<a href="#" class="prod-img">
										<img src="{{asset('storage/uploads/product-images/'.$product -> product_image2)}}" class="img-fluid" alt="{{$product -> product_name}}" style="width: 50%">
									</a>
								</div>
							</div>
							<div class="item">
								<div class="product-entry">
									<a href="#" class="prod-img">
										<img src="{{asset('storage/uploads/product-images/'.$product -> product_image3)}}" class="img-fluid" alt="{{$product -> product_name}}" style="width: 50%">
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="product-desc">
							<h3>{{$product -> product_name}}</h3>
							<p class="price">
								<span>¢{{$product -> price}}</span>
							</p>
							<p>{{$product -> stock_quantity}}</p>

                            <form action="{{ route('add.to.cart') }}" method="POST">
								@if (Session::has('success'))
				    	        	<div class="alert alert-success">{{ Session::get('success') }}</div>
				            	@endif
				            	@if (Session::has('fail'))
				            		<div class="alert alert-danger">{{ Session::get('fail') }}</div>
				            	@endif

								@csrf

								<div class="input-group mb-4">
									<span class="input-group-btn">
										<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
											<i class="icon-minus2"></i>
										</button>
									</span>
									<input type="text" id="quantity" name="cart_quantity" class="form-control input-number" value="1" min="1" max="100">
									<span class="input-group-btn ml-1">
										<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
											<i class="icon-plus2"></i>
										</button>
									</span>
								</div>
                                <input type="text" hidden name="product_id" value="{{$product -> id}}">
								@auth
									<input type="text" hidden name="customer_id" value="{{ auth()->user()->id }}">
								@endauth
							
                  				<div class="row">
	                  				<div class="col-sm-12 text-center">
										@auth
											<button type="submit" class="btn btn-primary btn-addtocart"> Add to Cart</button>
                                        @else
								        	<p class="addtocart"><a href="/signup" class="btn btn-primary btn-addtocart"><i class="icon-shopping-cart"></i> Add to Cart</a></p>
								        @endauth
									</div>
								</div>
							</form>
				        </div>
		        	</div>
		        </div>

				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-md-12 pills">
								<div class="bd-example bd-example-tabs">
								  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

								    <li class="nav-item">
								      <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Description</a>
								    </li>
								  </ul>

								  <div class="tab-content" id="pills-tabContent">
								    <div class="tab-pane border fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
								      <p>
										{{ $product -> description }}
										</p>
								    </div>
								  </div>
								</div>
				         </div>
						</div>
					</div>
				</div>
			</div>
		</div>

		@include('includes.footer')
	</div>

    <script>
		document.addEventListener('DOMContentLoaded', function () {
			const quantityInput = document.getElementById('quantity');
			const btnMinus = document.querySelector('.quantity-left-minus');
			const btnPlus = document.querySelector('.quantity-right-plus');
	
			// Function to update the quantity value
			function updateQuantity(delta) {
				let currentValue = parseInt(quantityInput.value) || 1;
				const minValue = parseInt(quantityInput.min) || 1;
				const maxValue = parseInt(quantityInput.max) || 100;
	
				currentValue += delta;
	
				if (currentValue < minValue) {
					currentValue = minValue;
				} else if (currentValue > maxValue) {
					currentValue = maxValue;
				}
	
				quantityInput.value = currentValue;
			}
	
			// Event listeners for buttons
			btnMinus.addEventListener('click', function () {
				updateQuantity(-1);
			});
	
			btnPlus.addEventListener('click', function () {
				updateQuantity(1);
			});
		});
	</script>


@endsection