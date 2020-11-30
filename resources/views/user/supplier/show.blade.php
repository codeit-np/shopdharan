@extends('user.index')

@section('content')

<div class="row">
  
    <div class="col-lg-3">
      <h1 class="my-4">{{ $vendor->name }}</h1>
      <h6 class="my-4">{{ $vendor->email }}</h6>
    </div>
    <!-- /.col-lg-3 -->
    
    <div class="col-lg-9">
      
      <div class="row">
        
        {{-- <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
            <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="#">Item One</a>
              </h4>
              <h5>$24.99</h5>
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
            </div>
          </div>
        </div> --}}
        
        @foreach ($products as $product)
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="card h-100 shadow">
              <a href="/app/product/{{ $product->id }}"><img class="card-img-top image-card-small" src={{ $product->image?$product->image:'/images/noimage.png' }} alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="/app/product/{{ $product->id }}">{{ $product->name }}</a>
                </h4>
                <h5>
                    @if ($product->discount>0)
                   <s>Rs. {{  $product->price }}</s>
                    @endif
                    Rs. {{ $product->price - $product->discount }}
                </h5>
                <p class="card-text p-maxline">{{ $product->description }}</p>
              </div>
            </div>
          </div>
        @endforeach

      </div>
      <!-- /.row -->
      
    </div>
    <!-- /.col-lg-9 -->
    
  </div>
  <!-- /.row -->
@endsection