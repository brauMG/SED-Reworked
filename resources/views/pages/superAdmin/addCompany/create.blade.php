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

    <div class="container">
        <div data-simplebar class="card-height-add-company">
            <div class="col text-center">
                <div class="justify-content-center">
                    <div class="card card-add-company">

                        <div class="card-header card-header-cute">
                            <h4 class="no-bottom" style="text-transform: uppercase">Agregar Compañia</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/CreateCompany/superAdmin">
                                @csrf

                                <table class="table-responsive table-card-inline">
                                        <tr class="tr-card-complete">
                                            <th class="th-card">
                                                <i class="fas fa-file-signature"></i> Nombre
                                            </th>
                                                <td class="td-card"> <input name="name" type="text"
                                                        class="form-control  @error('name') is-invalid @enderror"
                                                        placeholder="Nombre de la empresa" aria-label="Nombre"
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
                                        <th class="th-card"><i class="fas fa-map-marker-alt"></i> Dirección</th>
                                        <td class="td-card"> <input name="address" type="text"
                                                class="form-control  @error('address') is-invalid @enderror"
                                                placeholder="Dirección de la empresa" aria-label="address"
                                                aria-describedby="basic-addon1" required autocomplete="address" autofocus
                                                value={{Request::old('address')}}>
                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="th-card"><i class="fas fa-phone"></i> Teléfono</th>
                                        <td class="td-card"> <input name="phoneNumber" type="tel"
                                                class="form-control  @error('phoneNumber') is-invalid @enderror"
                                                placeholder="Teléfono de la empresa" aria-label="phoneNumber"
                                                aria-describedby="basic-addon1" required autocomplete="phoneNumber"
                                                autofocus value={{Request::old('phoneNumber')}}>

                                            @error('phoneNumber')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="th-card"><i class="fas fa-envelope-square"></i> Correo electrónico</th>
                                        <td class="td-card">
                                            <input name="email" type="email"
                                                class="form-control  @error('email') is-invalid @enderror"
                                                placeholder="Correo electrónico de la empresa" aria-label="email"
                                                aria-describedby="basic-addon1" required autocomplete="email" autofocus
                                                value={{Request::old('email')}}>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                </table>

                                <div class="container">
                                        <button type="submit" class="button-size-08 btn btn-add btn-primary">Agregar Datos</button>
                                </div>

                            </form>
                            @include('errors')
                        </div>
                    </div>
        </div>
            </div>
        </div>
    </div>

@endsection
