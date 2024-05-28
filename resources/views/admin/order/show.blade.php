@extends('layouts.admin')

@section('content')
        <div class="card">
            <div class="card-header">
                <h3>{{ $header->code }}
                    <a href="{{ route('admin.products.index') }}" class="btn btn-primary float-right">
                        Go Back
                    </a>
                </h3>     
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Code</th>
                                <td colspan="6">{{ $header->code }}</td>
                            </tr>
                            <tr>
                                <th>Customer</th>
                                <td colspan="6">{{ $header->customer->username }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td colspan="6">{{ $header->address }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td colspan="6">{{ $header->status }}</td>
                            </tr>
                            <tr>
                                <th>Shipping Cost</th>
                                <td colspan="6">Rp. {{ number_format($header->shipping, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td colspan="6">Rp. {{ number_format($header->total - $header->shipping, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Grand Total</th>
                                <td colspan="6">Rp. {{ number_format($header->total, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Payment Proof</th>
                                <td colspan="6">
                                    <a href="{{ asset('storage/' . $header->payment_file) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $header->payment_file) }}" alt="{{ $header->code }}" width="70">
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-body">
                <h4>Detail Order</h4>
                <div class="table-responsive">
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detail as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->products->name }}</td>
                                    <td>{{ $data->price }}</td>
                                    <td>{{ $data->qty }}</td>
                                    <td>Rp. {{ number_format($data->total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
