@extends('admin.app')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    Add City
                </div>
                <div class="card-body">
                    <form action="{{ route('cities.update',[$city->id]) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" name="city" class="form-control" value="{{ $city->city }}">
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Update</button>
                    </form>
                    <form action="{{ route('cities.destroy',[$city->id]) }}" method="post"
                        onsubmit="return confirm('Are You Sure You Want To Delete?')"
                        >
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger float-left">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
           <div class="card shadow">
               <div class="card-header">
                   City List
               </div>
               <div class="card-body">
                <table class="table table-bordered table-sm">
                    <tr>
                        <th>#</th>
                        <th>City</th>
                        <th>Action</th>
                    </tr>

                   
                    @foreach ($cities as $index=>$city)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $city->city }}</td>
                            <td><a href="{{ route('cities.edit',[$city->id]) }}" class="btn btn-primary btn-sm">Edit</a></td>
                        </tr>
                    @endforeach
                </table>
               </div>
           </div>
        </div>
    </div>
@endsection