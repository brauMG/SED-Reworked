@extends('layouts.app', ['activePage' => 'SuperAddSponsors', 'titlePage' => __('Editar Patrocinador')])

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
                            <h4 class="card-title text-white">Editar Registro de Patrocinador</h4>
                            <p class="card-category">Realiza los cambios de datos necesarios para editar al patrocinador.</p>
                        </div>

                        <div class="card-body">
                            <form class="form" id="from" method="POST" action="{{ route('UpdateSponsor',[$sponsor->sponsorId]) }}" style="margin-bottom: 2% !important;" enctype="multipart/form-data">
                                @csrf
                                <table class="table-responsive table-card-inline" style="width: fit-content !important;; margin: auto" id="tAdmin">
                                        <!--TABLA ADMIN-->
                                        <tr>
                                            <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">drive_file_rename_outline</span> Nombre</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="name" id="nameS" class="form-control @error('name') is-invalid @enderror" value="{{ $sponsor->name }}" required>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr class="tr-card-complete">
                                            <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">description</span> Descripción</th>
                                            <td class="td-card pl-1">
                                                <div class="form-group">
                                                    <textarea rows="5" style="background-color: #eff0ee" name="description" id="descriptionS"  class="form-control @error('description') is-invalid @enderror" required>{{ $sponsor->description }}</textarea>
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
                                                @foreach ($array_companies as $company)
                                                    @if($company['companyId'] == 1)
                                                        <div class="form-check">
                                                            <input class="form-check-input label-size" type="hidden" name="companies[{{$company['name']}}]" value="{{ $company['companyId'] }}" checked>
                                                        </div>
                                                    @else
                                                        @if ($company['valid'])
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox" name="companies[{{$company['name']}}]" value="{{ $company['companyId'] }}" checked>
                                                                    {{ $company['name'] }}
                                                                    <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                                </label>
                                                            </div>
                                                        @else
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox" name="companies[{{$company['name']}}]" value="{{ $company['companyId'] }}">
                                                                    {{ $company['name'] }}
                                                                    <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                                </label>
                                                            </div>
                                                        @endif
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
                                            <th class="th-card pr-1"> <span class="material-icons" style="vertical-align: sub">link</span> Link</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="link" id="linkS"  class="form-control @error('link') is-invalid @enderror" value="{{ $sponsor->link }}" required>
                                                @error('link')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr id="tr-image">
                                            <th class="th-card pr-1">
                                                <span class="material-icons" style="vertical-align: sub">image</span> Imagen (formato .png)
                                            </th>
                                            <td class="td-card pl-1">
                                                <input class="adjust-file2 form-control @error('image') is-invalid @enderror" type="file" name="image" />
                                                <div class="container">
                                                <img src="{{ URL::to('/') }}/sponsors/{{ $sponsor->image }}" class="img-thumbnail" width="100" />
                                                    <input type="hidden" name="hidden_image" value="{{ $sponsor->image }}" />
                                                </div>
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
                                                    @if($sponsor['show'] == true)
                                                        <input class="form-check-input label-size" type="checkbox" name="show" value="1" checked>
                                                    @else
                                                        <input class="form-check-input label-size" type="checkbox" name="show" value="1">
                                                    @endif
                                                    <label class="form-check-label label-size" for="defaultCheck1">Si</label>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                <div class='container text-center mt-3'>
                                    <input type="submit" class="btn btn-warning" value="Guardar Cambios">
                                    <a href="{{route('CancelSponsor')}}" class="btn btn-primary"> Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
