@extends('user.index')

@section('content')

<div class="row">

    <div class="col-lg-3">
      <h1 class="my-4">{{ $vendor->name }}</h1>
      <div class="list-group">
        @foreach ($products as $item)
        <a href="/app/product/{{ $item->id }}" class=" {{ 'list-group-item ' . ($item->id==$product->id?'active':'') }} ">{{ $item->name }}</a>
        @endforeach
      </div>
    </div>
    <!-- /.col-lg-3 -->

    <div class="col-lg-9">

      <div class="card mt-4 mb-4">
        <img class="card-img-top img-fluid" src={{ $product->image?$product->image:'/images/noimage.png' }} alt="">
        <div class="card-body">
          <h3 class="card-title">{{ $product->name }}</h3>
          <h4>
            @if ($product->discount>0)
           <s>Rs. {{  $product->price }}</s>
            @endif
            Rs. {{ $product->price - $product->discount }}
          </h4>
          <p class="card-text">
            {{ $product->description }} 
           </p>
        </div>
        <button type="button" class="btn btn-dark .btn-block">Add To Cart</button>
      </div>
      <!-- /.card -->

    </div>
    <!-- /.col-lg-9 -->

  </div>

@endsection