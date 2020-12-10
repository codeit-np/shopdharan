@extends('user.index')

@section('content')

    {{-- Links Start --}}
    <div class="row">
        <div class="col-md-3">
            {{-- <h1 class="my-4">Links</h1> --}}
            <div class="list-group">
                <a href="/app/info" class="list-group-item active">
                    Info
                </a>
                <a href="/app/address" class="list-group-item">
                    Addreses
                </a>
                <a href="{{ route('customerchangepassword') }}" class="list-group-item">
                    Update Password
                </a>
            </div>
        </div>
        {{-- Links End --}}
        <div class="col-md-9 float-right">
            <form action="/app/info" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name"> Name</label>
                    <input type="text" name="name" value="{{ $customer->name }}" class="form-control"
                        placeholder="Vendor Name" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input name='email' class="form-control" value="{{ $customer->email }}" placeholder="Email" required
                        type="email">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input name='mobile' class="form-control" value="{{ $customer->mobile }}" placeholder="Mobile" required
                        type="tel">
                </div>
                    <button type="submit" class="btn btn-primary float-right">Update Info</button>
            </form>
        </div>
    </div>
@endsection
