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
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center">Atributos</th>
                                    <th class="text-center">Subir</th>
                                    <th class="text-center">Mirar</th>
                                </tr>
                                </thead>
                                <tbody>
                                        @foreach($maturityLevels as $maturityLevel)
                                            <tr>
                                                <th class='text-center bg-secondary' id="address addy">{{$maturityLevel->description}}</th>
                                                <th class='text-center bg-secondary' id="address addy"></th>
                                                <th class='text-center bg-secondary' id="address addy"></th>
                                            </tr>
                                            @foreach($attributes as $attribute)
                                                @if($attribute->conceptMLId == $maturityLevel->conceptMLId)
                                                <tr>
                                                    <td class="text-center">{{$attribute->description}}</td>
                                                    @for($i=0;$i < sizeof($attributesWithEvidences);$i++)
                                                        @if($attribute->attributeId == $attributesWithEvidences[$i]->attributeId)
                                                            <a type="hidden" {{$with_evidence = 1}}></a>
                                                            <td class="td-actions text-center">
                                                                <a href="/upload/{{$attributesWithEvidences[$i]->evidenceId}}/edit" class="btn btn-danger btn-sm">Reemplazar evidencia</a>
                                                            </td>
                                                            <td class="td-actions text-center">
                                                                <a href="{{'/evidences/'.$attributesWithEvidences[$i]->link}}" target="_blank" class="btn btn-success btn-sm">Ver</a>
                                                            </td>
                                                        @endif
                                                    @endfor
                                                    @if($with_evidence == 1)
                                                        <a type="hidden" {{$with_evidence = 0}}></a>
                                                    @else
                                                        <td class="td-actions text-center">
                                                            <a href="/upload/{{$attribute->attributeId}}" class="btn btn-primary">Subir Evidencia</a>
                                                        </td>
                                                        <td class="td-actions text-center">
                                                            <a class="btn btn-danger btn-sm">Nada</a>
                                                        </td>
                                                        <a type="hidden"{{ $with_evidence = 0 }}></a>
                                                    @endif
                                                </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                </tbody>
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

