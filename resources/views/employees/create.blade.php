@extends('admin.app')

@section('content')
    @if (session('success'))
        <div class="alert  alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('fail'))
        <div class="alert  alert-danger">
            {{ session('fail') }}
        </div>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endforeach
    @endif
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header">
                    Add Employees
                </div>
                <div class="card-body">
                    <form action="/employees" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Employee Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Supplier Name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input name='email' class="form-control" placeholder="Email" required type="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label for="is_admin">Role</label>
                            <select name="is_admin" class="form-control">
                                <option value="0">Employee</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Save</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    Employees List
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>

                        @foreach ($employees as $index => $employee)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->is_admin ? 'Admin' : 'Employee' }}</td>
                                <td>
                                    <form action="/employees/{{ $employee->id }}" method="post"
                                        onsubmit="return confirm('Are You Sure You Want To Delete?')">
                                        @csrf
                                        @method('delete')
                                        <a href="/employees/{{ $employee->id }}/edit" class="btn btn-primary btn-sm">Edit</a>
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
