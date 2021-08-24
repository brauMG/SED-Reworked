@extends('layouts.app')

@section('content')
@if(empty($tests))
    <div class="container">
        <div class="row justify-content-center">
            <h1>Por el momento no tienes ninguna prueba asignada, contacta a tu administrador para que se asigne una.</h1>
        </div>
    </div>
    @else

    <div class="col text-center btn-hover2">
        <a target="_blank" href="{{ URL::to('/') }}/files/manual.pdf" class="btn btn-primary">
            <div class="button-2 fix-0">
                <div><i class="material-icons" style="vertical-align: bottom;">
                        get_app
                    </i></div>
                <div>Manual de Usuario</div>
            </div>
        </a>
    </div>

    <div class="container">
        <div data-simplebar class="table-responsive table-height" style="height: 935px !important;">
            <div class="col text-center">
                <table class="table table-striped table-bordered mydatatable">
                    <thead class="table-header" style="background: #1b4b72;">
                    <tr>
                        <th class="" scope="col" style="text-transform: uppercase">área</th>
                        <th class="" scope="col" style="text-transform: uppercase">NOMBRE DE LA PRUEBA</th>
                        <th class="" scope="col" style="text-transform: uppercase">NOMBRE DEL CONCEPTO</th>
                        <th class="" scope="col" style="text-transform: uppercase">fecha de asignación</th>
                        <th class="" scope="col" style="text-transform: uppercase">VER PRUEBA</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach((array)$concepts as $concept)
                        <tr>
                            <td class="td" style="font-size: large">{{$concept->areaName}}</td>
                            @foreach((array)$tests as $test)
                                @if($test['testId'] == $concept->testId)
                                    <td class="td" style="font-size: large">{{$test['name']}}</td>
                                @endif
                            @endforeach
                                <td class="td" style="font-size: large">{{$concept->description}}</td>
                                <td class="td" style="font-size: large">{{$concept->date}}</td>
                                <td class="td">
                                <a href="{{route('comunTest',[$concept->testId,$concept->conceptId])}}" class="Button_See btn"> Ver </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot class="table-footer" style="background: #1b4b72;">
                    <tr>
                        <th class="" scope="col" style="text-transform: uppercase">área</th>
                        <th class="" scope="col" style="text-transform: uppercase">NOMBRE DE LA PRUEBA</th>
                        <th class="" scope="col" style="text-transform: uppercase">NOMBRE DEL CONCEPTO</th>
                        <th class="" scope="col" style="text-transform: uppercase">fecha de asignación</th>
                        <th class="" scope="col" style="text-transform: uppercase">VER PRUEBA</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @endif
<script>
    $('.mydatatable').DataTable();
</script>
@endsection
