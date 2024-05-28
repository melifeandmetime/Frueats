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
                <span>Checkout Page</span>
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
      <!-- Left side: Payment details -->
      <div class="col-lg-8">
        <div class="checkout__form">
          <h4>Billing Details</h4>
          <form action="{{ url('order_store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <div class="checkout__input">
                  <p>Name<span>*</span></p>
                  <input type="text" name="name" value="{{ auth()->user()->username }}" required>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="checkout__input">
                  <p>Email<span>*</span></p>
                  <input type="email" name="email" value="{{ auth()->user()->email }}" required>
                </div>
              </div>
            </div>
            <div class="checkout__input">
              <p>Address<span>*</span></p>
              <input type="text" class="" name="address" required>
            </div>

            <div class="row">

                <div class="col-lg-6 col-md-6">
                    <div class="checkout__input">
                    <p>Province<span>*</span></p>
                    <select class="custom_select" name="province" id="province" required>
                        <option value="">Select Province</option>
                        <option value="DKI Jakarta">DKI Jakarta</option>
                        <option value="Jawa Barat">Jawa Barat</option>
                        <option value="Jawa Tengah">Jawa Tengah</option>
                        <option value="Jawa Timur">Jawa Timur</option>
                    </select>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="checkout__input">
                    <p>City<span>*</span></p>
                    <select class="custom_select" name="city" id="city" required>
                        <option value="">Select City</option>
                        <option value="Jakarta" data-total="10000">Jakarta</option>
                        <option value="Bandung" data-total="15000">Bandung</option>
                        <option value="Semarang" data-total="20000">Semarang</option>
                        <option value="Surabaya" data-total="20000">Surabaya</option>
                        <option value="Yogyakarta" data-total="25000">Yogyakarta</option>
                        <option value="Malang" data-total="30000">Malang</option>
                    </select>
                    </div>
                </div>

            </div>

            <br>

            <div class="checkout__input">
              <p>Shipping Cost<span>*</span></p>
              <input type="text" name="shipping_cost" id="shipping_cost" required>
            </div>

            <div class="checkout__input">
              <p>Proof Payment<span>*</span></p>
              <input type="file" name="payment_file" id="payment_file" required>
            </div>

      </div>
      </div>
      
      <!-- Right side: Total payment and payment type -->
      <div class="col-lg-4">
        <div class="checkout__order">
          <h4>Total Payment</h4>
          <div class="checkout__order__total">
            <ul>
              <li>Subtotal <span id="subtotal">{{ $subtotal }}</span></li>
              <li>Ongkir <span id="shippingCost">0</span></li>
              <li>Total <span id="totalAmount">0</span></li>
            </ul>
          </div>
          <h4>Payment Method</h4>
          <div class="checkout__input__checkbox">
            <label for="payment1">
              Credit Card
              <input type="radio" id="payment1" name="payment_method" value="credit_card" required>
              <span class="checkmark"></span>
            </label>
          </div>
          <div class="checkout__input__checkbox">
            <label for="payment3">
              Bank Transfer
              <input type="radio" id="payment3" name="payment_method" value="bank_transfer" required>
              <span class="checkmark"></span>
            </label>
          </div>
          <button type="submit" class="site-btn">Submit Payment</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</section>
<!-- Cart Section End -->
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>    
  $(document).ready(function(){
    $('#city').change(function() {
      var selectedCity = $(this).find('option:selected');
      var totalValue = selectedCity.data('total');
      $('#shipping_cost').val(totalValue);
      $('#shippingCost').text(totalValue);
      hitungTotal();
    });
  });

  function hitungTotal(){
      var subtotal = parseFloat($('#subtotal').text());
      var shippingCost = parseFloat($('#shippingCost').text());
      var total = subtotal + shippingCost;
      $('#totalAmount').text(total);
  }
</script>



