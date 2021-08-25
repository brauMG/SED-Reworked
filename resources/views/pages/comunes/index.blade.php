@extends('layouts.app', ['activePage' => 'Tests', 'titlePage' => __('Pruebas')])

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
                            <h4 class="card-title text-white">Lista de Pruebas</h4>
                            <p class="card-category">Estos son las pruebas que se te han asignado.</p>
                            <a style="float: right" type="button" class="btn btn-secondary" target="_blank" href="{{ URL::to('/') }}/files/manual.pdf">Descargar Manual de Usuario <i class="material-icons">download_for_offline</i></a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered data-table">
                                    <thead class="thead-color text-primary">
                                        <th>área<i class="material-icons sort">sort</i></th>
                                        <th>NOMBRE DE LA PRUEBA<i class="material-icons sort">sort</i></th>
                                        <th>NOMBRE DEL CONCEPTO<i class="material-icons sort">sort</i></th>
                                        <th>fecha de asignación<i class="material-icons sort">sort</i></th>
                                        <th>VER PRUEBA<i class="material-icons sort">sort</i></th></thead>
                                    <tbody>
                                    @foreach((array)$concepts as $concept)
                                        <tr>
                                            <td>{{$concept->areaName}}</td>
                                            @foreach((array)$tests as $test)
                                                @if($test['testId'] == $concept->testId)
                                                    <td class="td" style="font-size: large">{{$test['name']}}</td>
                                                @endif
                                            @endforeach
                                                <td>{{$concept->description}}</td>
                                                <td>{{$concept->date}}</td>
                                                <td class="action-row text-center">
                                                <a href="{{route('comunTest',[$concept->testId,$concept->conceptId])}}" class="btn btn-sm btn-primary"> Ver </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.data-table').DataTable({
                responsive: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 Filas', '25 Filas', '50 Filas', 'Mostrar todo']
                ],
                dom: 'Blfrtip',
                buttons: [
                    { extend: 'pdf', text: 'Exportar a PDF',charset: 'UTF-8' },
                    { extend: 'csv', text: 'Exportar a EXCEL',charset: 'UTF-8'  }
                ],
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla =(",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad",
                        "print": "Imprimir",
                        "csv": "Excel"
                    }
                },

            }
        );
    </script>
@endsection
