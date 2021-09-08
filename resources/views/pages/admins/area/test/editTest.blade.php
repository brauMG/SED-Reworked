@extends('layouts.app', ['activePage' => 'AdminAddTests', 'titlePage' => __('Editar Prueba')])

@section('content')
    <div class="container btn-container">

        <input type="button" id="back_area" class="btn btn-primary" value="Regresar" style="display:none;" onclick="BackAreaTest()">

        <input type="button" id="editTest" class="btn btn-warning" value="Editar" style="display:none;" onclick="ShowEditar()">

        <input type="button" id="deleteTest" class="btn btn-danger" value="Eliminar Prueba" style="display:none;" onclick="$('#NoteDeleteTest').modal();">

        <input type="button" id="deleteConcept" class="btn btn-danger" value="Eliminar Concepto" style="display:none;" onclick="$('#NoteDeleteConcept').modal();">

        <input type="button" id="SaveTest" class="btn btn-success" value="Guardar Cambios" style="display:none;" onclick="$('#NoteUpdate').modal();">

        <input type="button" id="CancelTest" class="btn btn-danger" value="Cancelar y Salir" style="display:none;" onclick="EditarTest(false)">

    </div>

    <div class="content">
        <div class="container-fluid">
                <form method="POST" action="{{ route('UpdateTest', $conceptId) }}" style="margin-bottom: 2% !important;" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Usuario</label>
                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="username">
                            <option selected value="{{$test_user_data['id']}}">{{$test_user_data['username']}}</option>
                            @foreach($users as $user)
                                <option value="{{$user['id']}}" style="background-color: #81d4fa">{{$user['username']}}</option>
                            @endforeach
                        </select>
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Grupo de Niveles de Madurez</label>
                        <select data-old="{{ old('groupML') }}"  type='text' required class="custom-select @error('groupML') is-invalid @enderror" name="groupML">
                            <option value="{{$actualGroupML[0]['MLGroupId']}}"> {{$actualGroupML[0]['name']}} </option>
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
                        <label for="">Concepto</label>
                        <input type="text" name="conceptName" class="form-control" value="{{ $test_concept_data['description'] }}" required>
                    </div>

                    <h3 class="text-center title">Nivel de Madurez: <strong>1</strong></h3>

                    <div class="form-group">
                        <label for="">Atributo 1</label>
                        <input type="text" name="attribute1" class="form-control" value="{{ $attribute[0]['AD'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="">Sugerencia</label>
                        <textarea class="form-control" rows="5" name="suggestion1" required>{{ $attribute[0]['AS'] }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Atributo 2</label>
                        <input type="text" name="attribute2" class="form-control" value="{{ $attribute[1]['AD'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="">Sugerencia</label>
                        <textarea class="form-control" rows="5" name="suggestion2" required>{{ $attribute[1]['AS'] }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Atributo 3</label>
                        <input type="text" name="attribute3" class="form-control" value="{{ $attribute[2]['AD'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="">Sugerencia</label>
                        <textarea class="form-control" rows="5" name="suggestion3" required>{{ $attribute[2]['AS'] }}</textarea>
                    </div>

                    <h3 class="text-center title">Nivel de Madurez: <strong>2</strong></h3>

                    <div class="form-group">
                        <label for="">Atributo 1</label>
                        <input type="text" name="attribute4" class="form-control" value="{{ $attribute[3]['AD'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="">Sugerencia</label>
                        <textarea class="form-control" rows="5" name="suggestion4" required>{{ $attribute[3]['AS'] }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Atributo 5</label>
                        <input type="text" name="attribute5" class="form-control" value="{{ $attribute[4]['AD'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="">Sugerencia</label>
                        <textarea class="form-control" rows="5" name="suggestion5" required>{{ $attribute[4]['AS'] }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Atributo 6</label>
                        <input type="text" name="attribute6" class="form-control" value="{{ $attribute[5]['AD'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="">Sugerencia</label>
                        <textarea class="form-control" rows="5" name="suggestion6" required>{{ $attribute[5]['AS'] }}</textarea>
                    </div>

                    <h3 class="text-center title">Nivel de Madurez: <strong>3</strong></h3>

                    <div class="form-group">
                        <label for="">Atributo 7</label>
                        <input type="text" name="attribute7" class="form-control" value="{{ $attribute[6]['AD'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="">Sugerencia</label>
                        <textarea class="form-control" rows="5" name="suggestion7" required>{{ $attribute[6]['AS'] }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Atributo 8</label>
                        <input type="text" name="attribute8" class="form-control" value="{{ $attribute[7]['AD'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="">Sugerencia</label>
                        <textarea class="form-control" rows="5" name="suggestion8" required>{{ $attribute[7]['AS'] }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Atributo 9</label>
                        <input type="text" name="attribute9" class="form-control" value="{{ $attribute[8]['AD'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="">Sugerencia</label>
                        <textarea class="form-control" rows="5" name="suggestion9" required>{{ $attribute[8]['AS'] }}</textarea>
                    </div>

                    <h3 class="text-center title">Nivel de Madurez: <strong>4</strong></h3>

                    <div class="form-group">
                        <label for="">Atributo 10</label>
                        <input type="text" name="attribute10" class="form-control" value="{{ $attribute[9]['AD'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="">Sugerencia</label>
                        <textarea class="form-control" rows="5" name="suggestion10" required>{{ $attribute[9]['AS'] }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Atributo 11</label>
                        <input type="text" name="attribute11" class="form-control" value="{{ $attribute[10]['AD'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="">Sugerencia</label>
                        <textarea class="form-control" rows="5" name="suggestion11" required>{{ $attribute[10]['AS'] }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Atributo 12</label>
                        <input type="text" name="attribute12" class="form-control" value="{{ $attribute[11]['AD'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="">Sugerencia</label>
                        <textarea class="form-control" rows="5" name="suggestion12" required>{{ $attribute[11]['AS'] }}</textarea>
                    </div>

                    <h3 class="text-center title">Nivel de Madurez: <strong>5</strong></h3>

                    <div class="form-group">
                        <label for="">Atributo 13</label>
                        <input type="text" name="attribute13" class="form-control" value="{{ $attribute[12]['AD'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="">Sugerencia</label>
                        <textarea class="form-control" rows="5" name="suggestion13" required>{{ $attribute[12]['AS'] }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Atributo 14</label>
                        <input type="text" name="attribute14" class="form-control" value="{{ $attribute[13]['AD'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="">Sugerencia</label>
                        <textarea class="form-control" rows="5" name="suggestion14" required>{{ $attribute[13]['AS'] }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Atributo 15</label>
                        <input type="text" name="attribute15" class="form-control" value="{{ $attribute[14]['AD'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="">Sugerencia</label>
                        <textarea class="form-control" rows="5" name="suggestion14" required>{{ $attribute[14]['AS'] }}</textarea>
                    </div>


                    <div class='container text-center mt-3'>
                        <input type="submit" class="ntm btn-warning" value="Guardar Cambios">
                        <a href="{{route('CancelTest')}}" class="btn btn-primary"> Cancelar</a>
                    </div>
                </form>
        </div>
    </div>
@endsection
