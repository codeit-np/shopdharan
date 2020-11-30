@extends('user.index')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-9">
            <div class="card shadow">
                <div class="card-header">
                    <b> Order Details </b>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Name</td>
                            <td>{{ $customer->name }}</td>
                        </tr>
                        <tr>
                            <td>Contact</td>
                            <td>{{ $customer->mobile }}</td>
                        </tr>
                        <tr>
                            <td>Num Of Items</td>
                            <td>{{ $quantity }}</td>
                        </tr>
                        <tr>
                            <td>Cost</td>
                            <td>Rs.{{ $total }}</td>
                        </tr>
                        <tr>
                            <td>Delivery Charge</td>
                            <td>Rs.{{ $delivery }}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <th>Rs.{{ $total + $delivery }}</th>
                        </tr>
                    </table>
                    <form action="/app/order" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="address_id">Address Line</label>
                            <select name="address_id" class="form-control">
                                @foreach ($addresses as $address)
                                    <option value="{{ $address->id }}">
                                        {{ $address->label . ' ' . $address->street . ',' . $address->city->city }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary float-right ">Confirm Order</button>
                    </form>
                    <a href="/app/cart" class="btn btn-secondary float-left "> Go Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
