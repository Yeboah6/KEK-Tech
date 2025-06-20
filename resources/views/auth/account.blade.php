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
								<p><span><i class="icon-location"></i></span> {{$data -> name}}</p>
							</div>
							<div class="col-md-3">
								<p><span><i class="icon-paperplane"></i></span> <a href="mailto:kekstudiosofficial1@gmail.com">{{ $data -> email}}</a></p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="contact-wrap">
							<h3>Account Infomation</h3>
							<form action="#" class="contact-form">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="lname">Full Name</label>
											<input type="text" id="lname" class="form-control" value="{{$data -> name}}" placeholder="Your Full Name">
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<label for="email">Email</label>
											<input type="text" id="email" class="form-control" value="{{$data -> email}}" placeholder="Your email address">
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<label for="subject">Password</label>
											<input type="text" id="subject" class="form-control" placeholder="New Password">
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
							<form action="#" class="contact-form">
								<div class="row">
                                    <div class="col-md-12">
										<div class="form-group">
											<label for="lname">Country</label>
											<input type="text" id="lname" class="form-control" value="{{$address -> country}}" placeholder="Your Full Name">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="lname">Full Name</label>
											<input type="text" id="lname" class="form-control" value="{{$address -> first_name}}" placeholder="Your Full Name">
										</div>
									</div>
                                    <div class="col-md-6">
										<div class="form-group">
											<label for="lname">Last Name</label>
											<input type="text" id="lname" class="form-control" value="{{$address -> last_name}}" placeholder="Your Full Name">
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<label for="email">Company Name</label>
											<input type="text" id="email" class="form-control" value="{{$address -> company_name}}" placeholder="Your email address">
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="subject">Address</label>
											<input type="text" id="subject" class="form-control" value="{{$address -> address_1}}" placeholder="Your subject of this message">
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label for="subject">City</label>
											<input type="text" id="subject" class="form-control" value="{{$address -> city}}" placeholder="Your subject of this message">
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label for="subject">Zip Code</label>
											<input type="text" id="subject" class="form-control" value="{{$address -> zip_code}}" placeholder="Your subject of this message">
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label for="subject">State</label>
											<input type="text" id="subject" class="form-control" value="{{$address -> state}}" placeholder="Your subject of this message">
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label for="subject">Email</label>
											<input type="text" id="subject" class="form-control" value="{{$address -> email}}" placeholder="Your subject of this message">
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label for="subject">Number</label>
											<input type="text" id="subject" class="form-control" value="{{$address -> number}}" placeholder="Your subject of this message">
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