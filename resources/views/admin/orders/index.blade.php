@extends('layouts.admin')
@section('title', 'My Orders')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>My Orders
                    </h3>
                </div>
                <div class="card-body">

                    <form action="" method="GET">
                        <div class="row">
                        <div class="col-md-3">
                            <label>FIltrar por Data</label>
                            <input type="date" name="date" value="{{ Request::get('date')?? date('Y-m-d') }}" class="text form-control">
                        </div>

                        <div class="col-md-3">
                            <label>FIltrar por Status</label>
                            <select name="status" class="form-select">

                                <option value="">Select Status</option>
                                <option value="em progresso" {{ Request::get('status') == 'em progresso' ? 'selected' : ''}}>em progresso</option>
                                <option value="completo" {{ Request::get('status') == 'completo' ? 'selected' : ''}}>Completo</option>
                                <option value="pending" {{ Request::get('status') == 'pending' ? 'selected' : ''}}>Pending</option>
                                <option value="cancelled"{{ Request::get('status') == 'cancelled' ? 'selected' : ''}}>cancelled</option>
                                <option value="out-of-delivery"{{ Request::get('status') == 'out-of-delivery' ? 'selected' : ''}}>out-of-delivery</option>

                            </select>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </div>
                    </div>
                    </form>
                    <hr>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>Order id</th>
                                <th>Traking No</th>
                                <th>User name</th>
                                <th>Payment mode</th>
                                <th>Ordered data</th>
                                <th>Status message</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($orders as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->traking_no }}</td>
                                        <td>{{ $item->fullname }}</td>
                                        <td>{{ $item->payment_mode }}</td>
                                        <td>{{ $item->created_at->format('d-m-y') }}</td>
                                        <td>{{ $item->status_message }}</td>
                                        <td><a href="{{ url('admin/orders/' . $item->id) }}"
                                                class="btn  btn-primary btn-sm">View</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No Orders Avaliable</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
