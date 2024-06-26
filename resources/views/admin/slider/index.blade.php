@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Slider List
                        <a href="{{ url('admin/sliders/create') }}" class="btn btn-primary text-white float-end">
                            Add Sliders</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Imagem</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{ $slider->id }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->description }}</td>
                                        <td><img src="{{ asset("$slider->image") }}" alt="" width="60px" height="40px"></td>
                                    </td>
                                    <td>{{ $slider->status == '0' ? 'Visible':'Hidden'}}</td>
                                    <td>
                                        <a href="{{ url('admin/sliders/'.$slider->id.'/edit') }}" class="btn btn-primary">Editar</a>
                                        <a href="{{ url('admin/sliders/'.$slider->id.'/delete') }}"
                                            onclick="return confirm('Tem certeza que deseja excluir o Arquivo?')"class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
