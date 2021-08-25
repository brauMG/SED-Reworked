@extends('layouts.app', ['activePage' => 'SuperAddCompanies', 'titlePage' => __('Editar Compañia')])

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
                            <h4 class="card-title text-white">Editar Registro de Compañia</h4>
                            <p class="card-category">Realiza los cambios de datos necesarios para editar la compañia.</p>
                        </div>

                        <div class="card-body">
                            <form class="form" id="from" method="POST" action="{{ route('UpdateCompany',$admin->companyId) }}" style="margin-bottom: 2% !important;">
                                @method('PUT')
                                @csrf
                                <table class="table-responsive table-card-inline" style="width: fit-content !important;; margin: auto" id="EditCompany_SA">

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">business</span> Empresa</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="name" id="nameC" class="form-control @error('name') is-invalid @enderror" value="{{ $admin->name }}">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">admin_panel_settings</span> Dirección</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="address" id="addressC" class="form-control @error('address') is-invalid @enderror" value="{{ $admin->address }}">
                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">call</span> Teléfono</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="phoneNumber" id="phoneNumberC" class="form-control @error('phoneNumber') is-invalid @enderror" value="{{ $admin->phoneNumber }}">
                                            @error('phoneNumber')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">email</span> Email</th>
                                        <td class="td-card pl-1">
                                            <input type="email" name="email" id="emailC" class="form-control @error('email') is-invalid @enderror" value="{{ $admin->email }}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
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
                                <div class='container text-center mt-3'>
                                    <input type="submit" class="btn btn-warning" value="Guardar Cambios">
                                    <a href="{{route('CancelCompany')}}" class="btn btn-primary"> Cancelar</a>
                                </div>
                            </form>
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
