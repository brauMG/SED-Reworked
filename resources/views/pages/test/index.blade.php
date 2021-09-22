@extends('layouts.app', ['activePage' => 'Tests', 'titlePage' => __('Evidencia')])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if ( session('mensaje') )
                        <div class="container-edits" style="margin-top: 2%">
                            <div class="alert alert-success" class='message' id='message'>{{ session('mensaje') }}</div>
                        </div>
                    @endif
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h4 class="card-title text-white">Subir Evidencia</h4>
                        </div>
                            <div class="card-body">
                                <form action="{{url('/upload/create')}}" method='POST' enctype="multipart/form-data" id='form'>
                                    @csrf

                                    <div class="container" style="color:red !important;">
                                        Tamaño Máximo del Archivo: 500 MB
                                    </div>

                                    <div class="container">
                                        <input name="link" id='link' type="file"
                                            class="form-control  @error('link') is-invalid @enderror"
                                            placeholder="Nombre de la empresa" aria-label="Nombre"
                                            aria-describedby="basic-addon1" required autocomplete="link" autofocus
                                               value={{Request::old('link')}}></div>
                                        @error('link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    <input type="hidden" name='attributeId' value="{{$selectedAttribute['attributeId']}}"
                                        required>


                                    <input type="hidden" value='0' name='verified' required>
                                    @if(Auth::user())
                                    <input type="hidden" value="{{$user->id}}" name='userId' required>
                                    <input type="hidden" value="{{$user->companyId}}" name='companyId' required>

                                    @endif
                                    <div class="container text-center mt-3">
                                        <button class="btn btn-primary " type='submit' id='butform'>Enviar Archivo</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                            <div class="message">
                            @if(session("errors"))
                                @foreach($errors as $error)
                                <li class='' id=''>{{$error}}</li>
                                @endforeach
                                @endif
                                @if(session("success"))
                                <h4 class='alert-success' id='message'>{{session('success')}}</h4>

                                @endif
                            </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
