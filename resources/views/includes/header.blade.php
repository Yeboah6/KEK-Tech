<nav class="colorlib-nav" role="navigation">
	<div class="top-menu">
		<div class="container">
			<div class="row">
				<div class="col-sm-7 col-md-9">
					<div id="colorlib-logo"><a href="/">KEK Tech</a></div>
				</div>
				<div class="col-sm-5 col-md-3">
	            	<form action="#" class="search-wrap">
	            	   <div class="form-group">
	            	      <input type="search" class="form-control search" placeholder="Search">
	            	      <button class="btn btn-primary submit-search text-center" type="submit"><i class="icon-search"></i></button>
	            	   </div>
	            	</form>
	         	</div>
	     	</div>
			<div class="row">
				<div class="col-sm-12 text-left menu-1">
					<ul>
						<li class="active"><a href="/">Home</a></li>
						<li><a href="{{ route('products') }}">Products</a></li>
						<li><a href="/contact">Contact</a></li>
						<li class="cart"><a href="/cart"><i class="icon-shopping-cart"></i> Cart [{{ $cartNo }}]</a></li>
						
						@auth
							<li class="has-dropdown cart">
								<a href="">{{ auth()->user()->name }}</a>
								<ul class="dropdown">
									<li><a href="/account">Account</a></li>
									<li><a href="/view-orders">View Orders</a></li>
									<li><a href="/logout">Logout</a></li>
								</ul>
							</li>
						@else
							<li class="cart"><a href="/signup">Sign Up</a></li>
							<li class="cart"><a href="/login">Login</a></li>
						@endauth
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="sale">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 offset-sm-2 text-center">
					<div class="row">
						<div class="owl-carousel2">
							<div class="item">
								<div class="col">
									<h3>Get Quality Products at KEK Tech</h3>
								</div>
							</div>
							<div class="item">
								<div class="col">
									<h3>New Arrivals every week</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</nav>