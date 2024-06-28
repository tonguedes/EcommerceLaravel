@extends('layouts.admin')

@section('title', 'Users List')


@section('content')


    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3> Products
                        <a href="{{ url('admin/users/create') }}" class="btn btn-primary btn-sm text-white float-end">Add
                            Users</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->role_as == '0')
                                            <label class="badge btn-primary">user</label>
                                        @elseif($user->role_as == '1')
                                            <label class="badge btn-success">Admin</label>
                                        @else
                                            <label class="badge btn-danger">none</label>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/users/' . $user->id . '/edit') }}"
                                            class="btn btn-success">Edit</a>
                                        <a href="{{ url('admin/users/' . $user->id . '/delete') }}"
                                            onclick="return confirm('Tem certeza que deseja deletar o Usuario?')"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No Users Found</td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                    <div>
                        {{-- {{ $users->links }}</div> --}}
                    </div>
                </div>
            </div>
        </div>
    @endsection
