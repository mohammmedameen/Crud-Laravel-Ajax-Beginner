@extends('layouts.app')

@section('content')


@section('title', 'Products')
<!-- Start Main Header Page -->
@section('header-page', 'Products')
@section('title-page', 'Show')
<!-- End Main Header Page -->


<div class="container">
    <div class="row">
        <div class="card mb-3" style="max-width: 900px;">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="/images/product/{{ $Product->image }}" alt="{{ $Product->name }}"width="300px">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">{{ $Product->name }}</h5>
                  <p class="card-text">Price : {{ $Product->price }}</p>
                  <p class="card-text">Qty : {{ $Product->qty }}</p>
                  <p class="card-text">Description : {{ $Product->description }}</p>
                  <p class="card-text"><small class="text-muted">Last updated {{ $Product->updated_at }}</small></p>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
@endsection
