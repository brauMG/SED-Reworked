@inject('company', 'App\Services\GetCompany')
<div class="sidebar" data-color="purple" data-background-color="black" data-image="{{ asset('material') }}/img/sidebar-4.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
        <a href="/" class="simple-text logo-normal">
            <strong style="font-size: 24px">{{ $company->get() }}</strong>
            <br>
            <h6 style="color: gray">
            @if(Auth::user()->hasRole('superadmin'))
                Super Administrador
            @elseif(Auth::user()->hasRole('admin'))
                Administrador
            @elseif(Auth::user()->hasRole('analista'))
                Analista
            @elseif(Auth::user()->hasRole('comun'))
                Usuario
            @endif
            <br>
            {{Auth::user()->lastName}}
            </h6>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
                @if(Auth::user()->hasRole('superadmin'))
                <li class="nav-item {{ ($activePage == 'SuperListAdmins' || $activePage == 'SuperAddAdmins') ? ' active' : '' }}">
                    <a class="nav-link collapsed" data-toggle="collapse" href="#admins" aria-expanded="false">
                        <i><img style="width:25px" src="{{ asset('material') }}/img/reporte.svg"></i>
                        <p>{{ __('Administradores') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="admins">
                        <ul class="nav">
                            <li class="nav-item{{ $activePage == 'SuperListAdmins' ? ' active' : '' }}">
                                <a class="nav-link" href="{{url('/superAdmin')}}">
                                    <i class="material-icons text-white">area_chart</i>
                                    <span class="sidebar-normal">{{ __('Lista de Administradores') }} </span>
                                </a>
                            </li>
                            <li class="nav-item{{ $activePage == 'SuperAddAdmins' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ url('CreateAdmin/addAdmin/create') }}">
                                    <i class="material-icons text-white">library_add</i>
                                    <span class="sidebar-normal"> {{ __('Añadir Administrador') }} </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item {{ ($activePage == 'SuperListCompanies' || $activePage == 'SuperAddCompanies') ? ' active' : '' }}">
                    <a class="nav-link collapsed" data-toggle="collapse" href="#companies" aria-expanded="false">
                        <i><img style="width:25px" src="{{ asset('material') }}/img/reporte.svg"></i>
                        <p>{{ __('Empresas') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="companies">
                        <ul class="nav">
                            <li class="nav-item{{ $activePage == 'SuperListCompanies' ? ' active' : '' }}">
                                <a class="nav-link" href="{{url('/superAdmin/viewCompanies/create')}}">
                                    <i class="material-icons text-white">area_chart</i>
                                    <span class="sidebar-normal">{{ __('Lista de Empresas') }} </span>
                                </a>
                            </li>
                            <li class="nav-item{{ $activePage == 'SuperAddCompanies' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ url('/CreateCompany/addCompany/create') }}">
                                    <i class="material-icons text-white">library_add</i>
                                    <span class="sidebar-normal"> {{ __('Añadir Empresa') }} </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item {{ ($activePage == 'SuperListSponsors' || $activePage == 'SuperAddSponsors') ? ' active' : '' }}">
                    <a class="nav-link collapsed" data-toggle="collapse" href="#sponsors" aria-expanded="false">
                        <i><img style="width:25px" src="{{ asset('material') }}/img/reporte.svg"></i>
                        <p>{{ __('Patrocinadores') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="sponsors">
                        <ul class="nav">
                            <li class="nav-item{{ $activePage == 'SuperListSponsors' ? ' active' : '' }}">
                                <a class="nav-link" href="{{url('/superAdmin/viewSponsors/listSponsors')}}">
                                    <i class="material-icons text-white">area_chart</i>
                                    <span class="sidebar-normal">{{ __('Lista de Patrocinadores') }} </span>
                                </a>
                            </li>
                            <li class="nav-item{{ $activePage == 'SuperAddSponsors' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ url('superAdmin/addSponsors/create') }}">
                                    <i class="material-icons text-white">library_add</i>
                                    <span class="sidebar-normal"> {{ __('Añadir Patrocinador') }} </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

                @if(Auth::user()->hasRole('admin'))
                        <li class="nav-item {{ ($activePage == 'AdminListAreas' || $activePage == 'AdminAddAreas') ? ' active' : '' }}">
                        <a class="nav-link collapsed" data-toggle="collapse" href="#admins" aria-expanded="false">
                            <i><img style="width:25px" src="{{ asset('material') }}/img/reporte.svg"></i>
                            <p>{{ __('Áreas') }}
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="admins">
                            <ul class="nav">
                                <li class="nav-item{{ $activePage == 'AdminListArea' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{url('/admin')}}">
                                        <i class="material-icons text-white">area_chart</i>
                                        <span class="sidebar-normal">{{ __('Lista de Áreas') }} </span>
                                    </a>
                                </li>
                                <li class="nav-item{{ $activePage == 'AdminAddArea' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ url('/admins/area/addArea') }}">
                                        <i class="material-icons text-white">library_add</i>
                                        <span class="sidebar-normal"> {{ __('Añadir Área') }} </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                        <li class="nav-item {{ ($activePage == 'AdminListML' || $activePage == 'AdminAddML') ? ' active' : '' }}">
                            <a class="nav-link collapsed" data-toggle="collapse" href="#mls" aria-expanded="false">
                                <i><img style="width:25px" src="{{ asset('material') }}/img/reporte.svg"></i>
                                <p>{{ __('Niveles de Madurez') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="mls">
                                <ul class="nav">
                                    <li class="nav-item{{ $activePage == 'AdminListML' ? ' active' : '' }}">
                                        <a class="nav-link" href="{{url('/admins/maturity/index')}}">
                                            <i class="material-icons text-white">area_chart</i>
                                            <span class="sidebar-normal">{{ __('Lista de Niveles de Madurez') }} </span>
                                        </a>
                                    </li>
                                    <li class="nav-item{{ $activePage == 'AdminAddML' ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ url('/admins/maturity/addML/create') }}">
                                            <i class="material-icons text-white">library_add</i>
                                            <span class="sidebar-normal"> {{ __('Añadir Niveles de Madurez') }} </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item {{ ($activePage == 'AdminListUsers' || $activePage == 'AdminAddUsers') ? ' active' : '' }}">
                            <a class="nav-link collapsed" data-toggle="collapse" href="#users" aria-expanded="false">
                                <i><img style="width:25px" src="{{ asset('material') }}/img/reporte.svg"></i>
                                <p>{{ __('Usuarios') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="users">
                                <ul class="nav">
                                    <li class="nav-item{{ $activePage == 'AdminListUsers' ? ' active' : '' }}">
                                        <a class="nav-link" href="{{url('/admins/user/index')}}">
                                            <i class="material-icons text-white">area_chart</i>
                                            <span class="sidebar-normal">{{ __('Lista de Usuarios') }} </span>
                                        </a>
                                    </li>
                                    <li class="nav-item{{ $activePage == 'AdminAddUsers' ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ url('/addUser/create') }}">
                                            <i class="material-icons text-white">library_add</i>
                                            <span class="sidebar-normal"> {{ __('Añadir Usuario') }} </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item {{ ($activePage == 'AdminListTests' || $activePage == 'AdminAddTests') ? ' active' : '' }}">
                            <a class="nav-link collapsed" data-toggle="collapse" href="#tests" aria-expanded="false">
                                <i><img style="width:25px" src="{{ asset('material') }}/img/reporte.svg"></i>
                                <p>{{ __('Pruebas') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="tests">
                                <ul class="nav">
                                    <li class="nav-item{{ $activePage == 'AdminListTests' ? ' active' : '' }}">
                                        <a class="nav-link" href="{{url('/admins/area/test/listTest')}}">
                                            <i class="material-icons text-white">area_chart</i>
                                            <span class="sidebar-normal">{{ __('Lista de Pruebas') }} </span>
                                        </a>
                                    </li>
                                    <li class="nav-item{{ $activePage == 'AdminAddTests' ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ url('/admins/area/test/create') }}">
                                            <i class="material-icons text-white">library_add</i>
                                            <span class="sidebar-normal"> {{ __('Añadir Prueba') }} </span>
                                        </a>
                                    </li>
                                    <li class="nav-item{{ $activePage == 'AdminDubTests' ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ url('/admins/area/test/duplicate') }}">
                                            <i class="material-icons text-white">edit</i>
                                            <span class="sidebar-normal"> {{ __('Duplicar Prueba') }} </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item{{ $activePage == 'AdminListLog' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ url('/admins/history') }}">
                                <i class="material-icons text-white">pending_actions</i>
                                <p>{{ __('Historial') }}</p>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'AdminListResults' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ url('/admin/viewResults/1') }}">
                                <i class="material-icons text-white">analytics</i>
                                <p>{{ __('Ver Resultados') }}</p>
                            </a>
                        </li>
                @endif

                    @if(Auth::user()->hasRole('analista'))
                        <li class="nav-item{{ $activePage == 'AnListTest' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ url('/analista') }}">
                                <i class="material-icons text-white">pending_actions</i>
                                <p>{{ __('Lista de Pruebas') }}</p>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'AnListAreas' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ url('/areas') }}">
                                <i class="material-icons text-white">pending_actions</i>
                                <p>{{ __('Lista de Áreas') }}</p>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'AnListResults' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ url('/analista/viewResults/1') }}">
                                <i class="material-icons text-white">analytics</i>
                                <p>{{ __('Ver Resultados') }}</p>
                            </a>
                        </li>
                    @endif

                    @if(Auth::user()->hasRole('comun'))
                        <li class="nav-item{{ $activePage == 'Tests' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ url('/comun') }}">
                                <i class="material-icons text-white">pending_actions</i>
                                <p>{{ __('Pruebas') }}</p>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item{{ $activePage == 'language' ? ' active' : '' }}">
                <a class="nav-link text-white bg-dark" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="material-icons text-white">logout</i>
                    <p>{{ __('Cerrar Sesión') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
<script type="text/javascript">
    function ChangeCompany() {
        $('#myModal').load( '{{ url('/companias/selectCompany') }}',function(response, status, xhr)
        {
            if (status == "success")
                $('#myModal').modal('show');
        });
    }
</script>
