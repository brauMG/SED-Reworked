@extends('layouts.app', ['activePage' => 'AdminListLog', 'titlePage' => __('Historial')])

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
                            <h4 class="card-title text-white">Historial de Acciones</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered data-table">
                                    <thead class="thead-color text-primary">
                                        <th>Usuario<i class="material-icons sort">sort</i></th>
                                        <th>Acción<i class="material-icons sort">sort</i></th>
                                        <th>Fecha<i class="material-icons sort">sort</i></th>
                                    </thead>
                                    <tbody>
                                    @foreach ($Historial as $History)
                                        <tr>
                                            <td>{{ $History->username}}<i class="material-icons plus">add_circle</i></td>
                                            <td>{{ $History->action }}</td>
                                            <td>{{ $History->date }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            <div class="container text-center">
                                <form method="POST" action="{{ route('HistoryDeleteA') }}" id="fromhistory">
                                    @method('PUT')
                                    @csrf
                                    <input type="button" class="btn btn-danger" name="delete" value="Borrar Registros" onclick="$('#NoteDeleteHitorial').modal();">
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

                <div class="modal show" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="NoteDeleteHitorial">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content"style="background-color: #D9534F;color: white;">
                      <div class="modal-header ">
                        <h5 class="modal-title"  id="exampleModalLongTitle">Elminación del Historial</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                       <div style="background-color: white;color: black;">
                           <center>
                                 <div class="modal-body">
                                    ¿Desea eliminar los datos del Historial?
                                  </div>
                            </center>
                       </div>
                      <div class="modal-footer" style="background-color: white;color: black;">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="DeleteHistory();">Aceptar</button>
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
