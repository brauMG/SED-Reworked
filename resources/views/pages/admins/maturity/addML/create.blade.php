@extends('layouts.app', ['activePage' => 'AdminAddML', 'titlePage' => __('Añadir Niveles de Madurez')])

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
                            <h4 class="card-title text-white">Agregar Administrador</h4>
                            <p class="card-category">Ingresa los datos necesarios para añadir un nuevo administrador al sistema.</p>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="/admins/maturity/addML/create">
                                @csrf
                                <table class="table-responsive table-card-inline" style="width: fit-content !important;; margin: auto">
                                    <tr>
                                        <th class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">table_view</span> Nombre del Grupo de Niveles
                                        </th>
                                        <td class="td-card pl-1"> <input type="text"
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    name="name" value="{{ old('name') }}" required
                                                                    autocomplete="name" autofocus>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th id="address" class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">looks_one</span> Nombre del Nivel de Madurez 1</th>
                                        <td class="td-card pl-1"> <input id="level1" type="text"
                                                                    class="form-control @error('level1') is-invalid @enderror"
                                                                    name="level1" required>
                                            @error('level1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th id="address" class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">looks_two</span> Nombre del Nivel de Madurez 2</th>
                                        <td class="td-card pl-1"> <input id="level2" type="text"
                                                                    class="form-control @error('level2') is-invalid @enderror"
                                                                    name="level2" required>
                                            @error('level2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th id="address" class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">looks_3</span> Nombre del Nivel de Madurez 3</th>
                                        <td class="td-card pl-1"> <input id="level3" type="text"
                                                                    class="form-control @error('level3') is-invalid @enderror"
                                                                    name="level3" required>
                                            @error('level3')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th id="address" class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">looks_4</span> Nombre del Nivel de Madurez 4</th>
                                        <td class="td-card pl-1"> <input id="level4" type="text"
                                                                    class="form-control @error('level4') is-invalid @enderror"
                                                                    name="level4" required>
                                            @error('level4')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th id="address" class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">looks_5</span> Nombre del Nivel de Madurez 5</th>
                                        <td class="td-card pl-1"> <input id="level5" type="text"
                                                                    class="form-control @error('level5') is-invalid @enderror"
                                                                    name="level5" required>
                                            @error('level5')
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
