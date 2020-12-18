@extends('admin.app')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    Add City
                </div>
                <div class="card-body">
                    <form action="{{ route('cities.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="city">City</label>
                            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus>

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Save</button>
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