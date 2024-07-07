@extends('layouts.app')
@section('title', 'Profile')
@section('content')

    <div class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                @if(session('message'))
                <p class="alert alert-success">{{ session('message') }}</p>
                @endif

                @if($errors->any())
                <ul>
                @foreach ($errors->all() as $error )

                <li class="text-danger">{{ $error }}</li>

                @endforeach
                @endif
                </ul>
                    <h4>User Profile </h4>
                    <div class="underline mb-4"></div>
                </div>
                <div class="col-md-10">
                    <div class="card-shadow">
                        <div class="card-header bg-primary">
                            <h4 class="mb-0 text-white">User Details</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('profile') }}" method="POST">
                              @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                        <label>UserName</label>
                                        <input type="text" name="username" value="{{ Auth::user()->name }}" class="form-control">
                                        </div>
                                    </div>

                                     <div class="col-md-6">
                                        <div class="mb-3">
                                        <label>Email Address</label>
                                        <input type="text" readonly  value="{{ Auth::user()->email  }}" class="form-control">
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="mb-3">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone" value="{{ Auth::user()->userDetails->phone ?? '' }}" class="form-control">
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="mb-3">
                                        <label>Cep</label>
                                        <input type="text" name="pin_code" value="{{ Auth::user()->userDetails->pin_code ?? '' }}" class="form-control">
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                        <div class="mb-3">
                                        <label>Endereço</label>
                                        <textarea type="text" name="address" value="" row="3" class="form-control">{{ Auth::user()->userDetails->address ?? '' }}</textarea>
                                        </div>
                                    </div>
                                      <div class="col-md-12">
                                      <button class="btn btn-primary" type="submit">Salvar</button>
                                      </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
