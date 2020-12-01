@extends('user.index')

@section('content')

    <div class="row">

        {{-- Order Table --}}
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    Order Details
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <tr>
                            <td>Ordered Time</td>
                            <td>{{ $order->ordered_time }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{ $order->address->label . ' ' . $order->address->street . ',' . $order->address->city->city }}
                            </td>
                        </tr>
                        <tr>
                            <td>Cost</td>
                            <td>{{ $order->total }}</td>
                        </tr>
                        <tr>
                            <td>Delivery Charge</td>
                            <td>{{ $order->charge }}</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>{{ $order->net_total }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{{ $order->status }}</td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
        {{-- End Order Table --}}

        {{-- Order Items --}}
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    Order Items
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                        </tr>
                        @foreach ($order->items as $index => $item)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>
                                    <a href="/app/product/{{ $item->product->id }}"
                                        title="Go To {{ $item->product->name }}'s Page'" class="d-flex align-items-start">
                                        <img src="{{ $item->product->image ? $item->product->image : '/images/noimage.png' }}"
                                            class="mr-2" style='width:3em;height:3em;object-fit:cover'>
                                        {{ $item->product->name }}
                                        <br>
                                        {{ $item->qty }} x {{ $item->amount }} = {{ $item->amount * $item->qty }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th>Total</th>
                            <th>Rs.{{ $order->total }}</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{-- End Order Items Table --}}
    </div>

@endsection
