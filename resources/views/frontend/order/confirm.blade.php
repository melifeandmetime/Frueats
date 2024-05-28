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
                <a href="{{ route('home') }}">Home</a>
                <span>Order Complete</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Cart Section Begin -->
    <section class="shop-cart spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">

            <center>
                <img src="{{ asset('frontend\img\payment_success.png') }}" alt="" width="400px" style="margin-top:-100px;" />
                <h2>Order completed</h2><p></p>
                <a href="{{ route('homepage') }}" class="btn btn-sm btn-success">Back Home</a>
            </center>
           
          </div>
        </div>
      </div>
    </section>
    <!-- Cart Section End -->
@endsection


