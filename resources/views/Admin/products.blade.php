@extends('layouts.admin-layout')

@section('content')
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
    @include('includes.admin-sidenav')
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
    @include('includes.admin-header')
	<!-- [ Header ] end -->
	
	

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Product</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Product</a></li>
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
                                <thead class="thead-light">
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($products as $product)
                                       <tr>
                                             <td>{{ $product -> product_id}}</td>
                                       <td class="align-middle">
                                           <img src="{{asset('storage/uploads/product-images/'.$product -> product_image)}}" alt="contact-img" title="contact-img" class="rounded mr-3" height="48" />
                                            <p class="m-0 d-inline-block align-middle font-16">
                                               <a href="#!" class="text-body">{{ $product -> product_name}}</a>
                                               <br />
                                           </p> 
                                       </td>
                                       <td class="align-middle">
                                           {{ $product -> category}}
                                       </td>
                                       <td class="align-middle">
                                           ${{ $product -> price}}
                                       </td>
                                   
                                       <td class="align-middle">
                                           {{ $product -> quantity}}
                                       </td>
                                       <td class="table-action">
                                        <a href="#" 
                                            class="btn btn-icon btn-outline-primary view-product" 
                                            data-toggle="modal" 
                                            data-target="#modal-report2"
                                            data-id="{{ $product -> product_id }}"
                                            data-name="{{ $product -> product_name }}"
                                            data-price="{{ $product -> price }}"
                                            data-category="{{ $product -> category }}"
                                            data-image="{{ asset('storage/uploads/product-images/'.$product -> product_image) }}"
                                            data-image2="{{ asset('storage/uploads/product-images/'.$product -> product_image2) }}"
                                            data-image3="{{ asset('storage/uploads/product-images/'.$product -> product_image3) }}"
                                            data-quantity="{{ $product -> quantity }}"
                                            data-description="{{ $product -> description }}"
                                            data-date="{{ $product -> created_at -> format('d / M / Y') }}">
                                        <i class="feather icon-eye"></i>
                                        </a>
                                     
                                           <a href="#!"  data-toggle="modal" data-target="#modal-report3" class="btn btn-icon btn-outline-success"><i class="feather icon-edit"></i></a>
                                           <a href="{{'/admin/delete-product/'.$product -> id}}" class="btn btn-icon btn-outline-danger"><i class="feather icon-trash-2"></i></a>
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
                                <input type="text" class="form-control" name="quantity" id="Quantity" placeholder="">
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
                            <textarea name="description" class="form-control" cols="25" rows="10" placeholder="Type product description"></textarea>
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
                <div class="row">
                    <div class="col-12">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img id="modalProductImage" src="" class="d-block w-100" alt="Product images">
                                            </div>
                                            <div class="carousel-item">
                                                <img id="modalProductImage2" src="" class="d-block w-100" alt="Product images">
                                            </div>
                                            <div class="carousel-item">
                                                <img id="modalProductImage3" src="" class="d-block w-100" alt="Product images">
                                            </div>
                                        </div>
                                        <ol class="carousel-indicators position-relative">
                                            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="w-25 h-auto active">
                                                <img id="modalProductImage" src="" class="d-block wid-50" alt="Product images">
                                                {{-- <img src="{{asset('storage/uploads/product-images/'.$product -> product_image)}}" class="d-block wid-50" alt="Product images"> --}}
                                            </li>
                                            <li data-target="#carouselExampleCaptions" data-slide-to="1" class="w-25 h-auto">
                                                <img id="modalProductImage2" src="" class="d-block wid-50" alt="Product images2">
                                                {{-- <img src="{{asset('storage/uploads/product-images/'.$product -> product_image2)}}" class="d-block wid-50" alt="Product images"> --}}
                                            </li>
                                            <li data-target="#carouselExampleCaptions" data-slide-to="2" class="w-25 h-auto">
                                                <img id="modalProductImage3" src="" class="d-block wid-50" alt="Product images3">
                                                {{-- <img src="{{asset('storage/uploads/product-images/'.$product -> product_image3)}}" class="d-block wid-50" alt="Product images"> --}}
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <h6 class="text-muted" id="modalProductId"></h6>
                                    <h3 class="mt-0"><span id="modalProductTitle"></span></h3>
                                    <p class="mb-1">Added Date: <span id="modalProductDate"></span></p>
                                    <p class="mb-1">Stock: <span id="modalProductQuantity"></span></p>
                                    <p class="mb-1">Category: <span id="modalProductCategory"></span></p>
                                    <div class="mt-3">
                                    </div>
                                    <div class="mt-4">
                                        <h6>Price:</h6>
                                        <h3 id="modalProductPrice"></h3>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mt-4">
                                            <h6>Description:</h6>
                                            <p id="modalProductDescription">
                                            </p>
                                        </div>
                                    </div>
                                    <p id="modalProductDescription"></p>
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

                                                console.log("Image URLs:", productImage, productImage2, productImage3); // Debugging
                                            
                                                // Set data in modal
                                                $("#modalProductId").text(productId);
                                                $("#modalProductTitle").text(productName);
                                                $("#modalProductPrice").html("$" + productPrice);
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

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    {{-- Display Edit Product --}}
<div class="modal fade" id="modal-report3" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 800px;margin-left: -80px;">
            <div class="modal-header">
                <h5 class="modal-title">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('') }}" method="POST" enctype="multipart/form-data">
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
                                    <option value="Kids cloths">Kids cloth</option>
                                    <option value="Man cloths">Man cloth</option>
                                    <option value="Woman cloth">Woman cloath</option>
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
                                <input type="text" class="form-control" name="quantity" id="Quantity" placeholder="">
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
                        <div class="form-group fill">
                            <label class="floating-label" for="Icon">Description</label>
                            <textarea name="description" class="form-control" cols="25" rows="10" placeholder="Type product description"></textarea>
                        </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->

    <!-- Required Js -->
    <script src="../assets1/js/vendor-all.min.js"></script>

<script src="../assets1/js/plugins/jquery.dataTables.min.js"></script>
<script src="../assets1/js/plugins/dataTables.bootstrap4.min.js"></script>
<!-- Apex Chart -->
<script src="../assets1/js/plugins/apexcharts.min.js"></script>
<script>
    // DataTable start
    $('#report-table').DataTable({
        "lengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ]
    });
    // DataTable end
</script>


@endsection
