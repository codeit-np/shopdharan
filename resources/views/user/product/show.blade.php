@extends('user.index')

@section('content')

    <div class="row">


        <!-- /.col-lg-3 -->

        <div class="col-lg-8">

            <div class="card mt-4">
                <img class="card-img-top img-fluid image-card-big"
                    src={{ $product->image ? $product->image : '/images/noimage.png' }} alt="">
                <div class="card-body">
                    <h3 class="card-title">{{ $product->name }}</h3>
                    <h4>
                        @if ($product->discount > 0)
                            <s>Rs. {{ $product->price }}</s>
                        @endif
                        Rs. {{ $product->price - $product->discount }}
                    </h4>
                    <p class="card-text">
                        {{ $product->description }}
                    </p>

                    <form method="post" action="{{ route('cart.store') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="form-group p-3">
                            <label for="qty">Quantity</label>
                            <input name="qty" value="1" class="form-control " min="1" max="99" placeholder="Quantity"
                                required type="number" min="0">
                        </div>
                        <button type="submit" class="btn btn-dark float-right mb-4 mr-4">Add To Cart</button>
                    </form>
                </div>
            </div>
            <!-- /.card -->

        </div>
        <!-- /.col-lg-9 -->

        <div class="col-lg-4">
            <h1 class="my-4">{{ $vendor->name }}</h1>
            <div class="list-group">
                @foreach ($products as $item)
                    <a href="{{ route('customer.product',[$item->id]) }}"
                        class=" {{ 'list-group-item ' . ($item->id == $product->id ? 'active' : '') }} ">{{ $item->name }}</a>
                @endforeach
            </div>
        </div>

    </div>

@endsection
