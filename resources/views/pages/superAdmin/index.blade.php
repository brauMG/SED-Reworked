@extends('layouts.app')
@section('content')
    <div class="layoutContainer">
        <div class="container mb-4">
            <div class="row">
                <div class="col text-center btn-hover">
                    <a class="selected btn border-light btn-layout btn-grid btns-grid" disabled>
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
    @if ( session('mensaje') )
        <div class="container-edits" style="margin-top: 2%">
            <div class="alert alert-success" class='message' id='message'>{{ session('mensaje') }}</div>
        </div>
    @endif
    <div class="col text-center btn-hover2">
        <a href="{{url('CreateAdmin/addAdmin/create')}}" class="btn btn-primary" style="margin-right: 3%">
            <div><i class="material-icons">person_add</i></div>
            <div>Añadir Administrador</div>
        </a>

        <a target="_blank" href="{{ URL::to('/') }}/files/manualAdmin.pdf" class="btn btn-primary">
            <div class="button-2 fix-0">
                <div><i class="material-icons" style="vertical-align: bottom;">
                        get_app
                    </i></div>
                <div>Manual de Usuario</div>
            </div>
        </a>
    </div>

        <div class="container">
            <div data-simplebar class="table-responsive table-height" style="height: 820px !important;">
            <div class="col text-center">
            <table class="table table-striped table-bordered mydatatable">
                <thead class="table-header">
                <tr>
                    <th class="">ESTADO DE SU EMPRESA</th>
                    <th class="">EMPRESA</th>
                    <th class="">ADMINISTRADOR</th>
                    <th class="">USUARIO</th>
                    <th class="">TELÉFONO DE LA EMPRESA</th>
                    <th class="">CORREO DE LA EMPRESA</th>
                    <th class="">REGISTRO PERSONAL</th>
                </tr>
                </thead>
                <tbody class="">
                @foreach($Admins as $users)
                    <tr>
                        <td class="td-center">
                            <form class='form' method="POST" action="{{ route('ChangeStatus',$users->companyId) }}">
                                @method('PUT')
                                @csrf
                                @if ($users->status == 0)
                                    <input type="hidden" name="status" style="width: 0px;border:none; " readonly value="1">
                                    <input type="submit" value="Deshabilitado" class="btn btn-unavailable" disabled>@endif
                                @if ($users->status != 0)
                                    <input type="hidden" name="status" style="width: 0px;border:none; " readonly value="0">
                                    <input type="submit" value="Habilitado" class="btn btn-available" disabled>
                                @endif
                            </form>
                        </td>
                        <td class="td td-center">{{$users->name }}</td>
                        <td class="td td-center">{{ $users->firstName." ".$users->lastName }}</td>
                        <td class="td td-center">{{$users -> username}}</td>
                        <td class="td td-center">{{$users->phoneNumber }}</td>
                        <td class="td td-center">{{$users->email}}</td>
                        <td class="td td-center">
                            <a href="{{ route('ViewAdmin', $users->id) }}" class="btn-row btn btn-info"><i class="fas fa-bookmark"></i> Mostrar</a>
                            <a href="{{ route('EditAdmin', $users->id) }}" class="btn-row btn btn-warning"><i class="fas fa-edit"></i> Editar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot class="table-footer">
                <tr>
                    <th class="">ESTADO DE SU EMPRESA</th>
                    <th class="">EMPRESA</th>
                    <th class="">ADMINISTRADOR</th>
                    <th class="">USUARIO</th>
                    <th class="">TELÉFONO DE LA EMPRESA</th>
                    <th class="">CORREO DE LA EMPRESA</th>
                    <th class="">REGISTRO PERSONAL</th>
                </tr>
                </tfoot>
            </table>
            </div>
            </div>
        </div>
    <script>
        $('.mydatatable').DataTable();
    </script>
@endsection
