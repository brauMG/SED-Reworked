@extends('layouts.app', ['activePage' => 'SuperListCompanies', 'titlePage' => __('Lista de Empresas')])

@section('content')
    @php($count=1)
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
                            <h4 class="card-title text-white">Lista de Empresas</h4>
                            <p class="card-category">Estas son las empresas registradas en el sistema.</p>
                            <a type="button" class="btn btn-primary" id="new" href="{{url('/CreateCompany/addCompany/create')}}">Agregar Empresa <i class="material-icons">add_box</i></a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered data-table">
                                    <thead class="thead-color text-primary">
                                    <th>ID<i class="material-icons sort">sort</i></th>
                                    <th>ESTADO<i class="material-icons sort">sort</i></th>
                                    <th>EMPRESA<i class="material-icons sort">sort</i></th>
                                    <th>DIRECCIÓN<i class="material-icons sort">sort</i></th>
                                    <th>TELÉFONO<i class="material-icons sort">sort</i></th>
                                    <th>CORREO<i class="material-icons sort">sort</i></th>
                                    <th>REGISTRO<i class="material-icons sort">sort</i></th>
                                    </thead>
                                    <tbody>
                                    @foreach($Com as $C)
                                        @if($C->companyId != 1)
                                            <tr>
                                                <td>{{$count}}</td>
                                                <td class="text-center">
                                                    <form class='form'  method="POST" action="{{ route('status',$C->companyId) }}">
                                                        @method('PUT')
                                                        @csrf
                                                        @if ($C->status == 0)
                                                            <input type="hidden" name="status" style="width: 0px;border:none; " readonly value="1">
                                                            <input type="submit" value="Deshabilitado" class="btn btn-danger" disabled>
                                                        @endif
                                                        @if ($C->status != 0)
                                                            <input type="hidden" name="status" style="width: 0px;border:none; " readonly value="0">
                                                            <input type="submit" value="Habilitado" class="btn btn-success" disabled>
                                                        @endif
                                                    </form>
                                                </td>
                                                <td>{{$C -> name}}</td>
                                                <td>{{$C -> address}}</td>
                                                <td>{{$C -> phoneNumber}}</td>
                                                <td>{{$C -> email}}</td>
                                                <td class="action-row text-center">
                                                    <a href="{{ route('ShowCompanySA', $C->companyId) }}" class="btn btn-info btn-adjust"><i class="material-icons">sticky_note_2</i> Mostrar</a>
                                                    <a href="{{ route('EditCompany', $C->companyId) }}" class="btn btn-warning btn-adjust"><i class="material-icons">edit</i> Editar</a>
                                                </td>
                                            </tr>
                                        @endif
                                        @php($count++)
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
