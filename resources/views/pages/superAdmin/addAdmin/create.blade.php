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
        <div data-simplebar class="card-height-add-admin">
            <div class="col text-center">
                <div class="justify-content-center">
                    <div class="card card-add-company">

                        <div class="card-header card-header-cute">
                            <h4 class="no-bottom" style="text-transform: uppercase">Agregar Administrador</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="/CreateAdmin/superAdmin">
                                @csrf
                                <table class="table-responsive table-card-inline">

                                    <tr class="tr-card-complete">
                                        <th class="th-card">
                                            <i class="fas fa-file-signature"></i> Nombres
                                        </th>
                                        <td class="td-card"> <input name="firstName" type="text"
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
                                        <th class="th-card">
                                            <i class="fas fa-file-signature"></i> Apellidos
                                        </th>
                                        <td class="td-card"> <input name="lastName" type="text"
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
                                        <th class="th-card">
                                            <i class="fas fa-user"></i> Nombre de Usuario
                                        </th>
                                        <td class="td-card"> <input name="username" type="text"
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
                                        <th class="th-card">
                                            <i class="fas fa-envelope-square"></i> Correo Electrónico
                                        </th>
                                        <td class="td-card"> <input name="email" type="email"
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
                                        <th class="th-card">
                                            <i class="fas fa-key"></i> Contraseña
                                        </th>
                                        <td class="td-card"> <input name="password" type="password"
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
                                        <th class="th-card">
                                            <i class="fas fa-lock"></i> Confirmar Contraseña
                                        </th>
                                        <td class="td-card"> <input name="password_confirmation" type="password" id="password-confirm"
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
                                        <th for="inputGroupSelect01" class="th-card">
                                            <i class="fas fa-address-card"></i> Empresa Asignada
                                        </th>
                                        <td class="td-card"> <select name="companyId" type="text" class="custom-select  @error('companyId') is-invalid @enderror">
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

                                <div class="container">
                                    <button type="submit" class="button-size-08 btn btn-add btn-primary">Agregar Datos</button>
                                </div>

                                <div class="container">
                                    @include('errors')
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
