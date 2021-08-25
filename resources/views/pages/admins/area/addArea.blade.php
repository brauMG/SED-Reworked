@extends('layouts.app', ['activePage' => 'AdminAddAreas', 'titlePage' => __('Añadir Área')])

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
                    <div class="card" style="width: fit-content; margin: auto">
                        <div class="card-header bg-dark">
                            <h4 class="card-title text-white">Agregar Área</h4>
                            <p class="card-category">Ingresa los datos necesarios para añadir una nueva Área a la compañia.</p>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="/createArea/admins">
                                @csrf
                                <table class="table-responsive table-card-inline" style="width: fit-content !important;; margin: auto">
                                    <tr>
                                        <th id="name" class="th-card pr-1">
                                            <span class="material-icons" style="vertical-align: sub">badge</span>
                                            Nombre de Área
                                        </th>
                                        <td class="td-card pl-1">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                </table>

                                <div class="container text-center mt-3">
                                    <button type="submit" class="btn btn-primary">Agregar Datos</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
