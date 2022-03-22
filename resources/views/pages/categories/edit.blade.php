@extends('layouts.app')

@section('content')


@section('title', 'Categories')
<!-- Start Main Header Page -->
@section('header-page', 'Categories')
@section('title-page', 'Edit')
<!-- End Main Header Page -->


<div class="container">
    <div class="row">


        <div class="jumbotron p-2 m-4">
            <h3 class="">
                <a class="btn btn-primary btn-lg" href="{{ route('category.index') }}" role="button">View All
                    Categories</a>
            </h3>
        </div>
        <h1 class=" p-3 border display-4"> Edit Categoery - {{ $Category->name }}</h1>

        <div class="col-8 mx-auto">


            {{-- @include('layouts.inc.message') --}}

            {{-- <form class="p-4 m-3 border bg-gradient-info" method="POST" action="{{ route('category.update',$Category->id)}}"> --}}

            <div id="message">

            </div>

            <div class="form-group">
                <label for="name">Category Name</label>
                <br>
                <span id="name" class="text-danger"></span>
                <input type="text" value="{{ $Category->name }}" name="name" id="name_category" class="form-control">
                <input type="hidden" value="{{ $Category->id }}" id="id_category">


            </div>

            <button type="submit" class="btn btn-success" id="update_btn">
                <i class="bi bi-reply-all-fill"></i> Submit
            </button>



        </div>
    </div>
</div>
@endsection





@section('js_script')
<script>
    console.log('read file js create');

    $('#update_btn').click(function() {
        // save name in variable name
        var name = document.getElementById("name_category").value;
        // save id in variable id
        var id = document.getElementById("id_category").value;
        $('#name').text(' ');
        console.log('ggg');



        //Start ajax
        $.ajax({
            url: '/category/' + id,
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    name: name
                },
            success: function(response) {

                console.log('success');


                //Success message
                $("#message").append(`<div class="alert alert-success" role="alert">${response.message}</div>`).fadeOut(3000);

            },
            error: function(response) {
                //Error message
                let res = $.parseJSON(response.responseText);
                $.each(res.errors, function(key, value) {
                    $("#" + key).text(value[0]);
                })

                console.log('error');


            }
        }); //end ajax



    });
</script>
@endsection

