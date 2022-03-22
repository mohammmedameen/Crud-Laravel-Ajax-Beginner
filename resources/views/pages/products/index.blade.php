@extends('layouts.app')
@section('content')
@section('title', 'Products')
<!-- Start Main Header Page -->
@section('header-page', 'Products')
@section('title-page', 'All')
<!-- End Main Header Page -->

<div class="jumbotron p-2 m-4">
    <h3 class="">
        <a class="btn btn-success btn-lg" href="{{ route('product.create') }}" role="button">Add New Prodect </a>
    </h3>
</div>
<h1 class=" p-3 border display-4"> All Prodects </h1>
{{-- @include('layouts.inc.message') --}}
<div id="message"></div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Prodect Name</th>
                        <th scope="col">price</th>
                        <th scope="col">qty</th>
                        <th scope="col">image</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Products as $Prodect)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>

                            <th scope="row">
                                <a href="{{ route('product.show', $Prodect->slug) }}"
                                    class="text-decoration-none">{{ $Prodect->name }}
                                </a>
                            </th>


                            <th scope="row">{{ $Prodect->price }}</th>
                            <th scope="row">{{ $Prodect->qty }}</th>

                            <th scope="row">
                                <a href="{{ route('product.show', $Prodect->slug) }}" class="text-decoration-none">
                                    <img src="/images/product/{{ $Prodect->image }}" alt="{{ $Prodect->name }}"
                                        width="80px">
                                </a>
                            </th>

                            <td>
                                <a href="{{ route('product.edit', $Prodect->id) }}" class="btn btn-info">Edit <i
                                        class="bi bi-pencil-square"></i></a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger remove_btn" data-id="{{ $Prodect->id }}"
                                    data-name="{{ $Prodect->name }}">Delete</button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <nav class="mt-5" aria-label="Page navigation example">
                <ul class="pagination justify-content-center flex-wrap">
                    {!! $Products->links() !!}
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
        // save data data-id in the variable name is product_id
        let product_id = ele.attr('data-id');
        // save data data-name in the variable name is product_name
        let product_name = ele.attr('data-name');




        //Start ajax
        $.ajax({
            url: '/product/' + product_id,
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




{{-- //Start ajax
        $.ajax({
            url: '/product/' + product_id,
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

        }); //end ajax --}}
