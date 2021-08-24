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
                    <a class="selected btn btns-grid border-light btn-layout btn-grid">
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

    <div class="col text-center btn-hover2">
        <a href="{{ url('/addUser/create') }}" class="btn btn-primary">
                <div><i class="material-icons" style="vertical-align: bottom;">
                        add_box
                    </i></div>
                <div>Añadir Usuario</div>
        </a>
    </div>

    <div class="container">
        @if ( session('mensaje') )
            <div class="container-edits" style="margin-top: 2%">
                <div class="alert alert-success" class='message' id='message'>{{ session('mensaje') }}</div>
            </div>
        @endif
        <div data-simplebar class="table-responsive table-height" style="height: 800px !important;">
            <div class="col text-center">
                <table class="table table-striped table-bordered mydatatable">
                    <thead class="table-header">
                    <tr>
                        <th>#</th>
                        <th>NOMBRE</th>
                        <th>USUARIO</th>
                        <th>TIPO DE USUARIO</th>
                        <th>AREAS ASIGNADAS</th>
                        <th>CORREO PERSONAL</th>
                        <th>REGISTRO</th>
                    </tr>
                    </thead>
                    <tbody class="" id="TableCustom">
                    @foreach ($Users as $user)
                        <tr>
                            <td class="td td-center">{{ $user->id }}</td>
                            <td class="td td-center">{{ $user->firstName." ".$user->lastName }}</td>
                            <td class="td td-center">{{ $user->username }}</td>
                            @if ($user->role_id == 3)
                                <td class="td td-center">Analista</td>
                            @endif
                            @if ($user->role_id == 4)
                                <td class="td td-center">Comun</td>
                            @endif
                            <td class="td td-center">{{$user->name}}</td>
                            <td class="td td-center">{{ $user->email }}</td>
                            <td class="td td-center">
                                <a href="{{ route('ShowUser', $user->id) }}" class="btn-row btn btn-info"><i class="fas fa-bookmark"></i> Mostrar</a>
                                <a href="{{ route('EditUser', $user->id) }}" class="btn-row btn btn-warning"><i class="fas fa-edit"></i> Editar</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot class="table-footer">
                    <tr>
                        <th>#</th>
                        <th>NOMBRE</th>
                        <th>USUARIO</th>
                        <th>TIPO DE USUARIO</th>
                        <th>AREAS ASIGNADAS</th>
                        <th>CORREO PERSONAL</th>
                        <th>REGISTRO</th>
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
