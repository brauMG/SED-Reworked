@extends('layouts.app', ['activePage' => 'SuperAddSponsors', 'titlePage' => __('Mostrar Patrocinador')])

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
                            <h4 class="card-title text-white">Mostrando Registro de Patrocinador</h4>
                        </div>

                        <div class="card-body">
                            <form class="form-edits" id="from" style="margin-bottom: 2% !important;">
                                @csrf
                                <table class="table-responsive table-card-inline" style="width: fit-content !important;; margin: auto" id="tAdmin">
                                    <!--TABLA ADMIN-->
                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">drive_file_rename_outline</span> Nombre</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="name" id="nameS" class="form-control" disabled value="{{ $sponsor->name }}">
                                        </td>
                                    </tr>
                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">description</span> Descripción</th>
                                        <td class="td-card pl-1">
                                            <div class="form-group">
                                                <textarea rows="5" style="background-color: #eff0ee" name="description" id="descriptionS"  class="form-control @error('description') is-invalid @enderror" disabled>{{ $sponsor->description }}</textarea>
                                            </div>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th id='head' class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">business</span> Compañias Asignadas</th>
                                        <td class="td-card pl-1">
                                            @foreach ($companies as $company)
                                                @if($company['companyId'] == 1)
                                                    <div class="form-check">
                                                        <input class="form-check-input label-size" type="hidden" name="companies[{{$company['name']}}]" value="{{ $company['companyId'] }}" checked>
                                                    </div>
                                                @else
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox" name="companies[{{$company['name']}}]" value="{{ $company['companyId'] }}" disabled checked>
                                                            {{ $company['name'] }}
                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                            @error('companies')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="tr-card-complete">
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">link</span> Link</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="lastName" id="linkS"  class="form-control" disabled value="{{ $sponsor->link }}">
                                        </td>
                                    </tr>
                                    <tr id="tr-image" style="display: none">
                                        <th class="th-card pr-1">
                                            <span class="material-icons" style="vertical-align: sub">image</span> Imagen (formato .png)
                                        </th>
                                        <td class="td-card pl-1">
                                            <input type="file" name="image" id="file" class="adjust-file form-control @error('image') is-invalid @enderror" />
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr style="display: none">
                                        <th id='head' class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">home</span> Mostrar en Inicio</th>
                                        <td class="td-card pl-1">
                                            <div class="form-check">
                                                <input class="form-check-input label-size" type="checkbox" name="show" value="1" disabled checked>
                                                <label class="form-check-label label-size" for="defaultCheck1">Si</label>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <div class='container text-center mt-3'>
                                <a href="{{ route('EditSponsor', $sponsor->sponsorId) }}" class="btn btn-warning">Editar</a>
                                <button class="btn btn-danger" id="eliminar" data-toggle="modal" data-target="#DeleteModal">Eliminar Patrocinador</button>
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
                        <h5 class="modal-title upcase"  id="exampleModalLongTitle" style="color: white">Eliminar Patrocinador</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('DeleteSponsor', [$sponsor->sponsorId])}}" method="POST">
                        @csrf
                        <div style="background-color: white;color: black;">
                            <center>
                                <div class="modal-body" >
                                    ¿Deseas eliminar por completo los datos del patrocinador?
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
