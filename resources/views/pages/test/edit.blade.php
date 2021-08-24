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
                            <h4 class="no-bottom" style="text-transform: uppercase">Reemplazar Evidencia</h4>
                        </div>

                        <div class="card-body">
                            <form method='POST' action="{{route('upload.update', $data->evidenceId)}}"
                                enctype='multipart/form-data'>
                                <!-- Browsers don't yet understand PATCH and DELETE request types for your forms.
    To get around this limitation: method_field("PATCH") & csrf_field() -->
                                @method('PATCH')
                                @csrf

                                <div class="container" style="color:red !important;">
                                        Tamaño Máximo del Archivo: 50 MB
                                </div>

                                <div class="container">
                                    <input name="link" id='link' type="file"
                                           class="custom-file  @error('link') is-invalid @enderror" required autocomplete="link" autofocus
                                           value={{Request::old('link')}}>
                                    @error('link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <section class="field">


                                    <section class="control">

                                        <input type="hidden" class="input" name='attributeId'
                                            value='{{$data->attributeId}}'>

                                    </section>

                                </section>

                                <section class="field">


                                    <section class="control">

                                        <input type="hidden" class="input" name='verified' value='{{$data->verified}}'>

                                    </section>

                                </section>

                                <section class="field">


                                    <section class="control">

                                        <input type="hidden" class="input" name='userId' value='{{$data->userId}}'>

                                    </section>

                                </section>
                                <section class="field">


                                    <section class="control">

                                        <input type="hidden" class="input" name='companyId'
                                            value='{{$data->companyId}}'>

                                    </section>

                                </section>
                                <!-- <section class="field">

        <label for="evidenceId" class="label">evidenceId</label>

        <section class="control">

            <input type="integer" class="input" name='evidenceId' value='{{$data->evidenceId}}'>

        </section>

    </section> -->
                                <div class="container">
                                    <button class="btn btn-add " name='edit' type='submit' id='butform'>Enviar Nuevo Archivo</button>
                                </div>

                            </form>
                            @include('errors')
                            <div class="message">
                                @if(session("errors"))
                                @foreach($errors as $error)
                                <li class='message' id='message'>{{$error}}</li>
                                @endforeach
                                @else(session("success"))
                                <h4 class='message' id='message'>{{session('success')}}</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </div></div>
@endsection
