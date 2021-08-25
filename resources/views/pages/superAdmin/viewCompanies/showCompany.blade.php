@extends('layouts.app', ['activePage' => 'SuperAddCompanies', 'titlePage' => __('Mostrar Compañia')])

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
                            <h4 class="card-title text-white">Mostrando Registro de Compañia</h4>
                        </div>

                        <div class="card-body">
                        <form id="formCompany" style="margin-bottom: 2% !important;">
                            @method('PUT')
                            @csrf
                                <table class="table-responsive table-card-inline" id="EditCompany_SA">

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1 pr-1"><span class="material-icons" style="vertical-align: sub">business</span> Empresa</th>
                                        <td class="td-card pl-1"><input type="text" name="name" id="nameC" class="form-control" disabled value="{{ $admin->name }}"></td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">admin_panel_settings</span> Dirección</th>
                                        <td class="td-card pl-1"><input type="text" name="address" id="addressC" class="form-control" disabled value="{{ $admin->address }}">
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">call</span> Teléfono</th>
                                        <td class="td-card pl-1"><input type="text" name="phoneNumber" id="phoneNumberC" class="form-control" disabled value="{{ $admin->phoneNumber }}"></td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">email</span> Email</th>
                                        <td class="td-card pl-1"><input type="email" name="email" id="emailC" class="form-control" disabled value="{{ $admin->email }}"></td>
                                    </tr>

                                    @if($admin->status == 1)
                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">sentiment_satisfied_alt</span> Estado Actual</th>
                                            <td class="td-card pl-1"><input type="text" name="estado" id="emailC" class="form-control" disabled value="Habilitado"></td>
                                        </tr>
                                    @else
                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">sentiment_satisfied_alt</span> Estado Actual</th>
                                            <td class="td-card pl-1"><input type="text" name="estado" id="emailC" class="form-control" disabled value="Deshabilitado"></td>
                                        </tr>
                                    @endif

                                </table>
                        </form>
                            <div class='container text-center mt-3'>
                                <a href="{{ route('EditCompany', $admin->companyId) }}" class="btn btn-warning"> Editar</a>
                            </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="ChangeStatusModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #8c8e0e">
                    <h5 class="modal-title upcase"  id="exampleModalLongTitle" style="color: white">Cambiar Estado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('ChangeStatus', $admin->companyId)}}" method="POST">
                    @csrf
                    <div style="background-color: white;color: black;">
                        <center>
                            <div class="modal-body" >
                                ¿Deseas cambiar el estado actual de esta empresa?
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
