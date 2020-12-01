@extends('user.index')

@section('content')
    <div class="row">
        {{-- Links --}}
        <div class="col-md-3">
            {{-- <h1 class="my-4">Links</h1> --}}
            <div class="list-group">
                <a href="/app/cart" class="list-group-item">
                    Cart
                </a>
                <a href="/app/orders" class="list-group-item">
                    See Orders
                </a>
            </div>
        </div>
        {{-- End Links --}}
        <div class="col-md-9">
            <div class="card shadow">
                <div class="card-header">
                    Orders
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <tr>
                            <th>#</th>
                            <th>Status</th>
                            <th>Cost</th>
                            <th>Delivery</th>
                            <th>Total</th>
                            <th>Ordered Time</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($orders as $index => $order)
                            <tr>

                                <td> {{ ++$index }}</td>
                                <td> {{ $order->status }}</td>
                                <td>{{ $order->total }}</td>
                                <td>{{ $order->charge }}</td>
                                <td>{{ $order->net_total }}</td>
                                <td>{{ $order->ordered_time }}</td>
                                <td>
                                    <a href="/app/order/{{ $order->id }}" title="View Order" >
                                        <i class="nav-icon fas fa-eye "></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
