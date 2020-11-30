@extends('user.index')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">
                Cart
            </div>
            <div class="card-body">
                <table class="table ">
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($cart_items as $index => $cart)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>
                                <a href="/app/product/{{ $cart->product->id }}" title="Go To {{ $cart->product->name }}'s Page'" class="d-flex align-items-start">
                                    <img src="{{ $cart->product->image?$cart->product->image:'/images/noimage.png' }}"
                                    class="mr-2"
                                    style='width:3em;height:3em;object-fit:cover'>
                                    {{ $cart->product->name }}
                                    <br>
                                    {{ $cart->qty  }} x {{ $cart->product->price - $cart->product->discount }} = {{ ($cart->product->price - $cart->product->discount) * $cart->qty }}
                                </a>

                            </td>
                            <td>
                                <form action="/app/cart/{{ $cart->id }}" method="post"
                                    onsubmit="return confirm('Are You Sure You Want To Delete?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" title="Delete Item" class="btn btn-danger btn-sm">
                                        <i class="nav-icon fas fa-trash-alt "></i>
                                    </button>
                                    <a href="/app/cart/{{ $cart->id }}/edit" class="ml-3" title="Edit">
                                        <i class="nav-icon fas fa-edit "></i>
                                    </a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th></th>
                        <th>Items({{ $quantity }})</th>
                        <th>Rs.{{ $total }}</th>
                    </tr>
                </table>
                <form action="/app/clearcart" method="post"
                    onsubmit="return confirm('Are You Sure You Want To Clear Cart?')">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger float-left mb-4 ml-2">Clear Cart</button>
                </form>
                <a href="/app/cart/confirm" class="btn btn-primary float-right mb-4 mr-2"> Proceed </a>
            </div>
        </div>
    </div>
</div>
@endsection
