@extends('layouts.app', ['activePage' => 'AdminAddTests', 'titlePage' => __('Mostrar Prueba')])

@section('content')
    <div class="container text-center mb-3">

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

                            <div class='container text-center mb-3'>
                                <a href="{{ route('EditTest', $conceptId) }}" class="btn btn-warning"> Editar</a>
                                <button class="btn btn-danger" id="eliminar" data-toggle="modal" data-target="#DeleteTest"> Eliminar Prueba</button>
                                <button class="btn btn-danger" id="eliminar" data-toggle="modal" data-target="#DeleteConcept"> Eliminar Concepto</button>
                            </div>

                                <div class="form-edits" style="margin-bottom: 2% !important;">
                                    <table class="table-responsive table-card-inline" style="width: fit-content !important;; margin: auto" id="tAdmin">

                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"><span class="material-icons" style="vertical-align: bottom">speaker_notes</span> Prueba</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="testName" class="form-control" disabled value="{{ $testData['name'] }}">
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"><span class="material-icons" style="vertical-align: bottom">contacts</span> Usuario</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="username" class="form-control" disabled value="{{ $test_user_data['username'] }}">
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"><span class="material-icons" style="vertical-align: bottom">featured_play_list</span> Concepto</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="conceptName" class="form-control" disabled value="{{ $test_concept_data['description'] }}">
                                            </td>
                                        </tr>

                                        <tr class='tr-card-complete'>
                                            <!--Atributo1-->
                                            <td  class='bold' id="address addy" colspan="2">Nivel de Madurez:
                                                <label style="font-weight: bold">{{ $attribute[0]['ML'] }}</label><br>
                                                <span class="material-icons" style="vertical-align: bottom">star_rate</span>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"> Atributo 1</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="attribute1" class="form-control" disabled value="{{ $attribute[0]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card pr-1"> Sugerencia</th>
                                            <td class="td-card pl-1">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion1" disabled>{{ $attribute[0]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"> Atributo 2</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="attribute2" class="form-control" disabled value="{{ $attribute[1]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card pr-1"> Sugerencia</th>
                                            <td class="td-card pl-1">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion2" disabled>{{ $attribute[1]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"> Atributo 3</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="attribute3" class="form-control" disabled value="{{ $attribute[2]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card pr-1"> Sugerencia</th>
                                            <td class="td-card pl-1">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion3" disabled>{{ $attribute[2]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class='tr-card-complete'>
                                            <!--Atributo1-->
                                            <td  class='bold' id="address addy" colspan="2">Nivel de Madurez:
                                                <label style="font-weight: bold">{{ $attribute[3]['ML'] }}</label><br>
                                                <span class="material-icons" style="vertical-align: bottom">star_rate</span><span class="material-icons" style="vertical-align: bottom">star_rate</span>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"> Atributo 4</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="attribute4" class="form-control" disabled value="{{ $attribute[3]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card pr-1"> Sugerencia</th>
                                            <td class="td-card pl-1">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion4" disabled>{{ $attribute[3]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"> Atributo 5</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="attribute5" class="form-control" disabled value="{{ $attribute[4]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card pr-1"> Sugerencia</th>
                                            <td class="td-card pl-1">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion5" disabled>{{ $attribute[4]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"> Atributo 6</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="attribute6" class="form-control" disabled value="{{ $attribute[5]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card pr-1"> Sugerencia</th>
                                            <td class="td-card pl-1">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion6" disabled>{{ $attribute[5]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class='tr-card-complete'>
                                            <!--Atributo1-->
                                            <td  class='bold' id="address addy" colspan="2">Nivel de Madurez:
                                                <label style="font-weight: bold">{{ $attribute[6]['ML'] }}</label><br>
                                                <span class="material-icons" style="vertical-align: bottom">star_rate</span><span class="material-icons" style="vertical-align: bottom">star_rate</span><span class="material-icons" style="vertical-align: bottom">star_rate</span>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"> Atributo 7</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="attribute7" class="form-control" disabled value="{{ $attribute[6]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card pr-1"> Sugerencia</th>
                                            <td class="td-card pl-1">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion7" disabled>{{ $attribute[6]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"> Atributo 8</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="attribute8" class="form-control" disabled value="{{ $attribute[7]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card pr-1"> Sugerencia</th>
                                            <td class="td-card pl-1">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion8" disabled>{{ $attribute[7]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"> Atributo 9</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="attribute9" class="form-control" disabled value="{{ $attribute[8]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card pr-1"> Sugerencia</th>
                                            <td class="td-card pl-1">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion9" disabled>{{ $attribute[8]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class='tr-card-complete'>
                                            <!--Atributo1-->
                                            <td  class='bold' id="address addy" colspan="2">Nivel de Madurez:
                                                <label style="font-weight: bold">{{ $attribute[9]['ML'] }}</label><br>
                                                <span class="material-icons" style="vertical-align: bottom">star_rate</span><span class="material-icons" style="vertical-align: bottom">star_rate</span><span class="material-icons" style="vertical-align: bottom">star_rate</span><span class="material-icons" style="vertical-align: bottom">star_rate</span>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"> Atributo 10</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="attribute10" class="form-control" disabled value="{{ $attribute[9]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card pr-1"> Sugerencia</th>
                                            <td class="td-card pl-1">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion10" disabled>{{ $attribute[9]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"> Atributo 11</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="attribute11" class="form-control" disabled value="{{ $attribute[10]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card pr-1"> Sugerencia</th>
                                            <td class="td-card pl-1">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion11" disabled>{{ $attribute[10]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"> Atributo 12</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="attribute12" class="form-control" disabled value="{{ $attribute[11]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card pr-1"> Sugerencia</th>
                                            <td class="td-card pl-1">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion12" disabled>{{ $attribute[11]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class='tr-card-complete'>
                                            <!--Atributo1-->
                                            <td  class='bold' id="address addy" colspan="2">Nivel de Madurez:
                                                <label style="font-weight: bold">{{ $attribute[12]['ML'] }}</label><br>
                                                <span class="material-icons" style="vertical-align: bottom">star_rate</span><span class="material-icons" style="vertical-align: bottom">star_rate</span><span class="material-icons" style="vertical-align: bottom">star_rate</span><span class="material-icons" style="vertical-align: bottom">star_rate</span><span class="material-icons" style="vertical-align: bottom">star_rate</span>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"> Atributo 13</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="attribute13" class="form-control" disabled value="{{ $attribute[12]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card pr-1"> Sugerencia</th>
                                            <td class="td-card pl-1">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion13" disabled>{{ $attribute[12]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"> Atributo 14</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="attribute14" class="form-control" disabled value="{{ $attribute[13]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card pr-1"> Sugerencia</th>
                                            <td class="td-card pl-1">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion14" disabled>{{ $attribute[13]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"> Atributo 15</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="attribute15" class="form-control" disabled value="{{ $attribute[14]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card pr-1"> Sugerencia</th>
                                            <td class="td-card pl-1">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion15" disabled>{{ $attribute[14]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class='container text-center mt-3'>
                                    <a href="{{ route('EditTest', $conceptId) }}" class="btn btn-warning"> Editar</a>
                                    <button class="btn btn-danger" id="eliminar" data-toggle="modal" data-target="#DeleteTest"> Eliminar Prueba</button>
                                    <button class="btn btn-danger" id="eliminar" data-toggle="modal" data-target="#DeleteConcept"> Eliminar Concepto</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal show" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="DeleteTest">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content"style="background-color: #D9534F;color: white;">
                <div class="modal-header ">
                    <h5 class="modal-title"  id="exampleModalLongTitle">Eliminacion de Prueba</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="background-color: white;color: black;">
                    <div class="modal-body">
                        ¿Desea eliminar por completo esta prueba? Al presionar aceptar se eliminaran todos los datos y conceptos relacionados con esta prueba.
                    </div>
                    <div class="spinner-border m-5" role="status" style="display: none;">
                        <span class="sr-only">Cargando...</span>
                    </div>
                </div>
                <div class="modal-footer" style="background-color: white;color: black;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="window.location='{{ route('DeleteTest', $testId) }}'">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal show" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="DeleteConcept">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content"style="background-color: #D9534F;color: white;">
                <div class="modal-header ">
                    <h5 class="modal-title"  id="exampleModalLongTitle">Eliminacion de Concepto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="background-color: white;color: black;">
                    <div class="modal-body">
                        ¿Desea eliminar este concepto? Al presionar aceptar se eliminaran los datos relacionados con la prueba del concepto actual.
                    </div>
                    <div class="spinner-border m-5" role="status" style="display: none;">
                        <span class="sr-only">Cargando...</span>
                    </div>
                </div>
                <div class="modal-footer" style="background-color: white;color: black;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="window.location='{{ route('DeleteConcept',$conceptId) }}'">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
