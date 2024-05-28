@extends('layouts.frontend')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="breadcrumb__text">
              <h2>FRUEATS</h2>
              <div class="breadcrumb__option">
                <a href="./index.html">Home</a>
                <span>Belanja Yuks</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-5">
            @include('frontend.shop.sidebar')
          </div>
          <div class="col-lg-9 col-md-7" id="product-shop1">

          <div class="row">
              @foreach($products as $product)
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card mb-4">
                  <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" height="200px">
                  <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text" style="margin-top: -15px;">{{ $product->description }}</p>
                    <p class="card-text" style="margin-top: -15px;">Rp. {{ number_format($product->price, 2) }}</p>
                    <p class="card-text" style="margin-top: -15px;"><strong>Stok:</strong> {{ $product->quantity }}</p>
                    <a href="{{ url('carts_insert', $product->id) }}" class="btn btn-success">Order</a>
                  </div>
                </div>
              </div>
              @endforeach
            </div>

          </div>
        </div>
      </div>
    </section>
    <!-- Product Section End -->
@endsection
