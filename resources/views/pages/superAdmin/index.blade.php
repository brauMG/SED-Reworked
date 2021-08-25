@extends('layouts.app', ['activePage' => 'SuperListAdmins', 'titlePage' => __('Lista de Administradores')])

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
                            <h4 class="card-title text-white">Lista de Administradores</h4>
                            <p class="card-category">Estos son los distintos administradores registrados para las compañias en el sistema.</p>
                            <a type="button" class="btn btn-primary" id="new" href="{{url('CreateAdmin/addAdmin/create')}}">Agregar Administrador <i class="material-icons">add_box</i></a>
                            <a style="float: right" type="button" class="btn btn-secondary" target="_blank" href="{{ URL::to('/') }}/files/manualAdmin.pdf">Descargar Manual de Usuario <i class="material-icons">download_for_offline</i></a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered data-table">
                                    <thead class="thead-color text-primary">
                                        <th>ESTADO DE SU EMPRESA<i class="material-icons sort">sort</i></th>
                                        <th>EMPRESA<i class="material-icons sort">sort</i></th>
                                        <th>ADMINISTRADOR<i class="material-icons sort">sort</i></th>
                                        <th>USUARIO<i class="material-icons sort">sort</i></th>
                                        <th>TELÉFONO DE LA EMPRESA<i class="material-icons sort">sort</i></th>
                                        <th>CORREO DE LA EMPRESA<i class="material-icons sort">sort</i></th>
                                        <th>REGISTRO PERSONAL<i class="material-icons sort">sort</i></th>
                                    </thead>
                                    <tbody>
                                    @foreach($Admins as $users)
                                        <tr>
                                            <td class="text-center">
                                                <form class='form' method="POST" action="{{ route('ChangeStatus',$users->companyId) }}">
                                                    @method('PUT')
                                                    @csrf
                                                    @if ($users->status == 0)
                                                        <input type="hidden" name="status" style="width: 0px;border:none; " readonly value="1">
                                                        <input type="submit" value="Deshabilitado" class="btn btn-danger" disabled>@endif
                                                    @if ($users->status != 0)
                                                        <input type="hidden" name="status" style="width: 0px;border:none; " readonly value="0">
                                                        <input type="submit" value="Habilitado" class="btn btn-success" disabled>
                                                    @endif
                                                </form>
                                            </td>
                                            <td>{{$users->name }}</td>
                                            <td>{{ $users->firstName." ".$users->lastName }}</td>
                                            <td>{{$users -> username}}</td>
                                            <td>{{$users->phoneNumber }}</td>
                                            <td>{{$users->email}}</td>
                                            <td class="action-row text-center">
                                                <a href="{{ route('ViewAdmin', $users->id) }}" class="btn btn-info btn-adjust"><i class="material-icons">sticky_note_2</i> Mostrar</a>
                                                <a href="{{ route('EditAdmin', $users->id) }}" class="btn btn-warning btn-adjust"><i class="material-icons">edit</i> Editar</a>
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
