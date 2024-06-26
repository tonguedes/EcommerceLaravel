@extends('layouts.admin')

@section('title','Users List')


@section('content')


    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>  Products
                        <a href="{{ url('admin/products/create') }}" class="btn btn-primary btn-sm text-white float-end">Add Products</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                              <th>ID</th>
                              <th>Category</th>
                              <th>Product</th>
                              <th>Price</th>
                              <th>Quantity</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ( $products as $product )
                          <tr>
                              <td>{{ $product->id }}</td>
                              <td>{{ $product->category->name }}</td>
                              <td>{{ $product->name }}</td>
                              <td>{{ $product->selling_price }}</td>
                              <td>{{ $product->quantity}}</td>
                              <td>{{ $product->status == '1' ? 'hidden': 'visible' }}</td>
                              <td>
                                  <a href="{{url('admin/products/'.$product->id.'/edit') }}"  class="btn btn-success">Edit</a>
                                  <a href="{{url('admin/products/'.$product->id.'/delete') }}" onclick="return confirm('Tem certeza que deseja deletar o arquivo?')" class="btn btn-danger">Delete</a>
                              </td>

                          </tr>
                          @empty
                          <tr>
                              <td colspan="5">No products Found</td>
                          </tr>

                          @endforelse

                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
@endsection
