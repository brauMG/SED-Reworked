@extends('layouts.app', ['activePage' => 'AdminAddUsers', 'titlePage' => __('Editar Usuario')])

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
                            <h4 class="card-title text-white">Editar Registro de Usuario</h4>
                            <p class="card-category">Realiza los cambios de datos necesarios para editar al usuario.</p>
                        </div>

                        <div class="card-body">
                            <form class="form" id="from" method="POST" action="{{ route('UpdateUsers',[$User['id']]) }}">
                                <div class="form-edits" style="margin-bottom: 2% !important;">
                                @method('PUT')
                                @csrf
                                    <table class="table-responsive table-card-inline" style="width: fit-content !important; height: 250px !important; margin: auto" id="tAdmin">

                                    <tr>
                                        <th class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">badge</span> Usuario</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="username" id="usernameU" class="form-control @error('username') is-invalid @enderror" value="{{ $User['username'] }}">
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">assignment_ind</span> Nombre</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="firstName" id="firstNameU" class="form-control @error('firstName') is-invalid @enderror" value="{{ $User['firstName'] }}">
                                            @error('firstName')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">assignment_ind</span> Apellido</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="lastName" id="lastNameU" class="form-control @error('lastName') is-invalid @enderror" value="{{ $User['lastName'] }}">
                                            @error('lastName')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">email</span> Email</th>
                                        <td class="td-card pl-1">
                                            <input type="email" name="email" id="emailuserU" class="form-control @error('email') is-invalid @enderror" value="{{ $User['email'] }}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">account_tree</span> Áreas</th>
                                        <td class="td-card pl-1">

                                            <div id="check" style="text-align: left !important;" class="custom-control custom-checkbox">
                                                @php($count=0)
                                                @foreach ($Array_Areas as $UA)
                                                    @if ($UA['validar'])
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="checkbox" name="areasIds[]" value="{{ $UA['areaId']}}" checked>
                                                                {{ $UA['name'] }}
                                                                <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                            </label>
                                                        </div>
                                                    @else
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="checkbox" name="areasIds[]" value="{{ $UA['areaId']}}" checked>
                                                                {{ $UA['name'] }}
                                                                <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                            </label>
                                                        </div>
                                                    @endif
                                                        <br>
                                                @endforeach
                                                @error('areasIds')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                </div>

                                <div class='container text-center mt-3'>
                                    <input type="submit" class="btn btn-warning" value="Guardar Cambios">
                                    <a href="{{route('CancelUser')}}" class="btn btn-primary"> Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
