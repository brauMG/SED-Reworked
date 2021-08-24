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
                <a class="selected btn border-light btn-layout btn-grid btns-grid" disabled>
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

<div class="col text-center btn-hover2">
    <a href="{{url('CreateCompany/addCompany/create')}}" class="btn btn-primary">
        <div><i class="material-icons">location_city</i></div>
        <div>Añadir Empresa</div>
    </a>
</div>

<div class="container">
    <div data-simplebar class="table-responsive table-height">
        <div class="col text-center">
            <table class="table table-striped table-bordered mydatatable">
                <thead class="table-header">
                    <tr>
                        <td class=''>#</td>
                        <td class=''>ESTADO</td>
                        <td class=''>EMPRESA</td>
                        <td class=''>DIRECCIÓN</td>
                        <td class=''>TELÉFONO</td>
                        <td class=''>CORREO</td>
                        <td class=''>REGISTRO</td>
                    </tr>
                </thead>
		<tbody class="">
		@foreach($Com as $C)
            @if($C->companyId != 1)
			<tr>
				<td class="td-center">{{$count}}</td>
				<td class="td-center">
                    <form class='form'  method="POST" action="{{ route('status',$C->companyId) }}">
                        @method('PUT')
                        @csrf
                        @if ($C->status == 0)
                            <input type="hidden" name="status" style="width: 0px;border:none; " readonly value="1">
                            <input type="submit" value="Deshabilitado" class="btn btn-unavailable" disabled>
                             @endif
                        @if ($C->status != 0)
                            <input type="hidden" name="status" style="width: 0px;border:none; " readonly value="0">
                            <input type="submit" value="Habilitado" class="btn btn-available" disabled>
                        @endif
                    </form>
                </td>
                <td class="td td-center">{{$C -> name}}</td>
                <td class="td td-center">{{$C -> address}}</td>
                <td class="td td-center">{{$C -> phoneNumber}}</td>
                <td class="td td-center">{{$C -> email}}</td>
                <td class="td td-center">
                    <a href="{{ route('ShowCompanySA', $C->companyId) }}" class="btn-row btn btn-info"><i class="fas fa-bookmark"></i> Mostrar</a>
                    <a href="{{ route('EditCompany', $C->companyId) }}" class="btn-row btn btn-warning"><i class="fas fa-edit"></i> Editar</a>
                </td>
			</tr>
            @endif
            @php($count++)
		@endforeach
                <tfoot class="table-footer">
                <tr>
                    <td class=''>#</td>
                    <td class=''>ESTADO</td>
                    <td class=''>EMPRESA</td>
                    <td class=''>DIRECCIÓN</td>
                    <td class=''>TELÉFONO</td>
                    <td class=''>CORREO</td>
                    <td class=''>REGISTRO</td>
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
