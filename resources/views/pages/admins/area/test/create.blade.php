@extends('layouts.app')
<?php
use App\User_Area;
?>
@section('content')
    @inject('areas', 'App\Services\Areas')
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
                        <a href="{{route('adminViewResults',$areas2[0]->areaId)}}" class="btn btns-grid border-light btn-layout btn-grid">
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

    <div class="container" id="app">
        <div data-simplebar class="card-height-add-test"  style="height: 800px !important;; padding-top: 0% !important;">
            <div class="col text-center">
                <div class="justify-content-center">
                    <div class="card card-add-company">

                        <div class="card-header card-header-cute">
                            <h4 class="no-bottom" style="text-transform: uppercase">crear nueva prueba</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="/createTest/admins">
                                @csrf
                                <table class='table-responsive table-card-inline'>
                                    <tr class="tr-card-complete">
                                        <th class="th-card" id="address"><i class="fas fa-envelope-open-text"></i> Prueba</th>
                                        <td class="td-card"> <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                required autocomplete="name" placeholder="Nombre de la prueba">

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <div class="input-group mb-3">
                                            <th class="th-card" id="groupML"><i class="fas fa-layer-group"></i> Grupo de Niveles de Madurez</th>
                                            <td class="td-card">
                                                <select data-old="{{ old('groupML') }}"  type='text' required class="custom-select @error('groupML') is-invalid @enderror" name="groupML">
                                                    @foreach($groupML as $ML)
                                                        <option value="{{ $ML->MLGroupId }}">
                                                            {{ $ML->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('groupML')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </td>
                                        </div>
                                    </tr>

                                    <tr>
                                        <div class="input-group mb-3">
                                            <th class="th-card" id="area"><i class="fas fa-chart-area"></i> Área</th>
                                            <td class="td-card">
                                                <select v-model="selected_area" @change="loadUsers" data-old="{{ old('area') }}"  type='text' required id="area" class="custom-select @error('area') is-invalid @enderror" name="area">
                                                    @foreach($areas->get() as $index => $area)
                                                    <option value="{{ $index }}">
                                                        {{ $area }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('area')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </td>
                                        </div>
                                    </tr>

                                    <tr>
                                        <th class="th-card" id="name"><i class="fas fa-user-tag"></i> Usuario</th>
                                        <td class="td-card">
                                            <select v-model="selected_user" data-old="{{ old('user') }}"  type='text' required id="user" class="custom-select @error('user') is-invalid @enderror" name="user">
                                                <option value="">Selecciona un usuario</option>
                                                <option v-for="(user, index) in users" v-bind:value="index">
                                                    @{{user}}
                                                </option>>
                                            </select>
                                            @error('user')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <th  class="th-card" id="address"><i class="fas fa-file-word"></i> Concepto</th>
                                        <td class="td-card"> <input id="concept" type="text"
                                                class="form-control @error('concept') is-invalid @enderror"
                                                name="concept" required autocomplete="concept" placeholder="Nombre del concepto asignado">

                                            @error('concept')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    @foreach($repeat as $maturity)
                                    <tr class='tr-card-complete'>
                                        <th class="th-card" class='bold' id="address addy" colspan="2">Atributos del Nivel de Madurez #{{$ml_number}}</th>
                                    </tr>
                                    <input type="hidden" value="{{$ml_number++}}">
                                    @if($maturity == 1)
                                            @foreach(range(0,2) as $x)
                                                <tr>
                                                    <th class="th-card"><i class="far fa-chart-bar"></i> Atributo #{{$attribute_number}}</th>
                                                    <td class="td-card"> <input type="text"
                                                                                class="form-control @error('attribute') is-invalid @enderror"
                                                                                name="muy_bajo[{{$x}}]" required autocomplete="muy_bajo[{{$x}}]">

                                                        @error('attribute')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia #{{$attribute_number}}</th>
                                                    <td class="td-card"> <div class="form-group">
                                                            <textarea class="form-control" rows="5" id="comment" required name="muy_bajo_sugerencia[{{$x}}]" style="background-color: #eff0ee"></textarea>
                                                        </div>
                                                        @error('attribute')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <input type="hidden" value="{{$attribute_number++}}">
                                            @endforeach
                                    @endif
                                        @if($maturity == 2)
                                            @foreach(range(0,2) as $x)
                                                <tr>
                                                    <th class="th-card"><i class="far fa-chart-bar"></i> Atributo #{{$attribute_number}}</th>
                                                    <td class="td-card"> <input type="text"
                                                            class="form-control @error('attribute') is-invalid @enderror"
                                                            name="bajo[{{$x}}]" required autocomplete="bajo[{{$x}}]">
                                                        @error('attribute')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia #{{$attribute_number}}</th>
                                                    <td class="td-card"> <div class="form-group">
                                                            <textarea class="form-control" rows="5" id="comment" required name="bajo_sugerencia[{{$x}}]" style="background-color: #eff0ee"></textarea>
                                                        </div>
                                                        @error('attribute')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <input type="hidden" value="{{$attribute_number++}}">
                                            @endforeach
                                        @endif
                                        @if($maturity == 3)
                                            @foreach(range(0,2) as $x)
                                                <tr>
                                                    <th class="th-card"><i class="far fa-chart-bar"></i> Atributo #{{$attribute_number}}</th>
                                                    <td class="td-card"> <input type="text"
                                                            class="form-control @error('attribute') is-invalid @enderror"
                                                            name="intermedio[{{$x}}]" required autocomplete="intermedio[{{$x}}]">

                                                        @error('attribute')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia #{{$attribute_number}}</th>
                                                    <td class="td-card"> <div class="form-group">
                                                            <textarea class="form-control" rows="5" id="comment" required name="intermedio_sugerencia[{{$x}}]" style="background-color: #eff0ee"></textarea>
                                                        </div>
                                                        @error('attribute')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <input type="hidden" value="{{$attribute_number++}}">
                                            @endforeach
                                        @endif
                                        @if($maturity == 4)
                                            @foreach(range(0,2) as $x)
                                                <tr>
                                                    <th class="th-card"><i class="far fa-chart-bar"></i> Atributo #{{$attribute_number}}</th>
                                                    <td class="td-card"> <input type="text"
                                                            class="form-control @error('attribute') is-invalid @enderror"
                                                            name="alto[{{$x}}]" required autocomplete="alto[{{$x}}]">

                                                        @error('attribute')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia #{{$attribute_number}}</th>
                                                    <td class="td-card"> <div class="form-group">
                                                            <textarea class="form-control" rows="5" id="comment" required name="alto_sugerencia[{{$x}}]" style="background-color: #eff0ee"></textarea>
                                                        </div>
                                                        @error('attribute')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <input type="hidden" value="{{$attribute_number++}}">
                                            @endforeach
                                        @endif
                                        @if($maturity == 5)
                                            @foreach(range(0,2) as $x)
                                                <tr>
                                                    <th class="th-card"><i class="far fa-chart-bar"></i> Atributo #{{$attribute_number}}</th>
                                                    <td class="td-card"> <input type="text"
                                                            class="form-control @error('attribute') is-invalid @enderror"
                                                            name="muy_alto[{{$x}}]" required autocomplete="muy_alto[{{$x}}]">

                                                        @error('attribute')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia #{{$attribute_number}}</th>
                                                    <td class="td-card"> <div class="form-group">
                                                            <textarea class="form-control" rows="5" id="comment" required name="muy_alto_sugerencia[{{$x}}]" style="background-color: #eff0ee"></textarea>
                                                        </div>
                                                        @error('attribute')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <input type="hidden" value="{{$attribute_number++}}">
                                            @endforeach
                                        @endif
                                    @endforeach
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


