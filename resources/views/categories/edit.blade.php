@extends('admin.app')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    Add Category
                </div>
                <div class="card-body">
                    <form action="/categories/{{ $category->id }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name">Cateogory</label>
                            <input type="text" name="name" value="{{ $category->category }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Update</button>
                    </form>
                    <form action="/categories/{{ $category->id }}" method="post"
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
                            <td><a href="/categories/{{ $category->id }}/edit" class="btn btn-primary btn-sm">Edit</a></td>
                        </tr>
                    @endforeach
                </table>
               </div>
           </div>
        </div>
    </div>
@endsection