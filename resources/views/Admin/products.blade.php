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
                            <h5 class="m-b-10">Products</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="/orders">Products</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- customar project  start -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-sm-6">
                            </div>
                            <div class="col-sm-6 text-right">
                                <button class="btn btn-success btn-sm btn-round has-ripple" data-toggle="modal" data-target="#modal-report"><i class="feather icon-plus"></i> Product</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="report-table" class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Stock Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                         <tr>
                                            <td>{{ $product -> product_id}}</td>
                                            <td>{{ $product -> product_name}}</td>
                                            <td><img src="{{asset('storage/uploads/product-images/'.$product -> product_image)}}" alt="contact-img" title="contact-img" class="rounded mr-3" height="48" /></td>
                                            <td>¢{{ $product -> price }}</td>
                                            <td>{{ $product -> stock_quantity }}</td>
                                            <td>
                                                <a href="#" 
                                                    class="btn btn-info btn-sm view-product" 
                                                    data-toggle="modal" 
                                                    data-target="#modal-report2"
                                                    data-id="{{ $product -> product_id }}"
                                                    data-name="{{ $product -> product_name }}"
                                                    data-price="{{ $product -> price }}"
                                                    data-category="{{ $product -> category }}"
                                                    data-image="{{ asset('storage/uploads/product-images/'.$product -> product_image) }}"
                                                    data-image2="{{ asset('storage/uploads/product-images/'.$product -> product_image2) }}"
                                                    data-image3="{{ asset('storage/uploads/product-images/'.$product -> product_image3) }}"
                                                    data-quantity="{{ $product -> stock_quantity }}"
                                                    data-description="{{ $product -> description }}"
                                                    data-date="{{ $product -> created_at -> format('d / M / Y') }}">
                                                    <i class="feather icon-eye"></i>
                                                </a>
                                                <a href="{{ url('/admin/product/edit/'.$product -> id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i> </a>
                                                <a href="{{url('/admin/delete-product/'.$product -> id)}}" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i> </a>
                                            </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- customar project  end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>

        {{-- Display Add Products --}}
<div class="modal fade" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <input type="text" class="form-control" hidden name="product_id">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="Name">Product Name</label>
                                <input type="text" name="product_name" class="form-control" id="Name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="Category">Category</label>
                                <select class="form-control" name="category" id="Category">
                                    <option value=""></option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category -> category}}">{{ $category -> category}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="Price">Price</label>
                                <input type="text" class="form-control" name="price" id="Price" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="Quantity">Quantity</label>
                                <input type="text" class="form-control" name="stock_quantity" id="Quantity" placeholder="">
                            </div>
                        </div>
                    </div>
                    <p>Product Images</p>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group fill">
                                <label class="floating-label" for="Icon">Product Image</label>
                                <input type="file" class="form-control" name="product_image" id="Icon" placeholder="gc">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fill">
                                <label class="floating-label" for="Icon">Product Image</label>
                                <input type="file" class="form-control" name="product_image2" id="Icon" placeholder="gc">
                            </div>
                        </div>
                    </div>
                        <div class="form-group fill">
                            <label class="floating-label" for="Icon">Product Image</label>
                            <input type="file" class="form-control" name="product_image3" id="Icon" placeholder="gc">
                        </div>

                        <div class="form-group">
                            <label class="floating-label" for="Icon">Description</label>
                            <textarea name="description" class="form-control" cols="15" rows="10" placeholder="Type product description"></textarea>
                        </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Display View Product Details --}}
<div class="modal fade" id="modal-report2" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 800px;margin-left: -80px;">
            <div class="modal-header">
                <h5 class="modal-title">View Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img id="modalProductImage" src="" alt="Product Image" class="img-fluid rounded" style="max-height: 200px;">
                        </div>
                        <div class="col-md-8">
                            <h4 id="modalProductTitle"></h4>
                            <h6 id="modalProductId"></h6>
                            <p><strong>Price:</strong> <span id="modalProductPrice"></span></p>
                            <p><strong>Quantity:</strong> <span id="modalProductQuantity"></span></p>
                            <p><strong>Date:</strong> <span id="modalProductDate"></span></p>
                            <p><strong>Description:</strong> <span id="modalProductDescription"></span></p>
                        </div>
                    </div>
                </div>
            </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
        $(".view-product").click(function() {
        let productId = $(this).data('id');
        let productName = $(this).data('name');
        let productPrice = $(this).data('price');
        let productCategory = $(this).data('category');
        let productImage = $(this).data('image');
        let productImage2 = $(this).data('image2');
        let productImage3 = $(this).data('image3');
        let productQuantity = $(this).data('quantity');
        let productDescription = $(this).data('description');
        let productDate = $(this).data('date');
        
        // Set data in modal
        $("#modalProductId").text(productId);
        $("#modalProductTitle").text(productName);
        $("#modalProductPrice").html("¢" + productPrice);
        $("#modalProductCategory").text(productCategory);
        $("#modalProductQuantity").text(productQuantity);
        $("#modalProductDescription").text(productDescription);
        $("#modalProductDate").text(productDate);
        
        // Update images
        $("#modalProductImage").attr("src", productImage);
        $("#modalProductImage2").attr("src", productImage2);
        $("#modalProductImage3").attr("src", productImage3);
        });
    
    });
    </script>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
        </div>
    </div>
</div>
        

<!-- [ Main Content ] end -->

    <!-- Required Js -->
    <script src="../assets1/js/vendor-all.min.js"></script>

    <script src="../assets1/js/plugins/jquery.dataTables.min.js"></script>
    <script src="../assets1/js/plugins/dataTables.bootstrap4.min.js"></script>

    <script>
        // DataTable start
        $('#report-table').DataTable();
        // DataTable end
    </script>

@endsection

