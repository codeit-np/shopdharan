@extends('admin.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                @if (session('fail'))
                    <div class="alert  alert-danger">
                        {{ session('fail') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert  alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-header">
                    Edit Vendor
                </div>
                <img src="{{ $vendor->image }}" class="rounded img-fluid img-thumbnail" alt="{{ $vendor->name }}">
                <div class="card-body">
                    <form action="{{ route('vendors.update',[$vendor->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name">Vendor Name</label>
                            <input type="text" name="name" value="{{ $vendor->name }}" class="form-control"
                                placeholder="Vendor Name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input name='email' class="form-control" value="{{ $vendor->email }}" placeholder="Email"
                                required type="email">
                        </div>
                        {{-- <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div> --}}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="visible">Visible</label>
                                    <select name="visible" class="form-control">
                                        <option value=1 {{ $vendor->visible == 1 ? 'selected' : '' }}>Visible</option>
                                        <option value=0 {{ $vendor->visible == 0 ? 'selected' : '' }}>Not Visible</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="open">Open</label>
                                    <select name="open" class="form-control">
                                        <option value=1 {{ $vendor->open == 1 ? 'selected' : '' }}>Open</option>
                                        <option value=0 {{ $vendor->open == 0 ? 'selected' : '' }}>Closed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="city_id">City</label>
                                    <select name="city_id" value="{{ $vendor->city_id }}" class="form-control">
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                {{ $vendor->city_id == $city->id ? 'selected' : '' }}>{{ $city->city }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="category_id">Catagory</label>
                                    <select name="category_id" value="{{ $vendor->category_id }}" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $vendor->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Save</button>
                    </form>
                    <form action="{{ route('vendors.destroy',[$vendor->id]) }}" method="post"
                        onsubmit="return confirm('Are You Sure You Want To Delete?')">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger float-left">Delete</button>
                    </form>

                </div>

            </div>
            <div class="card shadow">
                <div class="card-header">
                    Change Password
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('vendors.update.password',[$vendor->id]) }}">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
    
                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">
    
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
    
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                    required autocomplete="new-password">
                            </div>
                        </div>
    
    
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Change Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header">
                        Vendors List
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-sm">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>City</th>
                                <th>Category</th>
                                <th>Visible</th>
                                <th>Open</th>
                                <th>Action</th>
                            </tr>

                            @foreach ($vendors as $index => $vendor)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $vendor->name }}</td>
                                    <td>{{ $vendor->city->city }}</td>
                                    <td>{{ $vendor->category->category }}</td>
                                    <td>{{ $vendor->visible ? 'Visible' : 'Not Visible' }}</td>
                                    <td>{{ $vendor->open ? 'Open' : 'Closed' }}</td>
                                    <td><a href="/vendors/{{ $vendor->id }}/edit" class="btn btn-primary btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
