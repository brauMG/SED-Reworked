@extends('layouts.app', ['activePage' => 'AdminDupTests', 'titlePage' => __('Duplicar Prueba')])
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
            <form method="POST" action="/duplicateTest/admins">
                @csrf

                <div class="form-group">
                    <label for="name">Nombre de Prueba</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" placeholder="Nombre de la prueba">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">Duplicar Prueba</label>
                    <select data-old="{{ old('duplicateTest') }}"  type='text' required class="custom-select @error('duplicateTest') is-invalid @enderror" name="duplicateTest">
                        @foreach($pruebas as $prueba)
                            <option value="{{ $prueba->testId }}">
                                {{$prueba->user}} - {{ $prueba->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('duplicateTest')
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

                <button type="submit" class="btn btn-primary" id="submit_button">Guardar Cambios</button>
            </form>
        </div>
    </div>
@endsection


