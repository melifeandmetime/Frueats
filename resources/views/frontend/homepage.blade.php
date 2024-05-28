@extends('layouts.frontend')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="mb-5">
      <div class="container">
          <div class="hero__item set-bg" data-setbg="{{ asset('frontend/img/hero/BUAH_1.jpg') }}">
              <div class="hero__text">
                  <span>FRUEATS</span>
                  <h2>Solusi<br />Belanja Buah</h2>
                  <p>Untuk Anda</p>
                  <a href="{{ url('/shop') }}" class="primary-btn">Belanja Sekarang</a>
              </div>
          </div>
      </div>
    </section>
      <!-- Breadcrumb Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
      <div class="container">
        <div class="row">
          <div class="categories__slider owl-carousel">
            @foreach($menu_categories as $menu_category)
              <div class="col-lg-3">
                <div
                  class="categories__item set-bg" style="width: 200px; height: 200px;"
                  data-setbg="{{ asset('storage/' . $menu_category->image) }}"
                >
                  <h5><a href="{{ route('shop.index', $menu_category->slug) }}">{{ $menu_category->name }}</a></h5>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title">
              <h2>Produk Kami</h2>
            </div>
          </div>
        </div>
        <div class="row featured__filter" id="product-list2">

            @foreach($products as $product)
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card mb-4">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" height="250px">
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
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="banner__pic">
              <img src="{{ asset('frontend/img/banner/banner-1.jpg') }}" alt="" />
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="banner__pic">
              <img src="{{ asset('frontend/img/banner/banner-3.jpg') }}" alt="" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner End -->
@endsection
