@extends('layouts.admin-layout')
@section('content')

	 @include('includes.admin-sidenav')
	
     @include('includes.admin-header')
     
     <!-- [ Main Content ] start -->
     <div class="pcoded-main-container">
         <div class="pcoded-content">
             <!-- [ Main Content ] start -->
             <!-- profile header start -->
             <div class="user-profile user-card mb-4">
                 <div class="card-body py-0">
                     <div class="user-about-block m-0">
                         <div class="row">
                             <div class="col-md-8 mt-md-4">
                                 <div class="row">
                                     <div class="col-md-6">
                                        <div class="clearfix"></div>
                                        <a href="mailto:{{auth() -> user() -> email}}" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-mail mr-2 f-18"></i>{{auth() -> user() -> email}}</a>
                                        <div class="clearfix"></div>
                                     </div>
                                 </div>
                                 <ul class="nav nav-tabs profile-tabs nav-fill" id="myTab" role="tablist">
                                     <li class="nav-item">
                                         <a class="nav-link text-reset active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true"><i class="feather icon-user mr-2"></i>Profile</a>
                                     </li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- profile header end -->
     
             <!-- profile body start -->
             <div class="row">
                 <div class="col-md-8 order-md-2">
                     <div class="tab-content" id="myTabContent">
                         <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                             <div class="card">
                                 <div class="card-body d-flex align-items-center justify-content-between">
                                     <h5 class="mb-0">Admin details</h5>
                                     @if (Session::has('success'))
						                	<div class="alert alert-success">{{ Session::get('success') }}</div>
						                @endif
						                @if (Session::has('fail'))
						                	<div class="alert alert-danger">{{ Session::get('fail') }}</div>
						                @endif
                                     <button type="button" class="btn btn-primary btn-sm rounded m-0 float-right" data-toggle="collapse" data-target=".pro-det-edit" aria-expanded="false" aria-controls="pro-det-edit-1 pro-det-edit-2">
                                         <i class="feather icon-edit"></i>
                                     </button>
                                 </div>
                                 <div class="card-body border-top pro-det-edit collapse show" id="pro-det-edit-1">
                                         <div class="form-group row">
                                             <label class="col-sm-3 col-form-label font-weight-bolder">Email</label>
                                             <div class="col-sm-9">
                                               {{auth() -> user() -> email}}
                                             </div>
                                         </div>
                                 </div>
                                 <div class="card-body border-top pro-det-edit collapse " id="pro-det-edit-2">
                                     <form action="{{ route('admin.update.profile') }}" method="POST">
                                        @csrf

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label font-weight-bolder">Email</label>
                                                <div class="col-sm-9">
                                                   <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{auth() -> user() -> email}}">
                                                </div>
                                             </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label font-weight-bolder">Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{auth() -> user() -> name}}">
                                                </div>
                                            </div>
                                         <div class="form-group row">
                                            <label class="col-sm-3 col-form-label font-weight-bolder">Password</label>
                                            <div class="col-sm-9">
                                                <input type="passwrod" class="form-control" name="password" placeholder="Enter New Password">
                                            </div>
                                        </div>
                                         <div class="form-group row">
                                             <label class="col-sm-3 col-form-label"></label>
                                             <div class="col-sm-9">
                                                 <button type="submit" class="btn btn-primary" style="color: #fff">Update</button>
                                             </div>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- profile body end -->
         </div>
     </div>

     <script>
         // [ customer-scroll ] start
         var px = new PerfectScrollbar('.cust-scroll', {
             wheelSpeed: .5,
             swipeEasing: 0,
             wheelPropagation: 1,
             minScrollbarLength: 40,
         });
         // [ customer-scroll ] end
     </script>
     

 @endsection    