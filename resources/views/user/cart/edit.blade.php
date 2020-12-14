@extends('user.index')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="card shadow">
            <img class="card-img-top img-fluid image-card-big" src={{ $cart_item->product->image?$cart_item->product->image:'/images/noimage.png' }} alt="">
            <div class="card-body">
              <h3 class="card-title">{{ $cart_item->product->name }}</h3>
              <h4>
                @if ($cart_item->product->discount>0)
               <s>Rs. {{  $cart_item->product->price }}</s>
                @endif
                Rs. {{ $cart_item->product->price - $cart_item->product->discount }}
              </h4>
              <p class="card-text">
                {{ $cart_item->product->description }} 
               </p>
            
            <form action="{{ route('cart.update',[$cart_item->id]) }}" method="post">
                @csrf
                @method('put')
                    @csrf
                    <div class="form-group p-3">
                      <label for="qty">Quantity</label>
                      <input name="qty" value="{{ $cart_item->qty }}" class="form-control" min="1" max="99" placeholder="Quantity" required type="number" min="0">
                    </div>
                  <button type="submit" class="btn btn-primary float-right mb-4 mr-2">Update Item</button>
            </form>
            <form action="{{ route('cart.destroy',[$cart_item->id]) }}" method="post"
                onsubmit="return confirm('Are You Sure You Want To Delete?')"
                >
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger float-left mb-4 ml-2">Delete</button>
            </form>
        </div>
        </div>
    </div>
@endsection