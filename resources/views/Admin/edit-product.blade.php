@extends('layouts.admin-layout')

@section('content')
    @include('includes.admin-sidenav')
    
    @include('includes.admin-header')
    
    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Edit Product</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="/admin/products">Products</a></li>
                                <li class="breadcrumb-item"><a href="#">Edit Product</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Edit Product</h5>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <form action="{{ url('/admin/product/edit/'.$product -> id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                        <label for="product_name">Product Name</label>
                                        <input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}" required>
                                    </div>
                                </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <select name="category" class="form-control" required>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->category }}" {{ $product->category == $category->category ? 'selected' : '' }}>{{ $category->category }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="quantity">Quantity</label>
                                            <input type="number" name="stock_quantity" class="form-control" value="{{ $product->stock_quantity }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control" rows="5" required>{{ $product->description }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                    <label for="image">Product Image</label>
                                    <input type="file" name="product_image" class="form-control-file">
                                    @if($product->product_image)
                                        <img src="{{ asset('storage/uploads/product-images/'.$product->product_image) }}" alt="Product Image" class="img-thumbnail mt-2" style="max-width: 150px;">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="image">Product Image</label>
                                    <input type="file" name="product_image2" class="form-control-file">
                                    @if($product->product_image2)
                                        <img src="{{ asset('storage/uploads/product-images/'.$product->product_image2) }}" alt="Product Image" class="img-thumbnail mt-2" style="max-width: 150px;">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="image">Product Image</label>
                                    <input type="file" name="product_image3" class="form-control-file">
                                    @if($product->product_image3)
                                        <img src="{{ asset('storage/uploads/product-images/'.$product->product_image3) }}" alt="Product Image" class="img-thumbnail mt-2" style="max-width: 150px;">
                                    @endif
                                </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Update Product</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
