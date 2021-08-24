@extends('layouts.app')
@section('content')
    <div class="layoutContainer" >
        <div class="container mb-4">
            <div class="row">
                <div class="col text-center btn-hover">
                    <a class="selected btn btns-grid border-light btn-layout btn-grid">
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

    <div class="col text-center btn-hover2">
        <a href="{{ url('/admins/area/addArea') }}" class="btn btn-primary" style="margin-right: 3%">
            <div class="button-2 fix-0">
                <div><i class="material-icons" style="vertical-align: bottom;">
                        add_to_photos
                    </i></div>
                <div>Añadir Área</div>
            </div>
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
        <div data-simplebar class="table-responsive table-height">
            @if ( session('mensajeError') )
                <div class="container-edits" style="margin-top: 2%">
                    <div class="alert alert-danger" class='message' id='message'>{{ session('mensajeError') }}</div>
                </div>
            @endif
            @if ( session('mensaje') )
                <div class="container-edits" style="margin-top: 2%">
                    <div class="alert alert-success" class='message' id='message'>{{ session('mensaje') }}</div>
                </div>
            @endif
            @if(empty($areas))
                <div class="alert alert-danger" >
                    {{ 'Agrega un área para empezar a trabajar.' }}
                </div>
            @endif
                <div class="col text-center">
                    <table class="table table-striped table-bordered mydatatable">
                        <thead class="table-header">
                        <tr>
                            <th class="" scope="col" style="text-transform: uppercase">Área</th>
                            <th class="" scope="col" style="text-transform: uppercase">Resultados</th>
                            <th class="" scope="col" style="text-transform: uppercase">Registro</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($areas as $area)
                            <tr>
                                <td class="td td-center" style="font-size: large">{{$area->name }}</td>
                                <td class="td td-center">
                                    <a href="{{ route('adminViewResults', $area->areaId) }}" class="btn-row btn btn-warning"><i class="fas fa-edit"></i> Ir</a>
                                </td>
                                <td class="td td-center">
                                    <a href="{{ route('showAreaAD', $area->areaId) }}" class="btn-row btn btn-info"><i class="fas fa-bookmark"></i> Mostrar</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="table-footer">
                        <tr>
                            <th class="" scope="col" style="text-transform: uppercase">Área</th>
                            <th class="" scope="col" style="text-transform: uppercase">Resultados</th>
                            <th class="" scope="col" style="text-transform: uppercase">Registro</th>
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

