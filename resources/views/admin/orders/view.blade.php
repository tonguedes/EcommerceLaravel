@extends('layouts.admin')
@section('title', 'My Orders Details')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>My Order Details
                    </h3>
                </div>
                <div class="card-body">
                    <div class="shadow bg-white p-3">
                        <h6 class="text-primary">
                            <i class="fa fa-shopping-cart text-dark"></i>Detalhe do Pedido
                            <a href="{{ url('admin/orders') }}" class="btn btn-danger btn-sm float-end">Voltar</a>
                        </h6>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Detalhes do Pedido</h5>
                                <hr>
                                <h6>Order Id: {{ $order->id }}</h6>
                                <h6>Traking Id/No: {{ $order->traking_no }}</h6>
                                <h6>Order created Date: {{ $order->created_at->format('d-m-Y h:i A') }}</h6>
                                <h6 class="border p-2 text-sucess">
                                    Order status message: <span class='text-success'>{{ $order->status_message }}</span>
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <h5>User Details</h5>
                                <hr>
                                <h6>Full Name: {{ $order->fullname }}</h6>
                                <h6>Email Id: {{ $order->email }}</h6>
                                <h6>Phone: {{ $order->phone }}</h6>
                                <h6>Pin code: {{ $order->pincode }}</h6>
                                <h6>Adress: {{ $order->address }}</h6>

                            </div>
                        </div>
                        <br>
                        <h5>Orders Items</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <th>Item id</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </thead>
                                <tbody>
                                    @php
                                        $totalPrice = 0;
                                    @endphp
                                    @foreach ($order->orderItems as $ordemItem)
                                        <tr>
                                            <td width="10%">{{ $ordemItem->id }}</td>
                                            <td width="10%">
                                                @if ($ordemItem->product->ProductImages)
                                                    <img src="{{ asset($ordemItem->product->ProductImages[0]->image) }}"
                                                        style="width: 50px; height: 50px" alt="">
                                                @endif
                                            </td>
                                            <td>
                                                {{ $ordemItem->product->name }}
                                                {{-- @if ($ordemItem->productColor->name)
                                <span>with color:{{ $cartItem->productColor->color->name }}</span>
                                @else
                                <img src="" style="width: 50px; height: 50px"
                                alt="">
                                @endif --}}
                                            </td>
                                            <td width="10%">R${{ $ordemItem->price }}</td>
                                            <td width="10%">{{ $ordemItem->quantity }}</td>
                                            <td width="10%" class="fw-bold">
                                                R${{ $ordemItem->quantity * $ordemItem->price }}</td>
                                            @php
                                                $totalPrice += $ordemItem->quantity * $ordemItem->price;
                                            @endphp
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan='5' class="fw-bold">Total Amount</td>
                                        <td colspan='1' class="fw-bold">R${{ $totalPrice }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div>

                                {{-- {{ $order->links() }} --}}
                            </div>
                        </div>


                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
