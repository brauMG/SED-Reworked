@extends('layouts.app')

@section('content')

    <div class="layoutContainer">
        <div class="container mb-4">
            <div class="row">

                <div class="col text-center btn-hover">
                    <a href="{{ url('/comun') }}" class="btn btns-grid border-light btn-layout btn-grid" style="width: 30% !important;">
                        <div><i class="material-icons" style="vertical-align: bottom;">
                                home
                            </i> </div>
                        <div>Inicio</div>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div data-simplebar class="card-height-add-admin">
            <div class="col text-center">
                <div class="justify-content-center">
                    <div class="card card-add-company">

                        <div class="card-header card-header-cute">
                            <h4 class="no-bottom" style="text-transform: uppercase">Subir Evidencia</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{url('/upload')}}" method='POST' enctype="multipart/form-data" id='form'>
                                @csrf

                                <div class="container" style="color:red !important;">
                                    Tamaño Máximo del Archivo: 50 MB
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
                                <div class="buttcontainer">
                                    <button class="btn btn-add " type='submit' id='butform'>Enviar Archivo</button>
                                </div>

                            </form>
                        </div>
                    </div>
                            @include('errors')
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
            </section>
        </div>
    </div>

</main>

@endsection
