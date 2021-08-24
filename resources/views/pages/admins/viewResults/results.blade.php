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
                <div class="col text-center btn-hover">
                    <a href="" class="selected btn btns-grid border-light btn-layout btn-grid">
                        <div><i class="material-icons" style="vertical-align: bottom;">
                                remove_red_eye
                            </i></div>
                        <div>Ver Resultados</div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(empty($areas))
         <div class="container">
             <div class="container bg-light" style="border-radius: 25px;">
                 <div class="row justify-content-center row-left">
                     <div style="text-align: center">
                         <h5 class="display-4">No hay ningún área creada.</h5>
                         <a href="{{ url('/admins/area/addArea') }}">
                             <h5>Puedes crear una aquí.</h5>
                         </a>
                     </div>
                 </div>
             </div>
             @else
                 <div class="dropdown" style="text-align: center">
                     <button class="btn dropdown-toggle dp-areas" type="button" id="dropdownMenu2" data-toggle="dropdown"
                             aria-haspopup="true" aria-expanded="false">
                         {{$areaSeleccionada->name}}
                     </button>
                     <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                         @foreach($areas as $area)
                             <a href="{{route('adminViewResults',$area['areaId'])}}">
                                 <button class="dropdown-item " type="button">{{$area['name']}}
                                 </button>
                             </a>
                         @endforeach
                     </div>
                 </div>
         </div>
         @if(empty($tests))
             <div class="container" style="text-align: center">
                 <div class="row justify-content-center row-left" style="margin-left: 12%">
                     <div class='center'>
                         <h5 class="display-4">Esta área no tiene pruebas asignadas.</h5>
                         <a href="{{ url('/admins/area/test/create') }}">
                             <h5 style="color: #0F4C75">Puedes crear y asignar una aquí.</h5>
                         </a>
                     </div>
                 </div>
             </div>
         @else
         @endif
         <div class="fixContainer mb-4">
         <div class="container adjust">
             <div data-simplebar class="card-height-add-test">
                 @foreach($tests as $test)
                         <div class="col text-center">
                             <div class="justify-content-center">
                                 <div class="card card-see-results" style="border: solid">
                                     <div class="card-header card-header-cute">
                                         <h4 class="no-bottom" style="text-transform: uppercase">{{$test['name']}}</h4>
                                     </div>
                                     <div class="card-body" style="background-color: rgba(176, 249, 255, 0.39) !important;">
                                         <div class="container" style="text-align: right">
                                             <i class="far fa-calendar-plus"></i> <strong>Creado el:</strong> {{$test['startedAt']}}
                                             <br>
                                             <i class="fas fa-user-tag"></i> <strong>Usuario asignado:</strong> {{$test['username']}}
                                             <br>
                                             @foreach($groups as $level)
                                                 @if($level['MLGroupId'] == $test['MLGroupId'])
                                                    <i class="fas fa-user-tag"></i> <strong>Nivel de madurez aplicado:</strong> {{$level['name']}}
                                                 @endif
                                             @endforeach
                                         </div>

                                         <div class="row bg-transparent rounded mb-0 column" style="background-color: white !important;">
                                         <div class="col-xl-6 max" style="padding-top: 5%; padding-left: 10%">
                                             <div class="row row2 ">
                                                 <table class="table-responsive table-card-inline">
                                                     <thead class="thead"  style="text-align: left">
                                                     <tr class="tr-card-complete">
                                                         <th scope="col" class="th-card"><i class="fab fa-font-awesome-alt"></i> Concepto</th>
                                                         <th scope="col" class="th-card"><i class="far fa-star"></i> Puntuación</th>
                                                         <th scope="col" class="th-card"><i class="fas fa-level-up-alt"></i> Madurez</th>
                                                     </tr>
                                                     </thead>
                                                     <tbody class="fonts" style="text-align: left">
                                                     @foreach((array)$testsConcepts as $testConcept)
                                                         @if($testConcept->testId == $test['testId'])
                                                             <tr class="tr-card-complete" pa>
                                                                 <td class="td" style="padding-top: 1%"><i class="fas fa-flag"></i> {{$testConcept->description}}</td>
                                                                 <td class="td" style="padding-top: 1%"><i class="fas fa-star"></i> {{$results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']}} de 15
                                                                 </td>
                                                                 <input type="hidden" {{$total = $total + $results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']}} {{$promedio = $promedio + 1}}>
                                                                 <td class="td"style="padding-top: 1%"><i class="fas fa-clipboard"></i>
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
                                         </div>
                                         <div class="row2 col-xl-6 max my-auto ">
                                             <div class="card bg-transparent" style="border: none; ">
                                                 <div class="card-body">
                                                     <div class="chart" *ngIf="showchart">
                                                         <canvas id="myChart{{array_search($test,$tests)}}"></canvas>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                 @endforeach
                 @endif
             </div>
         </div>
         </div>
    @endsection
    @section('script')
    <script>
                @foreach($tests as $test)
            var ctx = document.getElementById("myChart{{array_search($test,$tests)}}");
            var lineChart = new Chart(ctx, {
                type: 'horizontalBar',
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
                        enabled: true
                    }
                }
            });
            @endforeach
        </script>
    @endsection
