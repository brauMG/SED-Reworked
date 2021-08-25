@extends('layouts.app', ['activePage' => 'AdminAddTests', 'titlePage' => __('Añadir Prueba')])
<?php
use App\Models\User_Area;
?>
@section('content')
    @inject('areas', 'App\Services\Areas')
    <div class="content" id="app">
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
                            <h4 class="card-title text-white">Crear nueva prueba</h4>
                            <p class="card-category">Ingresa los datos necesarios para añadir una nueva prueba.</p>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="/createTest/admins">
                                @csrf
                                <table class="table-responsive table-card-inline" style="width: fit-content !important;; margin: auto">
                                    <tr>
                                        <th class="th-card pr-1" id="address"> Prueba</th>
                                        <td class="td-card pl-1"> <input id="name" type="text"
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
                                            <th class="th-card pr-1" id="groupML"> Grupo de Niveles de Madurez</th>
                                            <td class="td-card pl-1">
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
                                            <th class="th-card pr-1" id="area"> Área</th>
                                            <td class="td-card pl-1">
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
                                        <th class="th-card pr-1" id="name"> Usuario</th>
                                        <td class="td-card pl-1">
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
                                        <th  class="th-card pr-1" id="address"> Concepto</th>
                                        <td class="td-card pl-1"> <input id="concept" type="text"
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
                                        <th class="th-card pr-1" class='bold' id="address addy" colspan="2">Atributos del Nivel de Madurez #{{$ml_number}}</th>
                                    </tr>
                                    <input type="hidden" value="{{$ml_number++}}">
                                    @if($maturity == 1)
                                            @foreach(range(0,2) as $x)
                                                <tr>
                                                    <th class="th-card pr-1"> Atributo #{{$attribute_number}}</th>
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
                                                    <th class="th-card pr-1"> Sugerencia #{{$attribute_number}}</th>
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
                                                    <th class="th-card pr-1"> Atributo #{{$attribute_number}}</th>
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
                                                    <th class="th-card pr-1"> Sugerencia #{{$attribute_number}}</th>
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
                                                    <th class="th-card pr-1"> Atributo #{{$attribute_number}}</th>
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
                                                    <th class="th-card pr-1"> Sugerencia #{{$attribute_number}}</th>
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
                                                    <th class="th-card pr-1"> Atributo #{{$attribute_number}}</th>
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
                                                    <th class="th-card pr-1"> Sugerencia #{{$attribute_number}}</th>
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
                                                    <th class="th-card pr-1"> Atributo #{{$attribute_number}}</th>
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
                                                    <th class="th-card pr-1"> Sugerencia #{{$attribute_number}}</th>
                                                    <td class="td-card pl-1"> <div class="form-group">
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


