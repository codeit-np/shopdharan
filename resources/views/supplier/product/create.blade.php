@extends('supplier.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header">
                Add Product
            </div>
            <div class="card-body">
                <form action="/supplier/products" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" name="name"
                         class="form-control" placeholder="Product Name" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input name="price" class="form-control" placeholder="Price" required type="number" min="0">
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input name="discount" class="form-control" placeholder="Discount" required type="number" min="0">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" rows="5" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="available">Available</label>
                        <select name="available" class="form-control">
                                <option value=1>Available</option>
                                <option value=0>Not Available</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>

                    <button type="submit" class="btn btn-primary float-right">Add</button>
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
                     <th>Name</th>
                     <th>Price</th>
                     <th>Discount</th>
                     <th>Available</th>
                     <th>Action</th>
                 </tr>

                 @foreach ($products as $index=>$product)
                     <tr>
                         <td>{{ $index+1 }}</td>
                         <td>{{ $product->name }}</td>
                         <td>{{ $product->price }}</td>
                         <td>{{ $product->discount }}</td>
                         <td>{{ $product->available?"Yes":"No" }}</td>
                         <td><a href="/supplier/products/{{ $product->id }}/edit" class="btn btn-primary btn-sm">Edit</a></td>
                    </tr>
                 @endforeach
             </table>
            </div>
        </div>
     </div>
</div>
@endsection