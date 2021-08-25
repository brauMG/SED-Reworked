@extends('layouts.app', ['activePage' => 'SuperAddAdmins', 'titlePage' => __('Editar Administrador')])

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
                            <h4 class="card-title text-white">Editar Registro de Administrador</h4>
                            <p class="card-category">Realiza los cambios de datos necesarios para editar al administrador.</p>
                        </div>

                        <div class="card-body">
                            <form class="form" id="from" method="POST" action="{{ route('UpdateAdmin',[$admin->id,$admin->companyId]) }}" style="margin-bottom: 2% !important;">
                                @csrf
                                <table class="table-responsive table-card-inline" style="width: fit-content !important;; margin: auto" id="tAdmin">
                                    <!--TABLA ADMIN-->
                                    <tr>
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">verified_user</span> Usuario</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="username" id="usernameS" class="form-control @error('username') is-invalid @enderror" value="{{ $admin->username }}">
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">manage_accounts</span> Nombre</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="firstName" id="firstNameS"  class="form-control @error('firstName') is-invalid @enderror" value="{{ $admin->firstName }}">
                                            @error('firstName')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">assignment_ind</span> Apellido</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="lastName" id="lastNameS"  class="form-control @error('lastName') is-invalid @enderror" value="{{ $admin->lastName }}">
                                            @error('lastName')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">contact_mail</span> Email</th>
                                        <td class="td-card pl-1">
                                            <input type="email" name="email" id="emailUserS"  class="form-control @error('email') is-invalid @enderror" value="{{ $admin->emailuser }}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                </table>
                                <div class='container text-center mt-3'>
                                    <input type="submit" class="btn btn-warning" value="Guardar">
                                    <a href="{{route('CancelAdmin')}}" class="btn btn-primary">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
