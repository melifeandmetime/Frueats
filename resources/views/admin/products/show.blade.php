@extends('layouts.admin')

@section('content')
        <div class="card">
            <div class="card-header">
                <h3>{{ $product->name }}
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
                                <th>Images</th>
                                <td colspan="6"></td>
                            </tr>
                            <tr>
                                @if($product->image)
                                    <th class="col-lg-3 col-md-4 col-sm-6">
                                        <a href="">
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                                        </a>
                                    </th>
                                @else
                                    <th>
                                        <span class="badge badge-warning">no image</span>
                                    </th>
                                @endif
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td colspan="6">{{ $product->description }}</td>
                            </tr>
                            <tr>
                                <th>Details</th>
                                <td colspan="6">{{ $product->details }}</td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td colspan="6">Rp. {{ number_format($product->price, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Qty</th>
                                <td colspan="6">{{ $product->quantity }}</td>
                            </tr>
                            <tr>
                                <th>Weight</th>
                                <td colspan="6">{{ $product->weight }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
