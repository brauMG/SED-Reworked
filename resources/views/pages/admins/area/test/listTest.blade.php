@extends('layouts.app', ['activePage' => 'AdminListTests', 'titlePage' => __('Lista de Pruebas')])

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
                            <p class="card-category">Estas son las distintas pruebas registradas en el sistema.</p>
                            <a type="button" class="btn btn-primary" id="new" href="{{url('/admins/area/test/create')}}">Agregar Prueba <i class="material-icons">add_box</i></a>
                            <a type="button" class="btn btn-primary" id="new" href="{{url('/admins/area/concept_test/create')}}">Agregar Conceptos a Pruebas <i class="material-icons">add_box</i></a>
                            <a type="button" class="btn btn-primary" id="new" href="{{url('/admins/area/test/duplicate')}}">Duplicar Prueba <i class="material-icons">edit</i></a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered data-table">
                                    <thead class="thead-color text-primary">
                                    <th>area de la prueba<i class="material-icons sort">sort</i></th>
                                    <th>nombre de la prueba<i class="material-icons sort">sort</i></th>
                                    <th>concepto<i class="material-icons sort">sort</i></th>
                                    <th>usuario asignado<i class="material-icons sort">sort</i></th>
                                    <th>registro<i class="material-icons sort">sort</i></th>
                                    </thead>
                                    <tbody>
                                    @foreach ($dataTests as $test)
                                        <tr>
                                            <td>{{ $test['areaName'] }}</td>
                                            <td>{{ $test['testName'] }}</td>
                                            <td>{{ $test['conceptName'] }}</td>
                                            <td>{{ $test['user']}}</td>
                                            <td class="action-row text-center">
                                                <a href="{{ route('ShowTest', $test['conceptId']) }}" class="btn-adjust btn btn-info"><i class="material-icons">sticky_note_2</i> Mostrar</a>
                                                <a href="{{ route('EditTest', $test['conceptId']) }}" class="btn-adjust btn btn-warning"><i class="material-icons">edit</i> Editar</a>
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
