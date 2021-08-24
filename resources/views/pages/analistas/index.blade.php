@extends('layouts.app')

@section('content')
<div class="layoutContainer">
    <div class="container mb-4">
        <div class="row">

            <div class="col text-center btn-hover">
                <a class="selected btn btns-grid border-light btn-layout btn-grid">
                    <div><i class="material-icons" style="vertical-align: bottom">
                            insert_chart_outlined
                        </i></div>
                    <div>Lista de Pruebas</div>
                </a>
            </div>

            <div class="col text-center btn-hover">
                <a href="{{ url('/areas') }}" class="btn btns-grid border-light btn-layout btn-grid">
                    <div><i class="material-icons" style="vertical-align: bottom;">
                            show_chart
                        </i></div>
                    <div>Lista de Areas</div>
                </a>
            </div>

            <div class="col text-center btn-hover">
                <a href="{{route('analistaViewResults',$areas[0]['areaId'])}}" class="btn btns-grid border-light btn-layout btn-grid">
                    <div><i class="material-icons" style="vertical-align: bottom;">
                            bar_chart
                        </i></div>
                    <div>Ver Resultados</div>
                </a>
            </div>

        </div>
    </div>
</div>

<div class="col text-center btn-hover2">
    <a target="_blank" href="{{ URL::to('/') }}/files/manualAnalist.pdf" class="btn btn-primary">
        <div class="button-2 fix-0">
            <div><i class="material-icons" style="vertical-align: bottom;">
                    get_app
                </i></div>
            <div>Manual de Usuario</div>
        </div>
    </a>
</div>

<div class="container">
    @if ( session('mensaje') )
        <div class="container-edits" style="margin-top: 2%">
            <div class="alert alert-success" class='message' id='message'>{{ session('mensaje') }}</div>
        </div>
    @endif
    <div data-simplebar class="table-responsive table-height" style="height: 800px !important;">
    <div class="col text-center">
        <table class="table table-striped table-bordered mydatatable">
            <thead class="table-header" style="background: #1b4b72;">
            <tr>
                <th class="" scope="col" style="text-transform: uppercase">NOMBRE DEL ÁREA</th>
                <th class="" scope="col" style="text-transform: uppercase">usuario asignado</th>
                <th class="" scope="col" style="text-transform: uppercase">NOMBRE DE LA PRUEBA</th>
                <th class="" scope="col" style="text-transform: uppercase">NOMBRE DEL CONCEPTO</th>
                <th class="" scope="col" style="text-transform: uppercase">IR A LA PRUEBA</th>
            </tr>
            </thead>
            <tbody>
            @foreach((array)$concepts as $concept)
                <tr>
                    <td class="td" style="font-size: large">{{$concept->areaName}}</td>
                    <td class="td" style="font-size: large">{{$concept->username}}</td>
                    <td class="td" style="font-size: large">{{$concept->testName}}</td>
                    <td class="td" style="font-size: large">{{$concept->description}}</td>
                    <td class="td">
                        <a href="{{route('analistaTest',[$concept->testId,$concept->conceptId])}}"
                           class="btn-table btn btn-short"> Ver <i class="far fa-folder-open"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot class="table-footer" style="background: #1b4b72;">
            <tr>
                <th class="" scope="col" style="text-transform: uppercase">NOMBRE DEL ÁREA</th>
                <th class="" scope="col" style="text-transform: uppercase">usuario asignado</th>
                <th class="" scope="col" style="text-transform: uppercase">NOMBRE DE LA PRUEBA</th>
                <th class="" scope="col" style="text-transform: uppercase">NOMBRE DEL CONCEPTO</th>
                <th class="" scope="col" style="text-transform: uppercase">IR A LA PRUEBA</th>
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
