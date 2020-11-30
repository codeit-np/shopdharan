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
                    Add To Order
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    @foreach ($cart_items as $index=>$cart)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>
                            <a href="/app/product/{{ $cart->product->id }}">
                            {{ $cart->product->name }}
                            </a>
                        </td>
                        <td>{{ $cart->qty }}</td>
                        <td>{{ $cart->product->price - $cart->product->discount }}</td>
                        <td>{{ ($cart->product->price - $cart->product->discount) * $cart->qty }}</td>
                        <td>
                            <form action="/app/cart/{{ $cart->id }}" method="post"
                                onsubmit="return confirm('Are You Sure You Want To Delete?')"
                                >
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                <a href="/app/cart/{{ $cart->id }}/edit" class="ml-3" title="Edit" >
                                    <i class="nav-icon fas fa-edit "></i>
                                </a>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td>{{ $quantity }}</td>
                        <td></td>
                        <td>{{ $total }}</td>
                        <td>
                        </td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection