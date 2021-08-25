@extends('layouts.app', ['activePage' => 'AdminAddTests', 'titlePage' => __('Añadir Conceptos a Prueba')])

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
                            <h4 class="card-title text-white">Agregar Conceptos a Prueba</h4>
                            <p class="card-category">Ingresa los datos necesarios para añadir un nuevo concepto a una prueba.</p>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="/conceptTest/admins">
                                @csrf
                                <table class="table-responsive table-card-inline" style="width: fit-content !important;; margin: auto">
                                    <tr>
                                        <div class="input-group mb-3">
                                            <th class="th-card pr-1" id="area address"><span class="material-icons" style="vertical-align: sub">badge</span> Prueba</th>
                                            <td class="td-card pl-1">
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
                                        <th class="th-card pr-1" id="address"><span class="material-icons" style="vertical-align: sub">badge</span> Concepto</th>
                                        <td class="td-card pl-1"> <input id="concept" type="text"
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
                                            <th class="th-card pr-1" class='bold' id="address addy" colspan="2">Atributos del Nivel de Madurez #{{$ml_number}}</th>
                                        </tr>
                                        <input type="hidden" value="{{$ml_number++}}">
                                        @if($maturity == 1)
                                            @foreach(range(0,2) as $x)
                                                <tr>
                                                    <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">badge</span> Atributo #{{$attribute_number}}</th>
                                                    <td class="td-card pl-1"> <input type="text"
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
                                                    <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">badge</span> Sugerencia #{{$attribute_number}}</th>
                                                    <td class="td-card pl-1"> <div class="form-group">
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
                                                    <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">badge</span> Atributo #{{$attribute_number}}</th>
                                                    <td class="td-card pl-1"> <input type="text"
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
                                                    <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">badge</span> Sugerencia #{{$attribute_number}}</th>
                                                    <td class="td-card pl-1"> <div class="form-group">
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
                                                    <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">badge</span> Atributo #{{$attribute_number}}</th>
                                                    <td class="td-card pl-1"> <input type="text"
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
                                                    <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">badge</span> Sugerencia #{{$attribute_number}}</th>
                                                    <td class="td-card pl-1"> <div class="form-group">
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
                                                    <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">badge</span> Atributo #{{$attribute_number}}</th>
                                                    <td class="td-card pl-1"> <input type="text"
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
                                                    <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">badge</span> Sugerencia #{{$attribute_number}}</th>
                                                    <td class="td-card pl-1"> <div class="form-group">
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
                                                    <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">badge</span> Atributo #{{$attribute_number}}</th>
                                                    <td class="td-card pl-1"> <input type="text"
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
                                                    <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">badge</span> Sugerencia #{{$attribute_number}}</th>
                                                    <td class="td-card pl-1">
                                                        <div class="form-group">
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

                                <div class="container text-center mt-3">
                                    <button type="submit" class="btn btn-primary">Agregar Datos</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
