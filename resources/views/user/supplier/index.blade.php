@extends('user.index')

@section('content')
    
<div class="row">
  
    <div class="col-lg-3">
      
      <h1 class="my-4">Shop Dharan</h1>
      <div class="list-group">
        {{-- <a href="#" class="list-group-item">Category 1</a>
        <a href="#" class="list-group-item">Category 2</a>
        <a href="#" class="list-group-item">Category 3</a> --}}
        @foreach ($categories as $category)
        <a href="#" class="list-group-item">{{ $category->category }}</a>
        @endforeach
      </div>
      
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
        
        @foreach ($vendors as $vendor)
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100 shadow">
            <a href="/app/{{ $vendor->id }}"><img class="card-img-top .img-fluid" src="{{ $vendor->image?$vendor->image:'/images/noimage.png' }}" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="/app/{{ $vendor->id }}">{{ $vendor->name }}</a>
              </h4>
              <p class="card-text">{{ $vendor->open?"Open":"Closed At The Moment" }}</p>
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