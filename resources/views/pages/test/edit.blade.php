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
                            <h4 class="card-title text-white">Reemplazar Evidencia</h4>
                        </div>
                            <div class="card-body">
                                <form method='POST' action="{{url('/upload/update', $data->evidenceId)}}"
                                    enctype='multipart/form-data'>
                                    @method('PUT')
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

                                    <div class="container text-center mt-3">
                                        <button class="btn btn-primary " name='edit' type='submit' id='butform'>Enviar Nuevo Archivo</button>
                                    </div>

                                </form>
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
            </div>
        </div>
@endsection
