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
        <div data-simplebar class="card-height-add-admin" style="height: 700px !important; margin-top: -1% !important;">
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
                        @if ( session('mensajeError') )
                            <div class="container-edits" style="margin-top: 2%">
                                <div class="alert alert-warning" class='message' id='message'>{{ session('mensajeError') }}</div>
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
                                            <input type="text" name="username" id="usernameU" class="form-control @error('username') is-invalid @enderror" value="{{ $User['username'] }}">
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
                                            <input type="text" name="firstName" id="firstNameU" class="form-control @error('firstName') is-invalid @enderror" value="{{ $User['firstName'] }}">
                                            @error('firstName')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-signature"></i> Apellido</th>
                                        <td class="td-card">
                                            <input type="text" name="lastName" id="lastNameU" class="form-control @error('lastName') is-invalid @enderror" value="{{ $User['lastName'] }}">
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
                                            <input type="email" name="email" id="emailuserU" class="form-control @error('email') is-invalid @enderror" value="{{ $User['email'] }}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-file-signature"></i> Áreas</th>
                                        <td class="td-card">

                                            <div id="check" style="text-align: left !important;" class="custom-control custom-checkbox">
                                                @php($count=0)
                                                @foreach ($Array_Areas as $UA)
                                                    @if ($UA['validar'])
                                                        <input class="form-check-input @error('areasIds') is-invalid @enderror" type="checkbox" name="areasIds[]" value="{{ $UA['areaId']}}" checked="true">
                                                    @else
                                                        <input class="form-check-input @error('areasIds') is-invalid @enderror" type="checkbox" name="areasIds[]" value="{{ $UA['areaId']}}">
                                                    @endif
                                                    <label class="form-check-label" for="defaultCheck{{ $UA['areaId']}}">{{ $UA['name']}}</label>
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
                                <div class='container'>
                                    <input type="submit" class="button-size-08 btn btn-add btn-warning" value="Guardar Cambios">
                                    <a href="{{route('CancelUser')}}" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
