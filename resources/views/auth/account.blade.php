@extends('layouts.app')
@section('content')
		
	<div class="colorlib-loader"></div>

    <div id="page">

        @include('includes.header')

        <div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="/">Home</a></span> / <span>Account</span></p>
					</div>
				</div>
			</div>
		</div>
        <div id="colorlib-contact">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h3>Account Information</h3>
						<div class="row contact-info-wrap">
							<div class="col-md-3">
								<p><span><i class="icon-location"></i></span> {{ auth()->user()->name }}</p>
							</div>
							<div class="col-md-3">
								<p><span><i class="icon-paperplane"></i></span> <a href="mailto:{{ auth()->user()->email }}">{{ auth()->user()->email }}</a></p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="contact-wrap">
							<h3>Account Infomation</h3>
							<form action="{{ route('update.profile') }}" method="POST" class="contact-form">
								@if (Session::has('success'))
				    	        <div class="alert alert-success">{{ Session::get('success') }}</div>
				            	@endif
				            	@if (Session::has('fail'))
				            		<div class="alert alert-danger">{{ Session::get('fail') }}</div>
				            	@endif

								@csrf
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="lname">Full Name</label>
											<input type="text" id="lname" name="name" class="form-control" value="{{ auth()->user()->name }}" placeholder="Your Full Name">
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<label for="email">Email</label>
											<input type="text" id="email" name="email" class="form-control" value="{{ auth()->user()->email }}" placeholder="Your email address">
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<label for="subject">Password</label>
											<input type="text" id="subject" name="password" class="form-control" placeholder="New Password">
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<input type="submit" value="Update" class="btn btn-primary">
										</div>
									</div>
								</div>
							</form>		
						</div>
					</div>

                    <div class="col-md-6">
						<div class="contact-wrap">
							<h3>Address</h3>
							<form action="{{ route('update.address') }}" method="POST" class="contact-form">
								@if (Session::has('success'))
				    	        <div class="alert alert-success">{{ Session::get('success') }}</div>
				            	@endif
				            	@if (Session::has('fail'))
				            		<div class="alert alert-danger">{{ Session::get('fail') }}</div>
				            	@endif

								@csrf
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="country">Country</label>
											<input type="text" id="country" name="country" class="form-control" value="{{ $address->country ?? 'Not added yet' }}" placeholder="">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="first_name">First Name</label>
											<input type="text" id="first_name" name="first_name" class="form-control" value="{{ $address->first_name ?? 'Not added yet' }}" placeholder="">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="last_name">Last Name</label>
											<input type="text" id="last_name" name="last_name" class="form-control" value="{{ $address->last_name ?? 'Not added yet' }}" placeholder="">
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<label for="company_name">Company Name</label>
											<input type="text" id="company_name" name="company_name" class="form-control" value="{{ $address->company_name ?? 'Not added yet' }}" placeholder="">
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="address_1">Address</label>
											<input type="text" id="address_1" name="address_1" class="form-control" value="{{ $address->address_1 ?? 'Not added yet' }}" placeholder="">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="city">City</label>
											<input type="text" id="city" name="city" class="form-control" value="{{ $address->city ?? 'Not added yet' }}" placeholder="">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="zip_code">Zip Code</label>
											<input type="text" id="zip_code" name="zip_code" class="form-control" value="{{ $address->zip_code ?? 'Not added yet' }}" placeholder="">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="state">State</label>
											<input type="text" id="state" name="state" class="form-control" value="{{ $address->state ?? 'Not added yet' }}" placeholder="">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="email_address">Email</label>
											<input type="text" id="email_address" name="email" class="form-control" value="{{ $address->email ?? 'Not added yet' }}" placeholder="">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="phone">Number</label>
											<input type="text" id="phone" name="phone" class="form-control" value="{{ $address->phone ?? 'Not added yet' }}" placeholder="">
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<input type="submit" value="Update" class="btn btn-primary">
										</div>
									</div>
								</div>
							</form>		
						</div>
					</div>
				</div>
			</div>
		</div>
    
    </div>

@endsection