@extends('layouts.app', ['activePage' => 'AdminAddTests', 'titlePage' => __('Añadir Prueba')])
<?php
use App\Models\User_Area;
?>
@section('content')
    @inject('areas', 'App\Services\Areas')
    <div class="content" id="app">
        <div class="container-fluid">
                <div class="col-md-12">
                    @if ( session('mensaje') )
                        <div class="container-edits" style="margin-top: 2%">
                            <div class="alert alert-success" class='message' id='message'>{{ session('mensaje') }}</div>
                        </div>
                    @endif
                </div>
            <form method="POST" action="/createTest/admins">
                @csrf

                <div class="form-group">
                    <label for="name">Prueba</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" placeholder="Nombre de la prueba">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="groupML">Grupo de Niveles de Madurez</label>
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
                </div>

                <div class="form-group">
                    <label for="area">Área</label>
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
                </div>

                <div class="form-group">
                    <label for="user">Usuario</label>
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
                </div>

                <div class="form-group">
                    <label for="concept">Concepto</label>
                    <input id="concept" type="text" class="form-control @error('concept') is-invalid @enderror" name="concept" required autocomplete="concept" placeholder="Nombre del concepto asignado">
                    @error('concept')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                @foreach($repeat as $maturity)
                    <h3 class="text-center title">Atributos del Nivel de Madurez #{{$ml_number}}</h3>
                    <input type="hidden" value="{{$ml_number++}}">
                    @if($maturity == 1)
                        @foreach(range(0,2) as $x)
                            <div class="form-group">
                                <label for="concept">Atributo #{{$attribute_number}}</label>
                                <input type="text" class="form-control @error('attribute') is-invalid @enderror" name="muy_bajo[{{$x}}]" required autocomplete="muy_bajo[{{$x}}]">
                                @error('attribute')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="concept">Sugerencia #{{$attribute_number}}</label>
                                <textarea class="form-control" rows="5" id="comment" required name="muy_bajo_sugerencia[{{$x}}]" style="background-color: #eff0ee"></textarea>
                                @error('attribute')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <input type="hidden" value="{{$attribute_number++}}">
                        @endforeach
                    @endif
                    @if($maturity == 2)
                        @foreach(range(0,2) as $x)
                            <div class="form-group">
                                <label for="concept">Atributo #{{$attribute_number}}</label>
                                <input type="text" class="form-control @error('attribute') is-invalid @enderror" name="bajo[{{$x}}]" required autocomplete="bajo[{{$x}}]">
                                @error('attribute')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="concept">Sugerencia #{{$attribute_number}}</label>
                                <textarea class="form-control" rows="5" id="comment" required name="bajo_sugerencia[{{$x}}]" style="background-color: #eff0ee"></textarea>
                                @error('attribute')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <input type="hidden" value="{{$attribute_number++}}">
                        @endforeach
                    @endif
                    @if($maturity == 3)
                        @foreach(range(0,2) as $x)
                            <div class="form-group">
                                <label for="concept">Atributo #{{$attribute_number}}</label>
                                <input type="text" class="form-control @error('attribute') is-invalid @enderror" name="intermedio[{{$x}}]" required autocomplete="intermedio[{{$x}}]">
                                @error('attribute')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="concept">Sugerencia #{{$attribute_number}}</label>
                                <textarea class="form-control" rows="5" id="comment" required name="intermedio_sugerencia[{{$x}}]" style="background-color: #eff0ee"></textarea>
                                @error('attribute')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <input type="hidden" value="{{$attribute_number++}}">
                        @endforeach
                    @endif
                    @if($maturity == 4)
                        @foreach(range(0,2) as $x)
                            <div class="form-group">
                                <label for="concept">Atributo #{{$attribute_number}}</label>
                                <input type="text" class="form-control @error('attribute') is-invalid @enderror" name="alto[{{$x}}]" required autocomplete="alto[{{$x}}]">
                                @error('attribute')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="concept">Sugerencia #{{$attribute_number}}</label>
                                <textarea class="form-control" rows="5" id="comment" required name="alto_sugerencia[{{$x}}]" style="background-color: #eff0ee"></textarea>
                                @error('attribute')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <input type="hidden" value="{{$attribute_number++}}">
                        @endforeach
                    @endif
                    @if($maturity == 5)
                        @foreach(range(0,2) as $x)
                            <div class="form-group">
                                <label for="concept">Atributo #{{$attribute_number}}</label>
                                <input type="text" class="form-control @error('attribute') is-invalid @enderror" name="muy_alto[{{$x}}]" required autocomplete="muy_alto[{{$x}}]">
                                @error('attribute')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="concept">Sugerencia #{{$attribute_number}}</label>
                                <textarea class="form-control" rows="5" id="comment" required name="muy_alto_sugerencia[{{$x}}]" style="background-color: #eff0ee"></textarea>
                                @error('attribute')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <input type="hidden" value="{{$attribute_number++}}">
                        @endforeach
                    @endif
                @endforeach
                <button type="submit" class="btn btn-primary" id="submit_button">Guardar Cambios</button>
            </form>
        </div>
    </div>
@endsection


