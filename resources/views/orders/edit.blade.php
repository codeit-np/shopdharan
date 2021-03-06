@extends('admin.app')

@section('content')

    <div class="row">

        {{-- Order Table --}}
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    Order Details
                </div>
                <div class="card-body">
                    <table class="table  table-sm">
                        <tr>
                            <td>Customer Name</td>
                            <td>{{ $order->customer->name }}</td>
                        </tr>
                        <tr>
                            <td>Contact</td>
                            <td>{{ $order->customer->mobile }}</td>
                        </tr>
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
                            <th>Total</th>
                            <th>{{ $order->net_total }}</th>
                        </tr>
                    </table>
                    <form action="/orders/{{ $order->id }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group mt-3">
                            <label for="status">Status</label>
                            <select name="status" value="{{ $order->status }}" class="form-control">
                                @foreach ($order_statuses as $index => $status)
                                    <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary float-right mt-4">Update Status</button>
                        </div>
                    </form>
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
                            <td>Total</td>
                            <td>Rs.{{ $order->total }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{-- End Order Items Table --}}
    </div>

@endsection
