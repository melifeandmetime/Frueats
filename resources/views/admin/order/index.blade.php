@extends('layouts.admin')

@section('content')
        <div class="card">
            <div class="card-header">
                <h3>Order List</h3>     
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table_custom">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Code</th>
                                <th>Customer</th>
                                <th>Address</th>
                                <th>Total</th>
                                <th>Payment Proof</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->code }}</td>
                                    <td>{{ $data->customer->username }}</td>
                                    <td>{{ $data->address }}</td>
                                    <td>Rp. {{ number_format($data->total, 2) }}</td>
                                    <td>
                                    @if($data->payment_file)
                                        <a href="{{ asset('storage/' . $data->payment_file) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $data->payment_file) }}" alt="{{ $data->code }}" width="70">
                                        </a>
                                    @endif
                                    </td>
                                    <td>
                                        @if($data->status == 'proses')
                                            <span class="badge badge-success">{{ $data->status }}</span>
                                        @else
                                            <span class="badge badge-primary">{{ $data->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.order.show', $data->id) }}" class="btn btn-warning">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @if($data->status == 'proses')
                                            <a href="{{ url('admin/order_status', $data->id) }}" class="btn btn-success">
                                                <i class="fa fa-paper-plane"></i>
                                            </a>
                                            @endif
                                            <form onclick="return confirm('are you sure ?');" action="{{ route('admin.order.destroy', $data->id) }}" method="post">
                                                @csrf 
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection