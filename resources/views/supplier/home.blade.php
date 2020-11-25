@extends('supplier.app')

@section('content')


<div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    About Me
                </div>
                <img src="{{ $image }}" class="rounded img-fluid img-thumbnail"
                alt="{{ $vendor->name }}">
                <div class="card-body">
                    <form action="/supplier" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name"> Name</label>
                            <input type="text" name="name"
                            value="{{ $vendor->name }}"
                            class="form-control" placeholder="Vendor Name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input name='email' class="form-control"
                            value="{{ $vendor->email }}"
                            placeholder="Email" required type="email">
                        </div>
                        {{-- <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div> --}}
                        <div class="form-group">
                            <label for="open">Open</label>
                            <select name="open"
                            class="form-control">
                                    <option value=1 {{ $vendor->open == 1 ? 'selected' : '' }}>Open</option>
                                    <option value=0 {{ $vendor->open == 0 ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="city_id">City</label>
                                    <select name="city_id"
                                    value="{{ $vendor->city_id }}"
                                    class="form-control">
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="category_id">Catagory</label>
                                    <select name="category_id"
                                    value="{{ $vendor->category_id }}"
                                    class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Update Info</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection