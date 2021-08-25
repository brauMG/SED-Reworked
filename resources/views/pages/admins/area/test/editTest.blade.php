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
                            <h4 class="card-title text-white" id="title_test">{{$company->name}}</h4>
                        </div>

                        <div class="card-body">

                            <form class="form" method="POST" action="{{ route('UpdateTest', $conceptId) }}" style="margin-bottom: 2% !important;" enctype="multipart/form-data">
                                @csrf
                                <div class='container text-center mb-3'>
                                    <input type="submit" class="btn btn-warning" value="Guardar Cambios">
                                    <a href="{{route('CancelTest')}}" class="btn btn-primary"> Cancelar</a>
                                </div>

                            <div class="form-edits" style="margin-bottom: 2% !important;">
                                @if ( session('mensaje') )
                                    <div class="container-edits" style="margin-top: 2%">
                                        <div class="alert alert-success" class='message' id='message'>{{ session('mensaje') }}</div>
                                    </div>
                                @endif
                                @if ( session('mensajeError') )
                                    <div class="container-edits" style="margin-top: 2%">
                                        <div class="alert alert-primary" class='message' id='message'>{{ session('mensajeError') }}</div>
                                    </div>
                                @endif
                                    <table class="table-responsive table-card-inline" style="width: fit-content !important;; margin: auto" id="tAdmin">

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: bottom">speaker_notes</span> Prueba</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="testName" class="form-control @error('testName') is-invalid @enderror" value="{{ $testData['name'] }}" required>
                                            @error('testName')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <div class="col-auto my-1">
                                            <th class="th-card pr-1"><span class="material-icons" style="vertical-align: bottom">contacts</span> Usuario</th>
                                            <td class="td-card pl-1">
                                            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="username">
                                                <option selected value="{{$test_user_data['id']}}">{{$test_user_data['username']}}</option>
                                                @foreach($users as $user)
                                                <option value="{{$user['id']}}" style="background-color: #81d4fa">{{$user['username']}}</option>
                                                @endforeach
                                            </select>
                                            </td>
                                        </div>
                                    </tr>

                                    <tr>
                                        <div class="input-group mb-3">
                                            <th class="th-card pr-1" id="groupML"><span class="material-icons" style="vertical-align: bottom">badge</span> Grupo de Niveles de Madurez</th>
                                            <td class="td-card pl-1">
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
                                            </td>
                                        </div>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: bottom">featured_play_list</span> Concepto</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="conceptName" class="form-control" value="{{ $test_concept_data['description'] }}" required>
                                        </td>
                                    </tr>

                                    <tr class='tr-card-complete'>
                                        <!--Atributo1-->
                                        <td  class='bold' id="address addy" colspan="2">Nivel de Madurez:
                                            <label style="font-weight: bold">1</label><br>
                                            <span class="material-icons" style="vertical-align: bottom">star_rate</span>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"> Atributo 1</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="attribute1" class="form-control" value="{{ $attribute[0]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card pr-1"> Sugerencia</th>
                                        <td class="td-card pl-1">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion1" required>{{ $attribute[0]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"> Atributo 2</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="attribute2" class="form-control" value="{{ $attribute[1]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card pr-1"> Sugerencia</th>
                                        <td class="td-card pl-1">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion2" required>{{ $attribute[1]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"> Atributo 3</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="attribute3" class="form-control" value="{{ $attribute[2]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card pr-1"> Sugerencia</th>
                                        <td class="td-card pl-1">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion3" required>{{ $attribute[2]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class='tr-card-complete'>
                                        <!--Atributo1-->
                                        <td  class='bold' id="address addy" colspan="2">Nivel de Madurez:
                                            <label style="font-weight: bold">2</label><br>
                                            <span class="material-icons" style="vertical-align: bottom">star_rate</span><span class="material-icons" style="vertical-align: bottom">star_rate</span>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"> Atributo 4</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="attribute4" class="form-control" value="{{ $attribute[3]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card pr-1"> Sugerencia</th>
                                        <td class="td-card pl-1">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion4" required>{{ $attribute[3]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"> Atributo 5</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="attribute5" class="form-control" value="{{ $attribute[4]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card pr-1"> Sugerencia</th>
                                        <td class="td-card pl-1">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion5" required>{{ $attribute[4]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"> Atributo 6</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="attribute6" class="form-control" value="{{ $attribute[5]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card pr-1"> Sugerencia</th>
                                        <td class="td-card pl-1">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion6" required>{{ $attribute[5]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class='tr-card-complete'>
                                        <!--Atributo1-->
                                        <td  class='bold' id="address addy" colspan="2">Nivel de Madurez:
                                            <label style="font-weight: bold">3</label><br>
                                            <span class="material-icons" style="vertical-align: bottom">star_rate</span><span class="material-icons" style="vertical-align: bottom">star_rate</span><span class="material-icons" style="vertical-align: bottom">star_rate</span>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"> Atributo 7</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="attribute7" class="form-control" value="{{ $attribute[6]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card pr-1"> Sugerencia</th>
                                        <td class="td-card pl-1">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion7" required>{{ $attribute[6]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"> Atributo 8</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="attribute8" class="form-control" value="{{ $attribute[7]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card pr-1"> Sugerencia</th>
                                        <td class="td-card pl-1">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion8" required>{{ $attribute[7]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"> Atributo 9</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="attribute9" class="form-control" value="{{ $attribute[8]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card pr-1"> Sugerencia</th>
                                        <td class="td-card pl-1">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion9" required>{{ $attribute[8]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class='tr-card-complete'>
                                        <!--Atributo1-->
                                        <td  class='bold' id="address addy" colspan="2">Nivel de Madurez:
                                            <label style="font-weight: bold">4</label><br>
                                            <span class="material-icons" style="vertical-align: bottom">star_rate</span><span class="material-icons" style="vertical-align: bottom">star_rate</span><span class="material-icons" style="vertical-align: bottom">star_rate</span><span class="material-icons" style="vertical-align: bottom">star_rate</span>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"> Atributo 10</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="attribute10" class="form-control" value="{{ $attribute[9]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card pr-1"> Sugerencia</th>
                                        <td class="td-card pl-1">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion10" required>{{ $attribute[9]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"> Atributo 11</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="attribute11" class="form-control" value="{{ $attribute[10]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card pr-1"> Sugerencia</th>
                                        <td class="td-card pl-1">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion11" required>{{ $attribute[10]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"> Atributo 12</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="attribute12" class="form-control" value="{{ $attribute[11]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card pr-1"> Sugerencia</th>
                                        <td class="td-card pl-1">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion12" required>{{ $attribute[11]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class='tr-card-complete'>
                                        <!--Atributo1-->
                                        <td  class='bold' id="address addy" colspan="2">Nivel de Madurez:
                                            <label style="font-weight: bold">5</label><br>
                                            <span class="material-icons" style="vertical-align: bottom">star_rate</span><span class="material-icons" style="vertical-align: bottom">star_rate</span><span class="material-icons" style="vertical-align: bottom">star_rate</span><span class="material-icons" style="vertical-align: bottom">star_rate</span><span class="material-icons" style="vertical-align: bottom">star_rate</span>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"> Atributo 13</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="attribute13" class="form-control" value="{{ $attribute[12]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card pr-1"> Sugerencia</th>
                                        <td class="td-card pl-1">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion13" required>{{ $attribute[12]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"> Atributo 14</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="attribute14" class="form-control" value="{{ $attribute[13]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card pr-1"> Sugerencia</th>
                                        <td class="td-card pl-1">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion14" required>{{ $attribute[13]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"> Atributo 15</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="attribute15" class="form-control" value="{{ $attribute[14]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card pr-1"> Sugerencia</th>
                                        <td class="td-card pl-1">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion15" required>{{ $attribute[14]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                                <div class='container text-center mt-3'>
                                    <input type="submit" class="ntm btn-warning" value="Guardar Cambios">
                                    <a href="{{route('CancelTest')}}" class="btn btn-primary"> Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
