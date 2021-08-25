@extends('layouts.app', ['activePage' => 'AnListTests', 'titlePage' => __('Prueba')])
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
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h4 class="card-title text-white">Resultados</h4>
                            <p class="card-category">Puedes cambiar de área con el siguiente selector.</p>
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
                                        <p class='' style="text-align: start"><strong> Usuario:</strong> {{$name}} {{$lastName}}</p>
                                        <p class='' style="text-align: start"><strong> Correo:</strong> {{$email}}</p>
                                    </tr>
                                    </div>
                                <table class="table-responsive table-card-inline">
                                    <thead>
                                    <tr>
                                        <th id="address addy"> Atributos</th>
                                        <th id="address addy"> Descargar</th>
                                        <th id="address addy"> Validar</th>
                                        <th id="address addy"> Sugerencia</th>
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
                                                                    <div><span style="vertical-align: sub" class="material-icons">cloud_download</span>
                                                                    </div>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="hidden"  name="attributeCheck[{{$attributesWithEvidences[$i]->attributeId}}]" value="off">
                                                                        <input type="checkbox" class="form-check-input" name="attributeCheck[{{$attributesWithEvidences[$i]->attributeId}}]" id="attributeCheck{{$attributesWithEvidences[$i]->attributeId}}"@if($attributesWithEvidences[$i]->verified === 1)checked @else @endif>
                                                                        Validar evidencia
                                                                        <span class="form-check-sign">
                                                                            <span class="check"></span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="hidden"  name="suggestionCheck[{{$attributesWithEvidences[$i]->attributeId}}]" value="off" >
                                                                        <input type="checkbox" class="form-check-input" name="suggestionCheck[{{$attributesWithEvidences[$i]->attributeId}}]" id="suggestionCheck{{$attributesWithEvidences[$i]->attributeId}}">
                                                                        Enviar sugerencia
                                                                        <span class="form-check-sign">
                                                                            <span class="check"></span>
                                                                        </span>
                                                                    </label>
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
                                                                    <i class="material-icons" style="vertical-align: sub">cloud_off</i>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="off" disabled>
                                                                    Validar evidencia
                                                                    <span class="form-check-sign">
                                                                            <span class="check"></span>
                                                                        </span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="off" disabled>
                                                                    Enviar sugerencia
                                                                    <span class="form-check-sign">
                                                                            <span class="check"></span>
                                                                        </span>
                                                                </label>
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
                                        <th class="th-card"> Observación adicional: </th>
                                        <td class="td-card"> <div class="form-group">
                                                <textarea class="form-control" rows="5" name="observation" style="background-color: #eff0ee"></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                </div>
                                    @if(count($attributesWithEvidences) == 0)
                                    <div class="container text-center mt-3">
                                        <button class="btn btn-primary" style="background-color: #a21612; color: white" disabled>Aún Sin Responder</button>
                                    </div>
                                    @else
                                    <div class="container text-center mt-3">
                                            <button type="submit" class="btn btn-primary">Enviar Resultados</button>
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
