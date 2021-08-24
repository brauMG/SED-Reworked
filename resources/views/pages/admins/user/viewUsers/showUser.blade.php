@extends('layouts.app')

@section('content')
    <div class="layoutContainer" >
        <div class="container mb-4">
            <div class="row">
                <div class="col text-center btn-hover">
                    <a href="{{url('/admin')}}" class="btn btns-grid border-light btn-layout btn-grid">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    format_list_numbered
                                </i></div>
                            <div>Lista de Áreas</div>
                    </a>
                </div>
                <div class="col text-center btn-hover">
                    <a href="{{ url('/admins/maturity/index') }}" class="btn btns-grid border-light btn-layout btn-grid">
                        <div><i class="material-icons" style="vertical-align: bottom;">
                                format_list_numbered
                            </i></div>
                        <div>Lista de Niveles de Madurez</div>
                    </a>
                </div>
                <div class="col text-center btn-hover">
                    <a href="{{ url('/admins/user/index') }}" class="btn btns-grid border-light btn-layout btn-grid">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    format_list_numbered
                                </i></div>
                            <div>Lista de Usuarios</div>
                    </a>
                </div>
                <div class="col text-center btn-hover">
                    <a href="{{url('/admins/area/test/listTest')}}" class="btn btns-grid border-light btn-layout btn-grid">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    format_list_numbered
                                </i></div>
                            <div>Lista de Pruebas</div>
                    </a>
                </div>
                <div class="col text-center btn-hover">
                    <a href="{{url('/admins/history')}}" class="btn btns-grid border-light btn-layout btn-grid">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    history
                                </i></div>
                            <div>Historial</div>
                    </a>
                </div>
                @if(empty($areas))
                    <div class="col text-center btn-hover">
                        <a href="" class="btn btns-grid border-light btn-layout btn-grid">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    remove_red_eye
                                </i></div>
                            <div>Ver Resultados</div>
                        </a>
                    </div>

                @else
                    <div class="col text-center btn-hover">
                        <a href="{{route('adminViewResults',$areas[0]->areaId)}}" class="btn btns-grid border-light btn-layout btn-grid">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    remove_red_eye
                                </i></div>
                            <div>Ver Resultados</div>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class='container'>
        <div data-simplebar class="card-height-add-admin" style="height: 635px !important;">
            <div class="col text-center">
                <div class="justify-content-center">
                    <div class="card card-add-company">

                        <div class="card-header card-header-cute">
                            <h4 class="no-bottom" style="text-transform: uppercase">Editar datos de usuario</h4>
                        </div>
                        <div class="container-company" style="background-color: rgba(18,51,74,0.33)">
                            <h5 class="h5-pad"><strong> Empresa: {{ $company->name }} </strong></h5>
                        </div>
                        @if ( session('mensaje') )
                            <div class="container-edits" style="margin-top: 2%">
                                <div class="alert alert-success" class='message' id='message'>{{ session('mensaje') }}</div>
                            </div>
                        @endif
                        <div class="container-edits">
                            <div class="container btn-group" role="group">
                                <input type="button" class="btn" value="Datos Personales" style="background-color: #0F4C75; color: white" disabled>
                            </div>
                            <!--TABLES-->
                            <form class="form" id="from" method="POST" action="{{ route('UpdateUsers',[$User['id']]) }}">
                                <div class="form-edits" style="margin-bottom: 2% !important;">
                                @method('PUT')
                                @csrf
                                <table class="table-responsive table-card-inline" id="tAdmin">

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-user-tag"></i> Usuario</th>
                                        <td class="td-card">
                                            <input type="text" name="username" id="usernameU" class="form-control" readonly value="{{ $User['username'] }}">
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-signature"></i> Nombre</th>
                                        <td class="td-card">
                                            <input type="text" name="firstName" id="firstNameU" class="form-control" readonly value="{{ $User['firstName'] }}">
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-signature"></i> Apellido</th>
                                        <td class="td-card">
                                            <input type="text" name="lastName" id="lastNameU" class="form-control" readonly value="{{ $User['lastName'] }}">
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-envelope-open-text"></i> Email</th>
                                        <td class="td-card">
                                            <input type="text" name="emailuser" id="emailuserU" class="form-control" readonly value="{{ $User['email'] }}">
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-file-signature"></i> Áreas</th>
                                        <td class="td-card">
                                            <div id="areauser" class="container" style="text-align: left">
                                                @foreach ($User_Area as $UA)
                                                    {{ $UA->name }} <br>
                                                @endforeach
                                            </div>

                                            <div id="check" style="display:none; text-align: left !important;" class="custom-control custom-checkbox">
                                                @php($count=0)
                                                @foreach ($Array_Areas as $UA)

                                                    @if ($UA['validar'])
                                                        <input class="form-check-input" type="checkbox" name="checked{{ $UA['areaId']}}" value="{{ $UA['areaId']}}" id="defaultCheck{{ $UA['areaId']}}" checked="true">
                                                    @else
                                                        <input class="form-check-input" type="checkbox" name="checked{{ $UA['areaId']}}" value="{{ $UA['areaId']}}" id="defaultCheck{{ $UA['areaId']}}">
                                                    @endif
                                                    <label class="form-check-label" for="defaultCheck{{ $UA['areaId']}}">{{ $UA['name']}}</label>
                                                    <br>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                            </form>
                            <div class='container'>
                                <a href="{{ route('EditUser', $User['id']) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar</a>
                                <button class="btn btn-danger" id="eliminar" data-toggle="modal" data-target="#DeleteModal"><i class="fas fa-trash"></i> Eliminar Usuario</button>
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
                    <h5 class="modal-title upcase"  id="exampleModalLongTitle" style="color: white">Eliminar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('DeleteUsers', $User['id'])}}" method="POST">
                    @csrf
                    <div style="background-color: white;color: black;">
                        <center>
                            <div class="modal-body" >
                                ¿Deseas eliminar por completo los datos del usuario?
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
