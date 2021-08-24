@extends('layouts.app')

@section('content')
    @php($count=1)
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
                    <a class="selected btn border-light btn-layout btn-grid btns-grid" disabled>
                        <div><i class="material-icons">format_list_numbered</i></div>
                        <div>Lista de Patrocinadores</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @if ( session('mensajeError') )
        <div class="container-edits" style="margin-top: 2%">
            <div class="alert alert-warning" class='message' id='message'>{{ session('mensajeError') }}</div>
        </div>
    @endif
    <div class="col text-center btn-hover2">
        <a href="{{url('/superAdmin/addSponsors/create')}}" class="btn btn-primary">
            <div><i class="material-icons">note_add</i></div>
            <div>Añadir de Patrocinador</div>
        </a>
    </div>
    <div class="container">
        <div data-simplebar class="table-responsive table-height">
            <div class="col text-center">
                <table class="table table-striped table-bordered mydatatable">
                    <thead class="table-header">
                    <tr>
                        <td class=''>Imagen</td>
                        <td class=''>Nombre</td>
                        <td class=''>Descripción</td>
                        <td class=''>Link</td>
                        <td class=''>Acción</td>
                    </tr>
                    </thead>
                    <tbody class="">
                    @foreach($sponsors as $sponsor)
                            <tr>
                                <td class="td td-center"><img src="{{ URL::to('/') }}/sponsors/{{ $sponsor->image }}" class="img-thumbnail" width="75" /></td>
                                <td class="td td-center">{{$sponsor -> name}}</td>
                                <td class="td td-center">{{substr($sponsor->description, 0, 115)}}...</td>
                                <td class="td td-center">{{$sponsor -> link}}</td>
                                <td class="td td-center">
                                    <a href="{{ route('ShowSponsor', $sponsor->sponsorId) }}" class="btn-row btn btn-info"><i class="fas fa-bookmark"></i> Mostrar</a>
                                    <a href="{{ route('EditSponsor', $sponsor->sponsorId) }}" class="btn-row btn btn-warning"><i class="fas fa-edit"></i> Editar</a>
                                </td>
                            </tr>
                    @endforeach
                    <tfoot class="table-footer">
                    <tr>
                        <td class=''>Imagen</td>
                        <td class=''>Nombre</td>
                        <td class=''>Descripción</td>
                        <td class=''>Link</td>
                        <td class=''>Ver</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <script>
        $('.mydatatable').DataTable();
    </script>
@endsection
