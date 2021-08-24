@extends('layouts.app')

@section('content')
    <div class="layoutContainer">
        <div class="container mb-4">
            <div class="row">
                <div class="col text-center btn-hover">
                    <a href="{{url('/superAdmin')}}" class="btn border-light btn-layout btn-grid btns-grid">
                        <div><span class="material-icons">supervisor_account</span></div>
                        <div>Lista de Administradores</div>
                    </a>
                </div>
                <div class="col text-center btn-hover">
                    <a href="{{url('/superAdmin/viewCompanies/create')}}" class="btn border-light btn-layout btn-grid btns-grid">
                        <div><span class="material-icons">list</span></div>
                        <div>Lista de Empresas</div>
                    </a>
                </div>
                <div class="col text-center btn-hover">
                    <a href="{{url('/superAdmin/viewSponsors/listSponsors')}}" class="btn border-light btn-layout btn-grid btns-grid">
                        <div><i class="material-icons">format_list_numbered</i></div>
                        <div>Lista de Patrocinadores</div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class='container'>
        <div data-simplebar class="card-height-add-sponsor" style="margin-top: 3% !important;">
            <div class="col text-center">
                <div class="justify-content-center">
                    <div class="card card-add-company">

                        <div class="card-header card-header-cute">
                            <h4 class="no-bottom" style="text-transform: uppercase">Ver Registro de Patrocinador</h4>
                        </div>
                        <div class="container-company" style="background-color: rgba(18,51,74,0.33)">
                            <img id="old-image" src="{{ URL::to('/') }}/sponsors/{{ $sponsor->image }}" class="img-thumbnail" width="200" />
                        </div>
                        @if ( session('mensaje') )
                            <div class="container-edits" style="margin-top: 2%">
                                <div class="alert alert-success" class='message' id='message'>{{ session('mensaje') }}</div>
                            </div>
                        @endif
                        @if ( session('mensajeError') )
                            <div class="container-edits" style="margin-top: 2%">
                                <div class="alert alert-danger" class='message' id='message'>{{ session('mensajeError') }}</div>
                            </div>
                    @endif
                        <div class="container-edits">
                            <div class="container btn-group" role="group">
                                <input type="button" class="btn" value="Datos Personales" style="background-color: #0F4C75; color: white" disabled>
                            </div>
                            <!--TABLES-->
                            <form class="form-edits" id="from" style="margin-bottom: 2% !important;">
                                @csrf
                                <table class="table-responsive table-card-inline" id="tAdmin">
                                    <!--TABLA ADMIN-->
                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fas fa-user-tie"></i> Nombre</th>
                                        <td class="td-card">
                                            <input type="text" name="name" id="nameS" class="form-control" readonly value="{{ $sponsor->name }}">
                                        </td>
                                    </tr>
                                    <tr class="tr-card-complete">
                                        <th class="th-card"><i class="fab fa-readme"></i> Descripción</th>
                                        <td class="td-card">
                                            <div class="form-group">
                                                <textarea rows="5" style="background-color: #eff0ee" name="description" id="descriptionS"  class="form-control @error('description') is-invalid @enderror" readonly>{{ $sponsor->description }}</textarea>
                                            </div>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th id='head' class="th-card"><i class="fas fa-clipboard-check"></i> Compañias Asignadas</th>
                                        <td class="td-card">
                                            @foreach ($companies as $company)
                                                @if($company['companyId'] == 1)
                                                    <div class="form-check">
                                                        <input class="form-check-input label-size" type="hidden" name="companies[{{$company['name']}}]" value="{{ $company['companyId'] }}" checked>
                                                    </div>
                                                @else
                                                    <div class="form-check">
                                                        <input class="form-check-input label-size" type="checkbox" name="companies[{{$company['name']}}]" value="{{ $company['companyId'] }}" disabled checked>
                                                        <label class="form-check-label label-size" for="defaultCheck1">{{ $company['name'] }}</label>
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
                                        <th class="th-card"><i class="fas fa-link"></i> Link</th>
                                        <td class="td-card">
                                            <input type="text" name="lastName" id="linkS"  class="form-control" readonly value="{{ $sponsor->link }}">
                                        </td>
                                    </tr>
                                    <tr id="tr-image" style="display: none">
                                        <th class="th-card">
                                            <i class="far fa-file-image"></i> Imagen (formato .png)
                                        </th>
                                        <td class="td-card">
                                            <input type="file" name="image" id="file" class="adjust-file form-control @error('image') is-invalid @enderror" />
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th id='head' class="th-card"><i class="fas fa-check-circle"></i> Mostrar en Inicio</th>
                                        <td class="td-card">
                                            <div class="form-check">
                                                <input class="form-check-input label-size" type="checkbox" name="show" value="1" disabled checked>
                                                <label class="form-check-label label-size" for="defaultCheck1">Si</label>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <div id="buttContainer">
                                <div class='container'>
                                    <a href="{{ route('EditSponsor', $sponsor->sponsorId) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar</a>
                                    <button class="btn btn-danger" id="eliminar" data-toggle="modal" data-target="#DeleteModal"><i class="fas fa-trash"></i> Eliminar Patrocinador</button>
                                </div>
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
