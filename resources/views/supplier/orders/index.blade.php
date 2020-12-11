@extends('supplier.app')

@section('content')

    <div class="row">

        {{-- Order Table --}}
         {{-- Links --}}
         <div class="col-md-3">
            {{-- <h1 class="my-4">Links</h1> --}}
            <div class="list-group">
                <a href="{{ route('supplier.orders.index') }}" class="list-group-item">
                    All
                </a>
                @foreach ($order_statuses as $id => $status)
                    <a href="{{ route('supplier.orders.index') }}?status={{ $status }}" class="list-group-item" title="{{ $status }}">
                        {{ $status }}
                    </a>
                @endforeach
            </div>
        </div>
        {{-- End Links --}}
        {{-- End Order Table --}}

        {{-- Order Items --}}
        <div class="col-md-9">
            <div class="card shadow">
                <div class="card-header">
                    Order Items
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Order Time</th>
                            <th>Status</th>
                        </tr>
                        @foreach ($orders as $index => $item)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>
                                    <a href="{{ route('products.edit',[$item->product->id]) }}"
                                        title="Go To {{ $item->product->name }}'s Page'" class="d-flex align-items-start">
                                        <img src="{{ $item->product->image ? $item->product->image : '/images/noimage.png' }}"
                                            class="mr-2" style='width:3em;height:3em;object-fit:cover'>
                                        {{ $item->product->name }}
                                        <br>
                                        {{ $item->qty }} x {{ $item->amount }} = {{ $item->amount * $item->qty }}
                                    </a>
                                </td>
                                <td>
                                    {{ $item->order->ordered_time }}
                                </td>
                                <td>
                                    {{ $item->order->status }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $orders->render('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        {{-- End Order Items Table --}}
    </div>

@endsection
