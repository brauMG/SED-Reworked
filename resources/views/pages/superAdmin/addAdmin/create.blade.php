@extends('layouts.app', ['activePage' => 'SuperAddAdmins', 'titlePage' => __('Añadir Administrador')])

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
                            <h4 class="card-title text-white">Agregar Administrador</h4>
                            <p class="card-category">Ingresa los datos necesarios para añadir un nuevo administrador al sistema.</p>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="/CreateAdmin/superAdmin">
                                @csrf
                                <table class="table-responsive table-card-inline" style="width: fit-content !important;; margin: auto">
                                    <tr>
                                        <th class="th-card pr-1">
                                            <span class="material-icons" style="vertical-align: sub">badge</span> Nombres
                                        </th>
                                        <td class="td-card pl-1"> <input name="firstName" type="text"
                                                                    class="form-control  @error('firstName') is-invalid @enderror"
                                                                    placeholder="Ingresa tus nombres" aria-label="firstName"
                                                                    aria-describedby="basic-addon1" required autocomplete="firstName" autofocus
                                                                    value={{Request::old('firstName')}}>
                                        </td>
                                        @error('firstName')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </tr>

                                    <tr>
                                        <th class="th-card pr-1">
                                            <span class="material-icons" style="vertical-align: sub">badge</span> Apellidos
                                        </th>
                                        <td class="td-card pl-1"> <input name="lastName" type="text"
                                                                    class="form-control  @error('lastName') is-invalid @enderror"
                                                                    placeholder="Ingresa tus apellidos" aria-label="lastName"
                                                                    aria-describedby="basic-addon1" required autocomplete="lastName" autofocus
                                                                    value={{Request::old('lastName')}}>
                                            @error('lastName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="th-card pr-1">
                                            <span class="material-icons" style="vertical-align: sub">account_box</span> Nombre de Usuario
                                        </th>
                                        <td class="td-card pl-1"> <input name="username" type="text"
                                                                    class="form-control  @error('username') is-invalid @enderror"
                                                                    placeholder="Ingresa tu nombre de usuario" aria-label="username"
                                                                    aria-describedby="basic-addon1" required autocomplete="username" autofocus
                                                                    value={{Request::old('username')}}>
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="th-card pr-1">
                                            <span class="material-icons" style="vertical-align: sub">mark_email_read</span> Correo Electrónico
                                        </th>
                                        <td class="td-card pl-1"> <input name="email" type="email"
                                                                    class="form-control  @error('email') is-invalid @enderror"
                                                                    placeholder="Ingresa tu correo electrónico" aria-label="email"
                                                                    aria-describedby="basic-addon1" required autocomplete="email" autofocus
                                                                    value={{Request::old('email')}}>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="th-card pr-1">
                                            <span class="material-icons" style="vertical-align: sub">enhanced_encryption</span> Contraseña
                                        </th>
                                        <td class="td-card pl-1"> <input name="password" type="password"
                                                                    class="form-control  @error('password') is-invalid @enderror"
                                                                    placeholder="Ingresa una contraseña" aria-label="password"
                                                                    aria-describedby="basic-addon1" required autocomplete="password" autofocus
                                                                    value={{Request::old('password')}}>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="th-card pr-1">
                                            <span class="material-icons" style="vertical-align: sub">enhanced_encryption</span> Confirmar Contraseña
                                        </th>
                                        <td class="td-card pl-1"> <input name="password_confirmation" type="password" id="password-confirm"
                                                                    class="form-control  @error('password-confirmation') is-invalid @enderror"
                                                                    placeholder="Confirma tu contraseña" required autocomplete="new-password">
                                            @error('password-confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <th for="inputGroupSelect01" class="th-card pr-1">
                                            <span class="material-icons" style="vertical-align: sub">business</span> Empresa Asignada
                                        </th>
                                        <td class="td-card pl-1"> <select name="companyId" type="text" class="custom-select  @error('companyId') is-invalid @enderror">
                                                <option disabled selected>Selecciona la empresa...</option>
                                                @php($count=0)

                                                @foreach($companies as $company)
                                                    @if ($company->companyId !=1)
                                                        <option value="{{ $company->companyId }}">{{ $company->name }}</option>
                                                    @endif
                                                    @php($count++)
                                                @endforeach

                                                @if($count ==1)
                                                    <option disabled selected>No hay empresas</option>
                                                @endif
                                            </select>
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
