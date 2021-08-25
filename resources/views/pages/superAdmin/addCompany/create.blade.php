@extends('layouts.app', ['activePage' => 'SuperAddCompanies', 'titlePage' => __('Añadir Empresa')])

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
                            <h4 class="card-title text-white">Agregar Empresa</h4>
                            <p class="card-category">Ingresa los datos necesarios para añadir una nueva empresa al sistema.</p>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="/CreateCompany/superAdmin">
                                @csrf

                                <table class="table-responsive table-card-inline" style="width: fit-content !important;; margin: auto">
                                        <tr>
                                            <th class="th-card pr-1">
                                                <span class="material-icons" style="vertical-align: sub">contact_mail</span> Nombre
                                            </th>
                                                <td class="td-card pl-1"> <input name="name" type="text"
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
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">import_contacts</span> Dirección</th>
                                        <td class="td-card pl-1"> <input name="address" type="text"
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
                                        <th class="th-card pr-1"><span class="material-icons" style="vertical-align: sub">call</span> Teléfono</th>
                                        <td class="td-card pl-1"> <input name="phoneNumber" type="tel"
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
                                        <th class="th-card pr-1">
                                            <span class="material-icons" style="vertical-align: sub">mark_email_read</span> Correo electrónico</th>
                                        <td class="td-card pl-1">
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

                                <div class="container my-3 text-center">
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
