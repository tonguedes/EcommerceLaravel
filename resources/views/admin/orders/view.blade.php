@extends('layouts.admin')
@section('title', 'My Orders Details')
@section('content')

    <div class="row">
        <div class="col-md-12">

            @if(session('message'))
                <div class="alert alert-success mb-3">{{ session('message') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3>My Order Details
                    </h3>
                </div>
                <div class="card-body">
                    <div class="shadow bg-white p-3">
                        <h6 class="text-primary">
                            <i class="fa fa-shopping-cart text-dark"></i>Detalhe do Pedido
                            <a href="{{ url('admin/orders') }}" class="btn btn-danger btn-sm float-end mx-1">Voltar</a>
                            <a href="{{ url('admin/invoice/'.$order->id.'/generate') }}" class="btn btn-primary btn-sm float-end mx-1">Download Invoice</a>
                            <a href="{{ url('admin/invoice/'.$order->id) }}" target="_blank" class="btn btn-warning btn-sm float-end mx-1">View Invoice</a>
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

            <div class="card border mt-3">
                <div class="card-body">
                    <h4>Ordem de pedido(status)</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <form action="{{ url('admin/orders/'.$order->id) }}" method="post">
                                @csrf
                                @method('Put')
                                 <label>Atualize seu Status</label>
                                 <div class="input-group">
                                    <select name="order_status" class="form-select">
                                        <option value="">Select Order  Status</option>
                                        <option value="em progresso" {{ Request::get('status') == 'em progresso' ? 'selected' : ''}}>em progresso</option>
                                        <option value="completo" {{ Request::get('status') == 'completo' ? 'selected' : ''}}>Completo</option>
                                        <option value="pending" {{ Request::get('status') == 'pending' ? 'selected' : ''}}>Pending</option>
                                        <option value="cancelled"{{ Request::get('status') == 'cancelled' ? 'selected' : ''}}>cancelled</option>
                                        <option value="out-of-delivery"{{ Request::get('status') == 'out-of-delivery' ? 'selected' : ''}}>out-of-delivery</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary text-white">Update</button>
                                 </div>
                                 <div class="col-md-7">
                                    <br>
                                    <h4 class="mt-3">Current order Status: <span class="text-uppercase">{{ $order->status_message }}</span></h4>
                                 </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
