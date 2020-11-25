@extends('admin.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    Add Vendor
                </div>
                <div class="card-body">
                    <form action="/vendors" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Vendor Name</label>
                            <input type="text" name="name"
                             class="form-control" placeholder="Vendor Name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input name='email' class="form-control" placeholder="Email" required type="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="visible">Visible</label>
                                    <select name="visible" class="form-control">
                                            <option value=1>Visible</option>
                                            <option value=0>Not Visible</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="open">Open</label>
                                    <select name="open" class="form-control">
                                            <option value='{{ true }}'>Open</option>
                                            <option value="{{ false }}">Closed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="city_id">City</label>
                                    <select name="city_id" class="form-control">
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="category_id">Catagory</label>
                                    <select name="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Save</button>
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
 
                     @foreach ($vendors as $index=>$vendor)
                         <tr>
                             <td>{{ $index+1 }}</td>
                             <td>{{ $vendor->name }}</td>
                             <td>{{ $vendor->city }}</td>
                             <td>{{ $vendor->category }}</td>
                             <td>{{ $vendor->visible?"Visible":"Not Visible" }}</td>
                             <td>{{ $vendor->open?"Open":"Closed" }}</td>
                             <td><a href="/vendors/{{ $vendor->id }}/edit" class="btn btn-primary btn-sm">Edit</a></td>
                        </tr>
                     @endforeach
                 </table>
                </div>
            </div>
         </div>
    </div>
@endsection