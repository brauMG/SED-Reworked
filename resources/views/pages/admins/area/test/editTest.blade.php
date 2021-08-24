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

    <div class="container btn-container">

        <input type="button" id="back_area" class="btn btn-primary" value="Regresar" style="display:none;" onclick="BackAreaTest()">

        <input type="button" id="editTest" class="btn btn-warning" value="Editar" style="display:none;" onclick="ShowEditar()">

        <input type="button" id="deleteTest" class="btn btn-danger" value="Eliminar Prueba" style="display:none;" onclick="$('#NoteDeleteTest').modal();">

        <input type="button" id="deleteConcept" class="btn btn-danger" value="Eliminar Concepto" style="display:none;" onclick="$('#NoteDeleteConcept').modal();">

        <input type="button" id="SaveTest" class="btn btn-success" value="Guardar Cambios" style="display:none;" onclick="$('#NoteUpdate').modal();">

        <input type="button" id="CancelTest" class="btn btn-danger" value="Cancelar y Salir" style="display:none;" onclick="EditarTest(false)">

    </div>

    <div class="container">
        <div data-simplebar class="card-height-add-test" style="height: 800px !important;">
            <div class="col text-center">
                <div class="justify-content-center">
                    <div class="card card-add-company">
                        <div class="card-header card-header-cute">
                            <h4 class="no-bottom" style="text-transform: uppercase" id="title_test">{{$company -> name}}</h4>
                        </div>
                        <div class="card-body">

                            <form class="form" method="POST" action="{{ route('UpdateTest', $conceptId) }}" style="margin-bottom: 2% !important;" enctype="multipart/form-data">
                                @csrf
                                <div class='container'>
                                    <input type="submit" class="button-size-08 btn btn-add btn-warning" value="Guardar Cambios">
                                    <a href="{{route('CancelTest')}}" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Cancelar</a>
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
                                <table class='table-responsive table-card-inline'>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><span class="material-icons" style="vertical-align: bottom">speaker_notes</span> Prueba</th>
                                        <td class="td-card">
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
                                            <th class="th-card"><span class="material-icons" style="vertical-align: bottom">contacts</span> Usuario</th>
                                            <td class="td-card">
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
                                            <th class="th-card" id="groupML"><i class="fas fa-layer-group"></i> Grupo de Niveles de Madurez</th>
                                            <td class="td-card">
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
                                        <th class="th-card"><span class="material-icons" style="vertical-align: bottom">featured_play_list</span> Concepto</th>
                                        <td class="td-card">
                                            <input type="text" name="conceptName" class="form-control" value="{{ $test_concept_data['description'] }}" required>
                                        </td>
                                    </tr>

                                    <tr class='tr-card-complete'>
                                        <!--Atributo1-->
                                        <td  class='bold' id="address addy" colspan="2">Nivel de Madurez:
                                            <label style="font-weight: bold">1</label><br>
                                            <i class="fas fa-star"></i>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 1</th>
                                        <td class="td-card">
                                            <input type="text" name="attribute1" class="form-control" value="{{ $attribute[0]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                        <td class="td-card">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion1" required>{{ $attribute[0]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 2</th>
                                        <td class="td-card">
                                            <input type="text" name="attribute2" class="form-control" value="{{ $attribute[1]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                        <td class="td-card">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion2" required>{{ $attribute[1]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 3</th>
                                        <td class="td-card">
                                            <input type="text" name="attribute3" class="form-control" value="{{ $attribute[2]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                        <td class="td-card">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion3" required>{{ $attribute[2]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class='tr-card-complete'>
                                        <!--Atributo1-->
                                        <td  class='bold' id="address addy" colspan="2">Nivel de Madurez:
                                            <label style="font-weight: bold">2</label><br>
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 4</th>
                                        <td class="td-card">
                                            <input type="text" name="attribute4" class="form-control" value="{{ $attribute[3]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                        <td class="td-card">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion4" required>{{ $attribute[3]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 5</th>
                                        <td class="td-card">
                                            <input type="text" name="attribute5" class="form-control" value="{{ $attribute[4]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                        <td class="td-card">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion5" required>{{ $attribute[4]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 6</th>
                                        <td class="td-card">
                                            <input type="text" name="attribute6" class="form-control" value="{{ $attribute[5]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                        <td class="td-card">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion6" required>{{ $attribute[5]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class='tr-card-complete'>
                                        <!--Atributo1-->
                                        <td  class='bold' id="address addy" colspan="2">Nivel de Madurez:
                                            <label style="font-weight: bold">3</label><br>
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 7</th>
                                        <td class="td-card">
                                            <input type="text" name="attribute7" class="form-control" value="{{ $attribute[6]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                        <td class="td-card">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion7" required>{{ $attribute[6]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 8</th>
                                        <td class="td-card">
                                            <input type="text" name="attribute8" class="form-control" value="{{ $attribute[7]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                        <td class="td-card">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion8" required>{{ $attribute[7]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 9</th>
                                        <td class="td-card">
                                            <input type="text" name="attribute9" class="form-control" value="{{ $attribute[8]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                        <td class="td-card">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion9" required>{{ $attribute[8]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class='tr-card-complete'>
                                        <!--Atributo1-->
                                        <td  class='bold' id="address addy" colspan="2">Nivel de Madurez:
                                            <label style="font-weight: bold">4</label><br>
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 10</th>
                                        <td class="td-card">
                                            <input type="text" name="attribute10" class="form-control" value="{{ $attribute[9]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                        <td class="td-card">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion10" required>{{ $attribute[9]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 11</th>
                                        <td class="td-card">
                                            <input type="text" name="attribute11" class="form-control" value="{{ $attribute[10]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                        <td class="td-card">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion11" required>{{ $attribute[10]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 12</th>
                                        <td class="td-card">
                                            <input type="text" name="attribute12" class="form-control" value="{{ $attribute[11]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                        <td class="td-card">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion12" required>{{ $attribute[11]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class='tr-card-complete'>
                                        <!--Atributo1-->
                                        <td  class='bold' id="address addy" colspan="2">Nivel de Madurez:
                                            <label style="font-weight: bold">5</label><br>
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 13</th>
                                        <td class="td-card">
                                            <input type="text" name="attribute13" class="form-control" value="{{ $attribute[12]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                        <td class="td-card">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion13" required>{{ $attribute[12]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 14</th>
                                        <td class="td-card">
                                            <input type="text" name="attribute14" class="form-control" value="{{ $attribute[13]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                        <td class="td-card">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion14" required>{{ $attribute[13]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 15</th>
                                        <td class="td-card">
                                            <input type="text" name="attribute15" class="form-control" value="{{ $attribute[14]['AD'] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                        <td class="td-card">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="suggestion15" required>{{ $attribute[14]['AS'] }}</textarea>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                                <div class='container'>
                                    <input type="submit" class="button-size-08 btn btn-add btn-warning" value="Guardar Cambios">
                                    <a href="{{route('CancelTest')}}" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
