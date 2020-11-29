@extends('user.index')

@section('content')

    {{-- Links Start --}}
    <div class="row">
        <div class="col-md-3">
            {{-- <h1 class="my-4">Links</h1> --}}
            <div class="list-group">
                <a href="/app/info" class="list-group-item">
                    Info
                </a>
                <a href="/app/address" class="list-group-item active">
                    Addreses
                </a>
                <a href="#" class="list-group-item">
                    Update Password
                </a>
            </div>
        </div>
        {{-- Links End --}}
        <div class="col-md-9 float-right">
            <div class="row">

                {{-- Start Add Address --}}
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header">
                            Add Address
                        </div>
                        <div class="card-body">
                            <form action="/app/address/{{ $address->id }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="city_id">City</label>
                                <select name="city_id" class="form-control" 
                                    value={{ $address->city_id }}
                                >
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->city }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="label">Label (optional)</label>
                                <input type="text"  class="form-control" name="label" placeholder="Add A Label For This Address" value="{{ $address->label }}">
                            </div>
                            <div class="form-group">
                                <label for="street">Street Name</label>
                                <input type="text"  class="form-control" required name="street" placeholder="Add Street Name" value="{{ $address->street }}">
                            </div>
                            <div class="form-group">
                                <label for="details">Additional Details (optional)</label>
                                <textarea name="details"  class="form-control" rows="3" >{{ $address->details }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">
                                Add Address
                            </button>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- End Add Address --}}

                {{-- Show Addresses --}}
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-header">
                                Addresses
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th>#</th>
                                        <th>Label</th>
                                        <th>City</th>
                                        <th>Street</th>
                                        <th>Actions</th>
                                    </tr>
                                    @foreach ($addresses as $index=>$address)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $address->label }}</td>
                                        <td>{{ $address->city->city }}</td>
                                        <td>{{ $address->street }}</td>
                                        <td>
                                            <form action="/app/address/{{ $address->id }}" method="post"
                                                onsubmit="return confirm('Are You Sure You Want To Delete?')"
                                                >
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                <a href="/app/address/{{ $address->id }}/edit" class="ml-3" title="Edit" >
                                                    <i class="nav-icon fas fa-edit "></i>
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                {{-- End Show Addresses --}}
            </div>
        </div>
    </div>
@endsection
