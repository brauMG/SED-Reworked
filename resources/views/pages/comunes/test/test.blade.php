@extends('layouts.app')

@section('content')
    <div class="layoutContainer">
        <div class="container mb-4">
            <div class="row">

                <div class="col text-center btn-hover">
                    <a href="{{ url('/comun') }}" class="btn btns-grid border-light btn-layout btn-grid" style="width: 30% !important;">
                        <div><i class="material-icons" style="vertical-align: bottom;">
                                home
                            </i> </div>
                        <div>Inicio</div>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
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

    <div data-simplebar class="card-height-add-test">
        <div class="col text-center">
            <div class="justify-content-center">
                <div class="card card-add-company">
                    <div class="card-header card-header-cute">
                        <h4 class="no-bottom" style="text-transform: uppercase">{{$test['name']}}</h4>
                        </div>
                        <div class="card-body">
                        <div class="message">
                                @if(session("success"))
                                <h4 class='alert-success' id='message'>{{session('success')}}</h4>

                                @endif
                            </div>
                            <table class="table-responsive table-card-inline">
                                <thead>
                                    <tr class='tr-card-complete'>
                                        <th class='bold th-evidence' id="address addy" scope="col" style="padding-bottom: 1%"><i class="fas fa-tasks"></i> Atributos</th>
                                        <th class='bold th-evidence' id="address addy" scope="col" style="padding-bottom: 1%"><i class="fas fa-upload"></i> Subir</th>
                                        <th class='bold th-evidence' id="address addy" scope="col" style="padding-bottom: 1%"><i class="far fa-eye"></i> Mirar</th>
                                    </tr>
                                </thead>
                                    @foreach($maturityLevels as $maturityLevel)
                                        <tr class='heady'>
                                            <th class='th-card bold' id="address addy">{{$maturityLevel->description}}</th>
                                        </tr>
                                        @foreach($attributes as $attribute)
                                            @if($attribute->conceptMLId == $maturityLevel->conceptMLId)
                                            <tr>
                                                <td style="text-align: justify">
                                                    {{$attribute->description}}
                                                </td>
                                                @for($i=0;$i < sizeof($attributesWithEvidences);$i++)
                                                    @if($attribute->attributeId == $attributesWithEvidences[$i]->attributeId)
                                                        <a type="hidden" {{$with_evidence = 1}}></a>
                                                        <td>
                                                            <a href="/upload/{{$attributesWithEvidences[$i]->evidenceId}}/edit">
                                                                <button class="btn btn-evidence" style="background-color: #f7b600 !important; color: black !important;"><strong>Reemplazar evidencia</strong></button>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="/storage/upload/{{$attributesWithEvidences[$i]->link}}" target="_blank" class="btn btn-evidence" style="background-color: #329013 !important;"><i class="far fa-eye"></i></a>
                                                        </td>
                                                    @endif
                                                @endfor
                                                @if($with_evidence == 1)
                                                    <a type="hidden" {{$with_evidence = 0}}></a>
                                                @else
                                                    <td>
                                                        <a href="/upload/{{$attribute->attributeId}}" class="btn btn-evidence" style="background-color: #12334a !important;"><i class="fas fa-upload"></i></a>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-evidence" style="background-color: #fb0000 !important;"><i class="fas fa-lock"></i></a>
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
@endsection
@section('script')
    @endsection

