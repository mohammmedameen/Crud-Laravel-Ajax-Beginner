@extends('layouts.app')
@section('content')
@section('title', 'Categories')
<!-- Start Main Header Page -->
@section('header-page', 'Categories')
@section('title-page', 'Add')
<!-- End Main Header Page -->

<div class="jumbotron p-2 m-4">
    <div class="jumbotron p-2 m-4">
        <h3 class="">
            <a class="btn btn-primary btn-lg" href="{{ route('category.index') }}" role="button">View All
                Categories</a>

        </h3>
    </div>
    <h1 class=" p-3 border display-4"> Add New Categoery </h1>
    <div class="container">
        <div class="row">
            <div class="col-10 mx-auto">
                {{-- @include('layouts.inc.message') --}}
                <div id="message"></div>
                {{-- <form class="p-4 m-3 border bg-gradient-info" method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data"> --}}
                {{-- @csrf --}}


                {{-- <form class="cmxform" id="contact"> --}}

                <div class="form-group">
                    <label for="name">Category Name</label>
                    <br>
                    <span id="name" class="text-danger"></span>
                    <input type="text" name="name" id="name_category" class="form-control">
                </div>

                <button type="submit" class="btn btn-success" id="btn_save">
                    <i class="bi bi-reply-all-fill"></i> Submit
                </button>



                {{-- </form> --}}
            </div>
        </div>
    </div>
@endsection




@section('js_script')
    <script>
        console.log('read file js create');

        $('#btn_save').click(function() {
            // save name in the variable name
            var name = document.getElementById("name_category").value;
            $('#name').text(' ');

            //Start ajax
            $.ajax({
                url: '{{ route('category.store') }}',
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    name: name
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


