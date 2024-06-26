@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Edit Color
                        <a href="{{ url('admin/colors/'.$color->id) }}" class="btn btn-danger btn-sm text-white float-end">
                            Voltar</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/colors/'.$color->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label>Color Name</label>
                            <input type="text" name="nome" value="{{ $color->nome }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Code</label>
                            <input type="text" name="code" value="{{ $color->code }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <input type="checkbox" name="status" {{ $color->status ? 'checked':'' }}>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
