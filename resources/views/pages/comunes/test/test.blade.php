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

