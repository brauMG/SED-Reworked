@extends('layouts.app')

@section('content')
    <div class="layoutContainer">
        <div class="container mb-4">
            <div class="row">
                <div class="col text-center btn-hover">
                    <a href="{{url('/superAdmin')}}" class="btn border-light btn-layout btn-grid btns-grid">
                        <div><span class="material-icons">supervisor_account</span></div>
                        <div>Lista de Administradores</div>
                    </a>
                </div>
                <div class="col text-center btn-hover">
                    <a href="{{url('/superAdmin/viewCompanies/create')}}" class="btn border-light btn-layout btn-grid btns-grid">
                        <div><span class="material-icons">list</span></div>
                        <div>Lista de Empresas</div>
                    </a>
                </div>
                <div class="col text-center btn-hover">
                    <a href="{{url('/superAdmin/viewSponsors/listSponsors')}}" class="btn border-light btn-layout btn-grid btns-grid">
                        <div><i class="material-icons">format_list_numbered</i></div>
                        <div>Lista de Patrocinadores</div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class='container'>
        <div data-simplebar class="card-height-add-admin">
            <div class="col text-center">
                <div class="justify-content-center">
                    <div class="card card-add-company">

                        <div class="card-header card-header-cute">
                            <h4 class="no-bottom" style="text-transform: uppercase">Ver Registro de Administrador</h4>
                        </div>
                        <div class="container-company" style="background-color: rgba(18,51,74,0.33)">
                            <h5 class="h5-pad"><strong> Empresa: {{ $admin->name }} </strong></h5>
                        </div>
                        @if ( session('mensaje') )
                            <div class="container-edits" style="margin-top: 2%">
                                <div class="alert alert-success" class='message' id='message'>{{ session('mensaje') }}</div>
                            </div>
                        @endif
                        @if ( session('mensajeError') )
                            <div class="container-edits" style="margin-top: 2%">
                                <div class="alert alert-danger" class='message' id='message'>{{ session('mensajeError') }}</div>
                            </div>
                    @endif
                    {{--                        @can('update')--}}

                    {{--                            <form method="POST" action="{{ route('DeleteCustomer',$admin->companyId) }}">--}}
                    {{--                                @method('PUT')--}}
                    {{--                                @csrf--}}
                    {{--                                @if ($admin->status == 1)--}}
                    {{--                                    <input type="text" name="status" style="width: 0px;border:none; " readonly value="0">--}}
                    {{--                                    <input type="submit" value="Deshabilitar" class="btn" style="background-color: red;color:white;">@endif--}}
                    {{--                                @if ($admin->status != 1)--}}
                    {{--                                    <input type="text" name="status" style="width: 0px;border:none; " readonly value="1">--}}
                    {{--                                    <input type="submit" value="Habilitar" class="btn" style="background-color: #5cb85c;color:white;">--}}
                    {{--                                @endif--}}
                    {{--                            </form>--}}
                    {{--                        @endcan--}}
                    <!--Desaparece-->
                        <div class="container-edits">
                            <div class="container btn-group" role="group">
                                <input type="button" class="btn" value="Datos Personales" style="background-color: #0F4C75; color: white" disabled>
                            </div>
                            <!--TABLES-->
                            <form class="form-edits" id="from" method="POST" action="{{ route('UpdateAdmin',[$admin->id,$admin->companyId]) }}" style="margin-bottom: 2% !important;">
                                @csrf
                                <table class="table-responsive table-card-inline" id="tAdmin">
                                    <!--TABLA ADMIN-->
                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-user-tag"></i> Usuario</th>
                                        <td class="td-card">
                                            <input type="text" name="username" id="usernameS" class="form-control" readonly value="{{ $admin->username }}">
                                        </td>
                                    </tr>
                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-signature"></i> Nombre</th>
                                        <td class="td-card">
                                            <input type="text" name="firstName" id="firstNameS"  class="form-control" readonly value="{{ $admin->firstName }}">
                                        </td>
                                    </tr>
                                    <tr class="tr-card-complete">
                                        <th class="th-card"> <i class="fas fa-signature"></i>Apellido</th>
                                        <td class="td-card">
                                            <input type="text" name="lastName" id="lastNameS"  class="form-control" readonly value="{{ $admin->lastName }}">
                                        </td>
                                    </tr>
                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-envelope-open-text"></i> Email</th>
                                        <td class="td-card">
                                            <input type="email" name="email" id="emailUserS"  class="form-control" readonly value="{{ $admin->emailuser }}">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <div id="buttContainer">
                                <div class='container'>
                                    <a href="{{ route('EditAdmin', $admin->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar</a>
                                    <button class="btn btn-danger" id="eliminar" data-toggle="modal" data-target="#DeleteModal"><i class="fas fa-trash"></i> Eliminar Administrador</button>
                                </div>
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
