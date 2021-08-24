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
                            <h4 class="no-bottom" style="text-transform: uppercase">Editar Registro de Administrador</h4>
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
                                <div class="alert alert-warning" class='message' id='message'>{{ session('mensajeError') }}</div>
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
                            <form class="form" id="from" method="POST" action="{{ route('UpdateAdmin',[$admin->id,$admin->companyId]) }}" style="margin-bottom: 2% !important;">
                                <div class="form-edits" style="margin-bottom: 1% !important;">
                                @csrf
                                <table class="table-responsive table-card-inline" id="tAdmin">
                                    <!--TABLA ADMIN-->
                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-user-tag"></i> Usuario</th>
                                        <td class="td-card">
                                            <input type="text" name="username" id="usernameS" class="form-control @error('username') is-invalid @enderror" value="{{ $admin->username }}">
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-signature"></i> Nombre</th>
                                        <td class="td-card">
                                            <input type="text" name="firstName" id="firstNameS"  class="form-control @error('firstName') is-invalid @enderror" value="{{ $admin->firstName }}">
                                            @error('firstName')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="tr-card-complete">
                                        <th class="th-card"> <i class="fas fa-signature"></i>Apellido</th>
                                        <td class="td-card">
                                            <input type="text" name="lastName" id="lastNameS"  class="form-control @error('lastName') is-invalid @enderror" value="{{ $admin->lastName }}">
                                            @error('lastName')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-envelope-open-text"></i> Email</th>
                                        <td class="td-card">
                                            <input type="email" name="email" id="emailUserS"  class="form-control @error('email') is-invalid @enderror" value="{{ $admin->emailuser }}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                </table>
                                </div>
                                <div class='container'>
                                    <input type="submit" class="button-size-08 btn btn-add btn-warning" value="Guardar Cambios">
                                    <a href="{{route('CancelAdmin')}}" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @endsection
