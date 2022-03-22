@extends('layouts.app')
@section('content')
@section('title', 'Products')
<!-- Start Main Header Page -->
@section('header-page', 'Products')
@section('title-page', 'Add')
<!-- End Main Header Page -->

<div class="jumbotron p-2 m-4">
    <h3 class="">
        <a class="btn btn-primary btn-lg" href="{{ route('product.index') }}" role="button">View All Products </a>
    </h3>
</div>
<h1 class=" p-3 border display-4"> Add New Product </h1>
<div class="container">
    <div class="row">
        <div class="col-10 mx-auto">
            {{-- @include('layouts.inc.message') --}}
            <div id="message"></div>

            {{-- <form class="p-4 m-3 border bg-gradient-info" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data"> --}}
            {{-- @csrf --}}


            <div class="p-4 m-3 border bg-gradient-info">

                <div class="form-group">
                    <label for="cat">Category</label>
                    <select name="category_id" id="category_id" class="form-control" id="cat">
                        @foreach ($Categories as $Category)
                            <option value="{{ $Category->id }}">{{ $Category->name }}</option>
                        @endforeach
                    </select>
                    <br>
                    {{-- <span id="category_id" class="text-danger"></span> --}}

                </div>

                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" id="name_product" value="{{ old('name') }}" class="form-control">
                    <span id="name" class="text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="price">Product Price</label>
                    <input type="number" name="price" id="price_product" value="{{ old('price') }}"
                        class="form-control">
                    <span id="price" class="text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="qty">Product Quantity</label>
                    <input type="number" name="qty" id="qty_product" value="{{ old('qty') }}" class="form-control">
                    <span id="qty" class="text-danger"></span>
                </div>

                {{-- <div class="mb-3">
                    <label for="formFile" class="form-label">upload photo</label>
                    <input type="file" name="image" id="image_product" value="{{ old('image') }}"
                        class="form-control" enctype="multipart/form-data">
                    <span id="image" class="text-danger"></span>
                </div> --}}

                <div class="mb-3">
                    <label for="validationTextarea" class="form-label">Description</label>
                    <textarea class="form-control" placeholder="Leave a description here" name="description" id="description_product"
                        style="height: 100px">{{ old('description') }}</textarea>
                    <span id="description" class="text-danger"></span>
                </div>

                <button type="submit" class="btn btn-success" id="btn_save">
                    <i class="bi bi-reply-all-fill"></i> Submit
                </button>

            </div>


        </div>
    </div>
</div>
@endsection
@section('js_script')
<script>
    console.log('read file js create');

    $('#btn_save').click(function() {


        // save category_id in the variable category_id
        var category_id = document.getElementById("category_id").value;
        // save name_product in the variable name
        var name = document.getElementById("name_product").value;
        // save price_product in the variable price
        var price = document.getElementById("price_product").value;
        // save qty_product in the variable qty
        var qty = document.getElementById("qty_product").value;
        // save description_product in the variable description
        var description = document.getElementById("description_product").value;
        // save image_product in the variable image
        // var image = document.getElementById("image_product").value;


        // enctype:"multipart/form-data",
        $('#name').text(' ');
        $('#price').text(' ');
        $('#qty').text(' ');
        $('#description').text(' ');
        $('#image').text(' ');

        //Start ajax
        $.ajax({
            type: "POST",
            url: '{{ route('product.store') }}',
            data: {
                _token: '{{ csrf_token() }}',
                category_id: category_id,
                name: name,
                price: price,
                qty: qty,
                description: description,
                // image: image,
            },




            success: function(response) {

                //Success message
                $("#message").append(`<div class="alert alert-success" role="alert">${response.message}</div>`).fadeOut(3000);

            },
            error: function(response) {

                //Error message
                let res = $.parseJSON(response.responseText);
                $.each(res.errors, function(key, value) {
                    $("#" + key).text(value[0]);
                })

            }
        }); //end ajax



    });
</script>
@endsection




{{-- /*
            type: "POST",
            enctype: 'multipart/form-data',
            url: '{{ route('product.store') }}',
            data: {
                _token: '{{ csrf_token() }}',
                category_id: category_id,
                name: name,
                price: price,
                qty: qty,
                description: description,
                image: image
            },
            */ --}}
