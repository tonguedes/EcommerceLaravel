@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3> Add Category
                        <a href="{{ url('admin/category/') }}"
                            class="btn btn-primary btn-sm text-white float-end">Voltar</a>
                    </h3>
                </div>
                     <div class="card-body">
                    <form action="{{ url('admin/category') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                            <div class="col-md-6 mb-3">
                                <label>Nome</label>
                                <input type="text" name="name" class="form-control">
                                @error('name')
                                <div class="text-red-400 text-sm alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Slug</label>
                                <input type="text" name="slug" class="form-control">
                                @error('slug')
                                <div class="text-red-400 text-sm alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Descrição</label>
                                <textarea type="text" name="description" row="3" class="form-control"></textarea>
                                @error('description')
                                <div class="text-red-400 text-sm alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                             <div class="col-md-6 mb-3">
                                <label>Imagem</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                             <div class="col-md-6 mb-3">
                                <label>Status</label>
                                <input type="checkbox" name="status">
                            </div>

                             {{-- <div class="col-md-12">
                                <h4>SEO Tags</h4>
                            </div> --}}
                            <div class="col-md-12 mb-3">
                                <label>Meta Titulo</label>
                                <textarea type="text" name="meta_title" row="3" class="form-control"></textarea>
                            </div>

                             <div class="col-md-12 mb-3">
                                <label>Meta Palavra-chave</label>
                                <textarea type="text" name="meta_keyword" row="3" class="form-control"></textarea>
                            </div>

                             <div class="col-md-12 mb-3">
                                <label>Meta Descrição</label>
                                <textarea type="text" name="meta_description" row="3" class="form-control"></textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary float-end">Salvar</button>
                            </div>

                    </form>


                </div>
            </div>
        </div>
@endsection
