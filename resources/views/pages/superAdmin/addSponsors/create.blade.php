@extends('layouts.app', ['activePage' => 'SuperAddSponsors', 'titlePage' => __('Añadir Patrocinador')])

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
                            <h4 class="card-title text-white">Agregar Patrocinador</h4>
                            <p class="card-category">Ingresa los datos necesarios para añadir un nuevo patrocinador al sistema.</p>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="/superAdmin/addSponsors/create" enctype="multipart/form-data">
                                @csrf
                                <table class="table-responsive table-card-inline" style="width: fit-content !important;; margin: auto">

                                    <tr>
                                        <th class="th-card pr-1">
                                            <span class="material-icons" style="vertical-align: sub">drive_file_rename_outline</span> Nombre del patrocinador
                                        </th>
                                        <td class="td-card pl-1"> <input name="name" type="text"
                                                                    class="form-control  @error('name') is-invalid @enderror"
                                                                    placeholder="Ingresa el nombre" aria-label="name"
                                                                    aria-describedby="basic-addon1" required autocomplete="name" autofocus
                                                                    value={{Request::old('name')}}>
                                        </td>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </tr>

                                    <tr>
                                        <th class="th-card pr-1">
                                            <span class="material-icons" style="vertical-align: sub">description</span> Descripción sobre el patrocinador
                                        </th>
                                        <td class="td-card pl-1">
                                            <div class="form-group">
                                                <textarea name="description" rows="5" style="background-color: #eff0ee"
                                                          class="form-control  @error('description') is-invalid @enderror"
                                                          placeholder="Ingresa la descripción" aria-label="description"
                                                          aria-describedby="basic-addon1" required autocomplete="description" autofocus
                                                          value={{Request::old('description')}}>
                                                </textarea>
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
                                                            <input class="form-check-input" type="checkbox" name="companies[{{$company['name']}}]" value="{{ $company['companyId'] }}">
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

                                    <tr>
                                        <th class="th-card pr-1">
                                            <span class="material-icons" style="vertical-align: sub">link</span> Link a su sitio WEB
                                        </th>
                                        <td class="td-card pl-1"> <input name="link" type="text"
                                                                    class="form-control @error('description') is-invalid @enderror"
                                                                    placeholder="Ingresa el link" aria-label="link"
                                                                    aria-describedby="basic-addon1" required autocomplete="link" autofocus
                                                                    value={{Request::old('link')}}>
                                            @error('link')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="th-card pr-1">
                                            <span class="material-icons" style="vertical-align: sub">image</span> Imagen del patrocinador (formato .png)
                                        </th>
                                        <td class="td-card pl-1">
                                            <input type="file" name="image" id="file" class="adjust-file form-control @error('image') is-invalid @enderror" required />
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
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="show" value="1">
                                                    Si
                                                    <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>

                                </table>

                                <div class="container text-center mt-3">
                                    <button type="submit" class="btn btn-primary">Agregar Datos</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
