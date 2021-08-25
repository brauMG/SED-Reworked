@extends('layouts.app', ['activePage' => 'SuperAddAdmins', 'titlePage' => __('Mostrar Administrador')])

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
                            <h4 class="card-title text-white">Mostrando Registro de Administrador</h4>
                        </div>

                        <div class="card-body">
                            <form class="form-edits" id="from" style="margin-bottom: 2% !important;">
                                @csrf
                                <table class="table-responsive table-card-inline" style="width: fit-content !important;; margin: auto" id="tAdmin">
                                    <!--TABLA ADMIN-->
                                    <tr>
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">verified_user</span> Usuario</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="username" id="usernameS" class="form-control" disabled value="{{ $admin->username }}">
                                        </td>
                                    </tr>
                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">manage_accounts</span> Nombre</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="firstName" id="firstNameS"  class="form-control" disabled value="{{ $admin->firstName }}">
                                        </td>
                                    </tr>
                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">assignment_ind</span> Apellido</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="lastName" id="lastNameS"  class="form-control" disabled value="{{ $admin->lastName }}">
                                        </td>
                                    </tr>
                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">contact_mail</span> Email</th>
                                        <td class="td-card pl-1">
                                            <input type="email" name="email" id="emailUserS"  class="form-control" disabled value="{{ $admin->emailuser }}">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <div class='container text-center mt-3'>
                                <a href="{{ route('EditAdmin', $admin->id) }}" class="btn btn-warning">Editar</a>
                                <button class="btn btn-danger" id="eliminar" data-toggle="modal" data-target="#DeleteModal">Eliminar Administrador</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="DeleteModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #761b18">
                        <h5 class="modal-title upcase"  id="exampleModalLongTitle" style="color: white">Eliminar Administrador</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('DestroyAdmin', [$admin->id, $admin->companyId])}}" method="POST">
                        @csrf
                        <div style="background-color: white;color: black;">
                            <center>
                                <div class="modal-body" >
                                    ¿Deseas eliminar por completo los datos del administrador?
                                </div>
                                <div class="spinner-border m-5" role="status" style="display: none;">
                                    <span class="sr-only">Cargando...</span>
                                </div>
                            </center>
                        </div>

                        <div class="modal-footer" style="background-color: white;color: black;">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
