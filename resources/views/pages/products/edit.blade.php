@extends('layouts.app')

@section('content')



@section('title', 'Products')
<!-- Start Main Header Page -->
@section('header-page', 'Products')
@section('title-page', 'Edit')
<!-- End Main Header Page -->


<div class="jumbotron p-2 m-4">
    <h3 class="">
        <a class="btn btn-primary btn-lg" href="{{ route('product.index') }}" role="button">View All Products </a>
    </h3>
</div>
<h1 class=" p-3 border display-4"> Edit New Product </h1>
<div class="container">
    <div class="row">
        <div class="col-10 mx-auto">
            @include('layouts.inc.message')
            <form class="p-4 m-3 border bg-gradient-info" method="POST"
                action="{{ route('product.update', $Product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="cat">Category</label>
                    <select name="category_id" class="form-control" id="cat">
                        @foreach ($Categories as $Category)
                            <option value="{{ $Category->id }}">{{ $Category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="catname">Product Name</label>
                    <input type="text" name="name" value="{{ $Product->name }}" class="form-control" id="catname">
                </div>
                <div class="form-group">
                    <label for="catprice">Product Price</label>
                    <input type="number" name="price" value="{{ $Product->price }}" class="form-control"
                        id="catprice">
                </div>
                <div class="form-group">
                    <label for="catqty">Product Quantity</label>
                    <input type="number" name="qty" value="{{ $Product->qty }}" class="form-control" id="catqty">
                </div>

                <div class="form-group">
                    <label for="image">Upload Image</label>
                    <div class="row mb-4">
                        <div class="col-md-5"> <img src="{{ asset('images/product/' . $Product->image) }}"
                                alt="{{ $Product->name }}" width="250px" class="category-edit-img" />
                        </div>

                        <div class="col-md-4">
                            <input type="file" class="dropify" data-bs-height="180" id="image" name="image" />
                        </div>
                    </div>
                </div>

                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a description here" id="des" name="description"
                        style="height: 100px">{{ $Product->description }}</textarea>
                    <label for="floatingTextarea2">Description</label>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-reply-all-fill"></i> Submit
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
