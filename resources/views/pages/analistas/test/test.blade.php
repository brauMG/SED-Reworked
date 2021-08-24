@extends('layouts.app')
@section('content')
    <div class="layoutContainer">
        <div class="container mb-4">
            <div class="row">

                <div class="col text-center btn-hover">
                    <a href="{{ url('/analista') }}" class="btn btns-grid border-light btn-layout btn-grid">
                        <div><i class="material-icons" style="vertical-align: bottom">
                                insert_chart_outlined
                            </i></div>
                        <div>Lista de Pruebas</div>
                    </a>
                </div>

                <div class="col text-center btn-hover">
                    <a href="{{ url('/areas') }}" class="btn btns-grid border-light btn-layout btn-grid">
                        <div><i class="material-icons" style="vertical-align: bottom;">
                                show_chart
                            </i></div>
                        <div>Lista de Areas</div>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="container-dropdown-evidence">
            <div class="dropdown dropping">
                <button class="btn dropdown-toggle dp-areas" type="button" id="dropdownMenu2" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" style="">
                    {{$selectedConcept['description']}}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach($concepts as $concept)
                        @if($selectedConcept['description'] == $concept->description)
                        @else
                            <a class="dropdown-item" href="{{route('analistaTest',[$concept->testId,$concept->conceptId])}}">{{$concept->description}}</a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div data-simplebar class="card-height-add-test">
            <div class="col text-center">
                <div class="justify-content-center">
                    <div class="card card-add-company">
                        <div class="card-header card-header-cute">
                            <h4 class="no-bottom" style="text-transform: uppercase">{{$test['name']}}</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" target="_blank" action="/test">
                                <input type="hidden" name="email" value="{{$email}}">
                                <input type="hidden" name="commonUserId" value="{{$commonUserId}}">
                                <input type="hidden" name="username" value="{{$name}} {{$lastName}}">
                                <input type="hidden" name="testName" value="{{$testName}}">
                                <input type="hidden" name="analistName" value="{{$analistFirstName}} {{$analistLastName}}">
                                @for($i = 0; $i < count($emailsAdmins); $i++)
                                    <input type="hidden" name="emailsAdmins[{{$i}}]" value="{{$emailsAdmins[$i]}}">
                                @endfor
                                @for($i = 0; $i < count($emailsAnalistas); $i++)
                                    <input type="hidden" name="emailsAnalistas[{{$i}}]" value="{{$emailsAnalistas[$i]}}">
                                @endfor
                                @csrf
                                    <div class="container">
                                    <tr class='row'>
                                        <p class='' style="text-align: start"><i class="fas fa-user-check"></i><strong> Usuario:</strong> {{$name}} {{$lastName}}</p>
                                        <p class='' style="text-align: start"><i class="fas fa-inbox"></i><strong> Correo:</strong> {{$email}}</p>
                                    </tr>
                                    </div>
                                <table class="table-responsive table-card-inline">
                                    <thead>
                                    <tr class='tr-card-complete'>
                                        <th class='bold th-evidence-analist' id="address addy" scope="col"><i class="fas fa-tasks"></i> Atributos</th>
                                        <th class='bold th-evidence-analist' id="address addy" scope="col"><i class="fas fa-download"></i> Descargar</th>
                                        <th class='bold th-evidence-analist' id="address addy" scope="col"><i class="far fa-check-circle"></i> Validar</th>
                                        <th class='bold th-evidence-analist' id="address addy" scope="col"><i class="far fa-check-circle"></i> Sugerencia</th>
                                    </tr>
                                    </thead>
                                    @foreach($maturityLevels as $maturityLevel)
                                        <tr class='heady'>
                                            <th class='th-card bold' id="address addy" >
                                                {{$maturityLevel->description}}
                                            </th>
                                        </tr>
                                        @foreach($attributes as $attribute)
                                            @if($attribute->conceptMLId == $maturityLevel->conceptMLId)
                                                <tr>
                                                    <td style="text-align: justify">
                                                        {{$attribute->description}}
                                                    </td>
                                                    <input type="hidden" name="attribute-name[]" value="{{$attribute->attributeId}}">
                                                    @for($i=0;$i < sizeof($attributesWithEvidences);$i++)
                                                        @if($attribute->attributeId == $attributesWithEvidences[$i]->attributeId)
                                                            <a type="hidden" {{$with_evidence = 1}}></a>
                                                            <td>
                                                                <a target="_blank" href="/storage/upload/{{$attributesWithEvidences[$i]->link}}" class="btn btn-evidence">
                                                                    <div><i class="material-icons" style="vertical-align: bottom">cloud_download</i>
                                                                    </div>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <div class="form-check">
                                                                    <label
                                                                        for="attributeCheck{{$attributesWithEvidences[$i]->attributeId}}">
                                                                    </label>
                                                                    <input type="hidden"  name="attributeCheck[{{$attributesWithEvidences[$i]->attributeId}}]" value="off" >
                                                                    <input type="checkbox" class="form-check-input" name="attributeCheck[{{$attributesWithEvidences[$i]->attributeId}}]" id="attributeCheck{{$attributesWithEvidences[$i]->attributeId}}"
                                                                           @if($attributesWithEvidences[$i]->verified === 1)checked
                                                                    @else
                                                                        @endif>
                                                                    <label class="form-check-label" for="exampleCheck1">Validar evidencia</label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check">
                                                                    <label
                                                                        for="suggestionCheck{{$attributesWithEvidences[$i]->attributeId}}">
                                                                    </label>
                                                                    <input type="hidden"  name="suggestionCheck[{{$attributesWithEvidences[$i]->attributeId}}]" value="off" >
                                                                    <input type="checkbox" class="form-check-input" name="suggestionCheck[{{$attributesWithEvidences[$i]->attributeId}}]" id="suggestionCheck{{$attributesWithEvidences[$i]->attributeId}}">
                                                                    <label class="form-check-label" for="exampleCheck1">Enviar sugerencia</label>
                                                                </div>
                                                            </td>
                                                        @endif
                                                    @endfor
                                                    @if($with_evidence == 1)
                                                        <a type="hidden" {{$with_evidence = 0}}></a>
                                                    @else
                                                        <td>
                                                            <a class="btn btn-no-evidence">
                                                                <div>
                                                                    <i class="material-icons" style="vertical-align: bottom">cloud_off</i>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" value="off" disabled>
                                                                <label class="form-check-label" for="exampleCheck1">Validar evidencia</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" value="off" disabled>
                                                                <label class="form-check-label" for="exampleCheck1">Enviar sugerencia</label>
                                                            </div>
                                                        </td>

                                                        <a type="hidden"{{ $with_evidence = 0 }}></a>
                                                    @endif
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </table>
                                <div class="container">
                                    <tr>
                                        <th class="th-card"><i class="fas fa-question-circle"></i> Observación adicional: </th>
                                        <td class="td-card"> <div class="form-group">
                                                <textarea class="form-control" rows="5" name="observation" style="background-color: #eff0ee"></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                </div>
                                    @if(count($attributesWithEvidences) == 0)
                                    <div class="container">
                                        <button class="button-size-08 btn btn-add btn-primary" style="background-color: #a21612; color: white" disabled>Aún Sin Responder</button>
                                    </div>
                                    @else
                                        <div class="container">
                                            <button type="submit" class="button-size-08 btn btn-add btn-primary">Enviar Resultados</button>
                                        </div>
                                    @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
@endsection
