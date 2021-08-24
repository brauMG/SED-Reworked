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
        @if ( session('mensaje') )
            <div class="container-edits" style="margin-top: 2%">
                <div class="alert alert-success" class='message' id='message'>{{ session('mensaje') }}</div>
            </div>
        @endif
        <div data-simplebar class="card-height-add-test" style="height: 800px !important;">
            <div class="col text-center">
                <div class="justify-content-center">
                    <div class="card card-add-company">
                        <div class="card-header card-header-cute">
                            <h4 class="no-bottom" style="text-transform: uppercase" id="title_test">{{$company -> name}}</h4>
                        </div>
                        <div class="card-body">

                            <div class='container'>
                                <a href="{{ route('EditTest', $conceptId) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar</a>
                                <button class="btn btn-danger" id="eliminar" data-toggle="modal" data-target="#DeleteTest"><i class="fas fa-trash"></i> Eliminar Prueba</button>
                                <button class="btn btn-danger" id="eliminar" data-toggle="modal" data-target="#DeleteConcept"><i class="fas fa-trash"></i> Eliminar Concepto</button>
                            </div>

                                <div class="form-edits" style="margin-bottom: 2% !important;">
                                    <table class='table-responsive table-card-inline'>

                                        <tr class="tr-card-complete">
                                            <th class="th-card"><span class="material-icons" style="vertical-align: bottom">speaker_notes</span> Prueba</th>
                                            <td class="td-card">
                                                <input type="text" name="testName" class="form-control" readonly value="{{ $testData['name'] }}">
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card"><span class="material-icons" style="vertical-align: bottom">contacts</span> Usuario</th>
                                            <td class="td-card">
                                                <input type="text" name="username" class="form-control" readonly value="{{ $test_user_data['username'] }}">
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card"><span class="material-icons" style="vertical-align: bottom">featured_play_list</span> Concepto</th>
                                            <td class="td-card">
                                                <input type="text" name="conceptName" class="form-control" readonly value="{{ $test_concept_data['description'] }}">
                                            </td>
                                        </tr>

                                        <tr class='tr-card-complete'>
                                            <!--Atributo1-->
                                            <td  class='bold' id="address addy" colspan="2">Nivel de Madurez:
                                                <label style="font-weight: bold">{{ $attribute[0]['ML'] }}</label><br>
                                                <i class="fas fa-star"></i>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 1</th>
                                            <td class="td-card">
                                                <input type="text" name="attribute1" class="form-control" readonly value="{{ $attribute[0]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                            <td class="td-card">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion1" readonly>{{ $attribute[0]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 2</th>
                                            <td class="td-card">
                                                <input type="text" name="attribute2" class="form-control" readonly value="{{ $attribute[1]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                            <td class="td-card">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion2" readonly>{{ $attribute[1]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 3</th>
                                            <td class="td-card">
                                                <input type="text" name="attribute3" class="form-control" readonly value="{{ $attribute[2]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                            <td class="td-card">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion3" readonly>{{ $attribute[2]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class='tr-card-complete'>
                                            <!--Atributo1-->
                                            <td  class='bold' id="address addy" colspan="2">Nivel de Madurez:
                                                <label style="font-weight: bold">{{ $attribute[3]['ML'] }}</label><br>
                                                <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 4</th>
                                            <td class="td-card">
                                                <input type="text" name="attribute4" class="form-control" readonly value="{{ $attribute[3]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                            <td class="td-card">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion4" readonly>{{ $attribute[3]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 5</th>
                                            <td class="td-card">
                                                <input type="text" name="attribute5" class="form-control" readonly value="{{ $attribute[4]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                            <td class="td-card">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion5" readonly>{{ $attribute[4]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 6</th>
                                            <td class="td-card">
                                                <input type="text" name="attribute6" class="form-control" readonly value="{{ $attribute[5]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                            <td class="td-card">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion6" readonly>{{ $attribute[5]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class='tr-card-complete'>
                                            <!--Atributo1-->
                                            <td  class='bold' id="address addy" colspan="2">Nivel de Madurez:
                                                <label style="font-weight: bold">{{ $attribute[6]['ML'] }}</label><br>
                                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 7</th>
                                            <td class="td-card">
                                                <input type="text" name="attribute7" class="form-control" readonly value="{{ $attribute[6]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                            <td class="td-card">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion7" readonly>{{ $attribute[6]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 8</th>
                                            <td class="td-card">
                                                <input type="text" name="attribute8" class="form-control" readonly value="{{ $attribute[7]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                            <td class="td-card">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion8" readonly>{{ $attribute[7]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 9</th>
                                            <td class="td-card">
                                                <input type="text" name="attribute9" class="form-control" readonly value="{{ $attribute[8]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                            <td class="td-card">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion9" readonly>{{ $attribute[8]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class='tr-card-complete'>
                                            <!--Atributo1-->
                                            <td  class='bold' id="address addy" colspan="2">Nivel de Madurez:
                                                <label style="font-weight: bold">{{ $attribute[9]['ML'] }}</label><br>
                                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 10</th>
                                            <td class="td-card">
                                                <input type="text" name="attribute10" class="form-control" readonly value="{{ $attribute[9]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                            <td class="td-card">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion10" readonly>{{ $attribute[9]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 11</th>
                                            <td class="td-card">
                                                <input type="text" name="attribute11" class="form-control" readonly value="{{ $attribute[10]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                            <td class="td-card">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion11" readonly>{{ $attribute[10]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 12</th>
                                            <td class="td-card">
                                                <input type="text" name="attribute12" class="form-control" readonly value="{{ $attribute[11]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                            <td class="td-card">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion12" readonly>{{ $attribute[11]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class='tr-card-complete'>
                                            <!--Atributo1-->
                                            <td  class='bold' id="address addy" colspan="2">Nivel de Madurez:
                                                <label style="font-weight: bold">{{ $attribute[12]['ML'] }}</label><br>
                                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 13</th>
                                            <td class="td-card">
                                                <input type="text" name="attribute13" class="form-control" readonly value="{{ $attribute[12]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                            <td class="td-card">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion13" readonly>{{ $attribute[12]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 14</th>
                                            <td class="td-card">
                                                <input type="text" name="attribute14" class="form-control" readonly value="{{ $attribute[13]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                            <td class="td-card">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion14" readonly>{{ $attribute[13]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="tr-card-complete">
                                            <th class="th-card"><i class="fas fa-user-tag"></i> Atributo 15</th>
                                            <td class="td-card">
                                                <input type="text" name="attribute15" class="form-control" readonly value="{{ $attribute[14]['AD'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th-card"><i class="fas fa-question-circle"></i> Sugerencia</th>
                                            <td class="td-card">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="suggestion15" readonly>{{ $attribute[14]['AS'] }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class='container'>
                                    <a href="{{ route('EditTest', $conceptId) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar</a>
                                    <button class="btn btn-danger" id="eliminar" data-toggle="modal" data-target="#DeleteTest"><i class="fas fa-trash"></i> Eliminar Prueba</button>
                                    <button class="btn btn-danger" id="eliminar" data-toggle="modal" data-target="#DeleteConcept"><i class="fas fa-trash"></i> Eliminar Concepto</button>
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
