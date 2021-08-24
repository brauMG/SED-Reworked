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

    <div class="container">
        <div data-simplebar class="card-height-add-user-to-company">
            <div class="col text-center">
                <div class="justify-content-center">
                    <div class="card card-add-company">

                        <div class="card-header card-header-cute">
                            <h4 class="no-bottom" style="text-transform: uppercase">crear nuevo grupos de niveles de madurez</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="/admins/maturity/addML/create">
                                @csrf
                                <table class="table-responsive table-card-inline" id="tAdmin">
                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-user-check"></i> Nombre del Grupo de Niveles
                                        </th>
                                        <td class="td-card"> <input type="text"
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    name="name" value="{{ old('name') }}" required
                                                                    autocomplete="name" autofocus>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th id="address" class="th-card"><i class="fas fa-key"></i> Nombre del Nivel de Madurez 1</th>
                                        <td class="td-card"> <input id="level1" type="text"
                                                                    class="form-control @error('level1') is-invalid @enderror"
                                                                    name="level1" required>
                                            @error('level1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th id="address" class="th-card"><i class="fas fa-key"></i> Nombre del Nivel de Madurez 2</th>
                                        <td class="td-card"> <input id="level2" type="text"
                                                                    class="form-control @error('level2') is-invalid @enderror"
                                                                    name="level2" required>
                                            @error('level2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th id="address" class="th-card"><i class="fas fa-key"></i> Nombre del Nivel de Madurez 3</th>
                                        <td class="td-card"> <input id="level3" type="text"
                                                                    class="form-control @error('level3') is-invalid @enderror"
                                                                    name="level3" required>
                                            @error('level3')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th id="address" class="th-card"><i class="fas fa-key"></i> Nombre del Nivel de Madurez 4</th>
                                        <td class="td-card"> <input id="level4" type="text"
                                                                    class="form-control @error('level4') is-invalid @enderror"
                                                                    name="level4" required>
                                            @error('level4')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th id="address" class="th-card"><i class="fas fa-key"></i> Nombre del Nivel de Madurez 5</th>
                                        <td class="td-card"> <input id="level5" type="text"
                                                                    class="form-control @error('level5') is-invalid @enderror"
                                                                    name="level5" required>
                                            @error('level5')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                </table>

                                <div class="container">
                                    <button type="submit" class="button-size-08 btn btn-add btn-primary">Agregar Datos</button>
                                </div>
                            </form>

                            @include('errors')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
