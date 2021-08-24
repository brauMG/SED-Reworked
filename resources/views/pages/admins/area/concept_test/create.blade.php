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
        <div data-simplebar class="card-height-add-test"  style="height: 800px !important;; padding-top: 0% !important;">
            <div class="col text-center">
                <div class="justify-content-center">
                    <div class="card card-add-company">

                        <div class="card-header card-header-cute">
                            <h4 class="no-bottom" style="text-transform: uppercase">Agregar Concepto a prueba</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="/conceptTest/admins">
                                @csrf
                                <table class='table-responsive table-card-inline'>
                                    <tr class="tr-card-complete">
                                        <div class="input-group mb-3">
                                            <th class="th-card" id="area address"><i class="fas fa-envelope-open-text"></i> Prueba</th>
                                            <td class="td-card">
                                                <select required id="name" type='text' class="custom-select @error('name') is-invalid @enderror"  name="test" >
                                                    <option class='min' disabled selected>Selecciona la prueba</option>
                                                    @if(count($tests) == 0)
                                                        <option class='min' value="" disabled>No hay pruebas creadas.</option>
                                                    @else
                                                        @foreach($tests as $test)
                                                            <option class='min' value="{{ $test->testId }}">{{ $test->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </td>
                                        </div>
                                    </tr>

                                    <tr>
                                        <th class="th-card" id="address"><i class="fas fa-file-word"></i> Concepto</th>
                                        <td class="td-card"> <input id="concept" type="text"
                                                    class="form-control @error('concept') is-invalid @enderror" name="concept"
                                                    required autocomplete="concept">

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
