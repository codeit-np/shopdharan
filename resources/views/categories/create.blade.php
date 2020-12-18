@extends('admin.app')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    Add Category
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Cateogory</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
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
                   Category List
               </div>
               <div class="card-body">
                <table class="table table-bordered table-sm">
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($categories as $index=>$category)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $category->category }}</td>
                            <td><a href="{{ route('categories.edit',[$category->id]) }}" class="btn btn-primary btn-sm">Edit</a></td>
                        </tr>
                    @endforeach
                </table>
               </div>
           </div>
        </div>
    </div>
@endsection