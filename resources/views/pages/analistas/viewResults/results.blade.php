@extends('layouts.app', ['activePage' => 'AnListResults', 'titlePage' => __('Resultados')])

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

                    <div class="card">
                        <div class="card-header bg-dark">
                            <h4 class="card-title text-white">Resultados</h4>
                            <p class="card-category">Puedes cambiar de área con el siguiente selector.</p>
                            @if(empty($areas))
                                <p class="card-category text-white">No hay áreas</p>
                            @else
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle dp-areas" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{$areaSeleccionada->name}}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        @foreach($areas as $area)
                                            <a href="{{route('analistaViewResults',$area['areaId'])}}">
                                                <button class="dropdown-item " type="button">{{$area['name']}}
                                                </button>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if(empty($tests))
                                <p class="card-category text-white">No hay pruebas creadas.</p>
                            @else
                            @endif
                        </div>

                        @foreach($tests as $test)
                                <div class="card">
                                    <div class="card-header card-header-info">
                                        <h4 class="card-title">{{$test['name']}}</h4>
                                        <p class="card-category"><i class="material-icons">scatter_plot</i> <strong>Creado el:</strong> {{$test['startedAt']}}</p>
                                        <p class="card-category"><i class="material-icons">scatter_plot</i> <strong>Usuario asignado:</strong> {{$test['username']}}</p>
                                        @foreach($groups as $level)
                                            @if($level['MLGroupId'] == $test['MLGroupId'])
                                                <p class="card-category"><i class="material-icons">scatter_plot</i> <strong>Nivel de Madurez Aplicado:</strong> {{$level['name']}}</p>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 charts-list-scroll">
                                                <table class="table-bordered table-striped charts-table">
                                                    <thead>
                                                    <tr>
                                                        <th><i class="material-icons icons-charts-list">task</i> Concepto</th>
                                                        <th><i class="material-icons icons-charts-list">auto_stories</i> Puntuación</th>
                                                        <th><i class="material-icons icons-charts-list">auto_stories</i> Madurez</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach((array)$testsConcepts as $testConcept)
                                                        @if($testConcept->testId == $test['testId'])
                                                            <tr>
                                                                <td><i class="material-icons icons-charts-list">fact_check</i> {{$testConcept->description}}</td>
                                                                <td><i class="material-icons icons-charts-list">flag</i> {{$results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']}} de 15
                                                                </td>
                                                                <input type="hidden" {{$total = $total + $results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']}} {{$promedio = $promedio + 1}}>
                                                                <td><i class="material-icons icons-charts-list">star_rate</i>
                                                                    @if($results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']===0)
                                                                        Incompleto
                                                                    @endif
                                                                    @switch($results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)'])
                                                                        @case($results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']<3)
                                                                        @foreach($maturityLevels as $item)
                                                                            @if($test['MLGroupId'] == $item['MLGroupId'])
                                                                                @if($item['level']==1)
                                                                                    {{$item['description']}}
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                        @break
                                                                        @case($results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']<6)
                                                                        @foreach($maturityLevels as $item)
                                                                            @if($test['MLGroupId'] == $item['MLGroupId'])
                                                                                @if($item['level']==2)
                                                                                    {{$item['description']}}
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                        @break
                                                                        @case($results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']<9)
                                                                        @foreach($maturityLevels as $item)
                                                                            @if($test['MLGroupId'] == $item['MLGroupId'])
                                                                                @if($item['level']==3)
                                                                                    {{$item['description']}}
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                        @break
                                                                        @case($results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']<12)
                                                                        @foreach($maturityLevels as $item)
                                                                            @if($test['MLGroupId'] == $item['MLGroupId'])
                                                                                @if($item['level']==4)
                                                                                    {{$item['description']}}
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                        @break
                                                                        @case($results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']<=15)
                                                                        @foreach($maturityLevels as $item)
                                                                            @if($test['MLGroupId'] == $item['MLGroupId'])
                                                                                @if($item['level']==5)
                                                                                    {{$item['description']}}
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                        @break
                                                                    @endswitch
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6" style="height: 20vh">
                                                <canvas id="myChart{{array_search($test,$tests)}}"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
            @foreach($tests as $test)
        var ctx = document.getElementById("myChart{{array_search($test,$tests)}}");
        var lineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach((array)$testsConcepts as $testConcept)
                        @if($testConcept->testId == $test['testId'])
                        "{{$testConcept->description}}",
                    @endif
                    @endforeach
                ],
                datasets: [{
                    data:
                        [
                            @foreach((array)$testsConcepts as $testConcept)
                            @if($testConcept->testId == $test['testId'])
                            {{$results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']}},
                            @endif
                            @endforeach
                        ],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360","#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360","#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774","#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774","#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"],
                    borderWidth: 5,
                    scaleSteps: 5,
                    scaleStepWidth: 50,
                    scaleStartValue: 0,
                }]
            },
            options: {
                plugins:{
                    legend: {
                        display: false
                    }
                },
                indexAxis: 'y',
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMin: 0,
                            min: 0,
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMin: 0,
                            min: 0,
                        }
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: true,
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.yLabel;
                        }
                    }
                }
            }
        });
        @endforeach
    </script>
@endsection
