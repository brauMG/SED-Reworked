@extends('layouts.app', ['activePage' => 'AdminAddUsers', 'titlePage' => __('Mostrar Usuario')])

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
                            <h4 class="card-title text-white">Mostrando Registro de Usuario</h4>
                        </div>

                        <div class="card-body">
                            <form class="form" id="from" method="POST" action="{{ route('UpdateUsers',[$User['id']]) }}">
                                <div class="form-edits" style="margin-bottom: 2% !important;">
                                @method('PUT')
                                @csrf
                                <table class="table-responsive table-card-inline" id="tAdmin">

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">badge</span> Usuario</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="username" id="usernameU" class="form-control" disabled value="{{ $User['username'] }}">
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">assignment_ind</span> Nombre</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="firstName" id="firstNameU" class="form-control" disabled value="{{ $User['firstName'] }}">
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">assignment_ind</span> Apellido</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="lastName" id="lastNameU" class="form-control" disabled value="{{ $User['lastName'] }}">
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">email</span> Email</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="emailuser" id="emailuserU" class="form-control" disabled value="{{ $User['email'] }}">
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">account_tree</span> Áreas</th>
                                        <td class="td-card pl-1">
                                            <div id="areauser" class="container" style="text-align: left">
                                                @foreach ($User_Area as $UA)
                                                    {{ $UA->name }} <br>
                                                @endforeach
                                            </div>

                                            <div id="check" style="display:none; text-align: left !important;" class="custom-control custom-checkbox">
                                                @php($count=0)
                                                @foreach ($Array_Areas as $UA)

                                                    @if ($UA['validar'])
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="checkbox" name="areasIds[]" value="{{ $UA['areaId']}}"  checked disabled>
                                                                {{ $UA['name'] }}
                                                                <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                            </label>
                                                        </div>
                                                    @else
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="checkbox" name="areasIds[]" value="{{ $UA['areaId']}}" disabled>
                                                                {{ $UA['name'] }}
                                                                <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                            </label>
                                                        </div>
                                                    @endif
                                                    <br>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                            </form>
                            <div class='container text-center mt-3'>
                                <a href="{{ route('EditUser', $User['id']) }}" class="btn btn-warning"> Editar</a>
                                <button class="btn btn-danger" id="eliminar" data-toggle="modal" data-target="#DeleteModal"> Eliminar Usuario</button>
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
