@extends('layouts.app', ['activePage' => 'AdminAddML', 'titlePage' => __('Mostrar Niveles de Madurez')])

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
                    <div class="card" style="width: fit-content; margin: auto">
                        <div class="card-header bg-dark">
                            <h4 class="card-title text-white">Mostrando Registro de Niveles de Madurez</h4>
                        </div>

                        <div class="card-body">
                            <form class="form-edits" id="from" style="margin-bottom: 2% !important;">
                                @csrf
                                <table class="table-responsive table-card-inline" style="width: fit-content !important;; margin: auto" id="tAdmin">
                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">badge</span> Nombre del grupo</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="link" id="linkS"  class="form-control" disabled value="{{ $group[0]['name'] }}">
                                        </td>
                                    </tr>
                                    @php($count=1)
                                    @foreach ($maturity_levels as $ml)
                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">star_rate</span>Nivel {{$count}}</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="maturityName[{{ $ml['maturityLevelId'] }}]" id="{{$count}}" class="form-control DescMaturity" disabled value="{{ $ml['description']}}">
                                            </td>
                                        </tr>
                                        @php($count++)
                                    @endforeach
                                </table>
                            </form>
                            <div class='container text-center mt-3'>
                                <a href="{{ route('EditML', $groupId->MLGroupId) }}" class="btn btn-warning">Editar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="DeleteModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #761b18">
                    <h5 class="modal-title upcase"  id="exampleModalLongTitle" style="color: white">Eliminar Grupo de Niveles de Madures</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('DeleteML', [$groupId->MLGroupId])}}" method="POST">
                    @csrf
                    <div style="background-color: white;color: black;">
                        <center>
                            <div class="modal-body" >
                                ¿Deseas eliminar por completo los datos del grupo? Esto eliminara todas las pruebas vinculadas al mismo.
                            </div>
                            <div class="spinner-border m-5" role="status" style="display: none;">
                                <span class="sr-only">Cargando...</span>
                            </div>
                        </center>
                    </div>

                    <div class="modal-footer" style="background-color: white;color: black;">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

