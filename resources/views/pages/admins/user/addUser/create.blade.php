@extends('layouts.app', ['activePage' => 'AdminAddUsers', 'titlePage' => __('Añadir Usuario')])

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
                            <h4 class="card-title text-white">Agregar Usuario</h4>
                            <p class="card-category">Ingresa los datos necesarios para añadir un nuevo usuario a la compañia.</p>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="/admins/user/index">
                            @csrf
                                <table class="table-responsive table-card-inline" style="width: fit-content !important; height: 350px !important; margin: auto !important;">
                                    <tr>
                                        <th class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">badge</span> Nombre de Usuario
                                        </th>
                                        <td class="td-card pl-1"> <input type="text"
                                                class="form-control @error('username') is-invalid @enderror"
                                                name="username" value="{{ old('username') }}" required
                                                autocomplete="username" autofocus>
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th id="address" class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">pin</span>Contraseña</th>
                                        <td class="td-card pl-1"> <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th id="address" class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">lock</span>Confirmar Contraseña
                                        <td class="td-card pl-1"> <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password">
                                            @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th id="email" class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">email</span> Correo Electrónico</th>
                                        <td class="td-card pl-1"> <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th id="firstName" class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">assignment_ind</span> Nombre</th>
                                        <td class="td-card pl-1"> <input id="firstName" type="text"
                                                class="form-control @error('firstName') is-invalid @enderror"
                                                name="firstName" value="{{ old('firstName') }}" required
                                                autocomplete="firstName" autofocus>
                                            @error('firstName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th id="lastName" class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">assignment_ind</span> Apellido</th>
                                        <td class="td-card pl-1"> <input id="lastName" type="text"
                                                class="form-control @error('lastName') is-invalid @enderror"
                                                name="lastName" value="{{ old('lastName') }}" required
                                                autocomplete="lastName" autofocus>
                                            @error('lastName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th for="inputGroupSelect01" class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">radar</span> Rol Asignado</th>
                                        <td class="td-card pl-1"> <select type='text' required id="role"
                                                class="custom-select @error('role') is-invalid @enderror" name="role">
                                                <option disabled selected>Selecciona el rol
                                                </option>
                                                @foreach($roles as $role)
                                                @if($role->id == 3 || $role->id == 4)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th id='head' class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">account_tree</span> Áreas Asignadas</th>
                                        <td class="td-card pl-1">
                                                @foreach ($areas as $area)
                                                    @if ($area['companyId'] = $userCompany)
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox" name="areas[{{$area['name']}}]" value="{{ $area['areaId'] }}">
                                                            {{ $area['name'] }}
                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    @endif
                                                @endforeach
                                            @error('area')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
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
