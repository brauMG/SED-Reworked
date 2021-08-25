@extends('layouts.app', ['activePage' => 'Tests', 'titlePage' => __('Prueba')])

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
                                            aria-haspopup="true" aria-expanded="false" style="}">
                                        {{$selectedConcept['description']}}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <input type="hidden" {{$count = count($concepts)}}>
                                        @foreach($concepts as $concept)
                                            @if($selectedConcept['description'] == $concept->description)
                                                @if($count == 1)
                                                    <a>
                                                        <button class="dropdown-item " type="button" disabled>No hay mas conceptos
                                                        </button>
                                                    </a>
                                                @endif
                                            @else
                                                <a href="{{route('comunTest',[$concept->testId,$concept->conceptId])}}">
                                                    <button class="dropdown-item " type="button">{{$concept->description}}
                                                    </button>
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                        <div class="message">
                                @if(session("success"))
                                <h4 class='alert-success' id='message'>{{session('success')}}</h4>

                                @endif
                            </div>
                            <table class="table-responsive table-card-inline">
                                <thead>
                                <th>Atributos</th>
                                <th>Subir</th>
                                <th>Mirar</th>
                                </thead>
                                    @foreach($maturityLevels as $maturityLevel)
                                    <th class='th-card bold' id="address addy">{{$maturityLevel->description}}</th>
                                        @foreach($attributes as $attribute)
                                            @if($attribute->conceptMLId == $maturityLevel->conceptMLId)
                                            <tr>
                                                <td>
                                                    {{$attribute->description}}
                                                </td>
                                                @for($i=0;$i < sizeof($attributesWithEvidences);$i++)
                                                    @if($attribute->attributeId == $attributesWithEvidences[$i]->attributeId)
                                                        <a type="hidden" {{$with_evidence = 1}}></a>
                                                        <td>
                                                            <a href="/upload/{{$attributesWithEvidences[$i]->evidenceId}}/edit">
                                                                <button class="btn btn-warning"><strong>Reemplazar evidencia</strong></button>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="/storage/upload/{{$attributesWithEvidences[$i]->link}}" target="_blank" class="btn btn-success">Ver</a>
                                                        </td>
                                                    @endif
                                                @endfor
                                                @if($with_evidence == 1)
                                                    <a type="hidden" {{$with_evidence = 0}}></a>
                                                @else
                                                    <td>
                                                        <a href="/upload/{{$attribute->attributeId}}" class="btn btn-primary">Subir Evidencia</a>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-danger">Nada</a>
                                                    </td>
                                                    <a type="hidden"{{ $with_evidence = 0 }}></a>
                                                @endif
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection

