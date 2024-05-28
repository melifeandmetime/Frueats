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
                <span>Keranjang Belanja</span>
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
            
            @if($list_cart->isEmpty())
              <div class="alert alert-info text-center">
                Belum ada data belanja
              </div>
            @else
            <a href="{{ url('order_payment') }}" class="btn btn-success btn-sm">Lanjutkan Pembayaran</a>
            <br><br>

            <div class="shop__cart__table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th class="shop__product">Nama Produk</th>
                    <th>Image</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @php $no = 1; 
                  $total = 0;
                  @endphp
                  @foreach($list_cart as $item)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td class="shop__cart__item">
                      <h5>{{ $item->products->name }}</h5>
                    </td>
                    <td class="shop__cart__item">
                      <img src="{{ asset('storage/' . $item->products->image) }}" alt="{{ $item->name }}" width="50">
                    </td>
                    <td class="shop__cart__quantity">
                      <input type="number" class="form-control qty-input" value="{{ $item->qty }}" min="1" data-id="{{ $item->id }}">
                    </td>
                    <td class="shop__cart__price">
                      {{ number_format($item->price, 2) }}
                    </td>
                    <td class="shop__cart__total">
                      {{ number_format($item->price * $item->qty, 2) }}
                    </td>
                    <td class="shop__cart__item__close">
                      <a href="{{ url('carts_delete', $item->id) }}" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                  @php
                  $total = $total + ($item->price * $item->qty);
                  @endphp
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="5" class="text-right">Total</td>
                    <td colspan="2" id="total-price">{{ number_format($total, 2) }}</td>
                  </tr>
                </tfoot>
              </table>
            </div>
            @endif
          </div>
        </div>
      </div>
    </section>
    <!-- Cart Section End -->
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
  $('.qty-input').on('keyup', function() {
    var id = $(this).data('id');
    var qty = $(this).val();
    $.ajax({
      url: '{{ url("carts_update") }}/' + id,
      method: 'POST',
      data: {
        _token: '{{ csrf_token() }}',
        qty: qty
      },
      success: function(response) {
        if (response.status == 'success') {
          var row = $('input[data-id="'+id+'"]').closest('tr');
          row.find('.shop__cart__total').text(response.subtotal);
          $('#total-price').text(response.total);
        } else {
          alert('Failed to update quantity');
        }
      }
    });
  });
});
</script>
