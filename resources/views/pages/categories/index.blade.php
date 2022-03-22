@extends('layouts.app')
@section('content')
@section('title', 'Categories')
<!-- Start Main Header Page -->
@section('header-page', 'Categories')
@section('title-page', 'All')
<!-- End Main Header Page -->

<div class="jumbotron p-2 m-4">
    <h3 class="">
        <a class="btn btn-success btn-lg" href="{{ route('category.create') }}" role="button">Add New Category </a>
    </h3>
</div>


<h1 class="p-3 border display-4"> All Categories </h1>
<div id="message"></div>
<div class="container">
    <div class="row">
        <div class="col-12">

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $Category)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <th scope="row">{{ $Category->name }}</th>
                            <td>
                                <a href="{{ route('category.edit', $Category->id) }}" class="btn btn-info">Edit <i
                                        class="bi bi-pencil-square"></i></a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger remove_btn" data-id="{{ $Category->id }}"data-name="{{ $Category->name }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <nav class="mt-5" aria-label="Page navigation example">
                <ul class="pagination justify-content-center flex-wrap">

                    {!! $categories->links() !!}


                </ul>
            </nav>


        </div>


    </div>
</div>
@endsection

@section('js_script')
<script>
    console.log('Read Js File Delete');

    //Start Js remove Prodect
    $(".remove_btn").click(function(e) {
        e.preventDefault();
        let ele = $(this);
        // save data data-id in the variable name is category_id
        let category_id = ele.attr('data-id');
        // save data data-name in the variable name is category_name
        let category_name = ele.attr('data-name');



        //Start ajax
        $.ajax({
            url: '/category/' + category_id,
            method: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}"
            },

            //Open success message
            success: function(data) {
                //Success message
                $('#message').append(`<div class="alert alert-success" role="alert">${data.message}</div>`).fadeOut(3000);

                //remove deleted items from the page
                ele.parents('tr').fadeOut('slow', function() {
                    $(this).remove()
                })

            }
            //Close success message

        }); //end ajax



    });
    //End Js remove Prodect
</script>
@endsection

