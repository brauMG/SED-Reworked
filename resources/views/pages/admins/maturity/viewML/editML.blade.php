@extends('layouts.app', ['activePage' => 'AdminAddML', 'titlePage' => __('Editar Niveles de Madurez')])

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
                            <h4 class="card-title text-white">Editar Registro de Niveles de  Madurez</h4>
                            <p class="card-category">Realiza los cambios de datos necesarios para editar los niveles de madurez.</p>
                        </div>

                        <div class="card-body">
                            <form class="form" id="from" method="POST" action="{{ route('UpdateML',[$groupId->MLGroupId]) }}" enctype="multipart/form-data" style="margin-bottom: 2% !important;">
                                    @csrf
                                <table class="table-responsive table-card-inline" style="width: fit-content !important;; margin: auto" id="tAdmin">
                                        <tr>
                                            <th class="th-card pr-1"><span style="vertical-align: sub" class="material-icons">badge</span> Nombre del grupo</th>
                                            <td class="td-card pl-1">
                                                <input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" value="{{ $group[0]['name'] }}" required>
                                            </td>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </tr>
                                        @php($count=1)
                                        @foreach ($maturity_levels as $ml)
                                            <tr>
                                                <th class="th-card pr-1"> <span style="vertical-align: sub" class="material-icons">star_rate</span> Nivel {{$count}}</th>
                                                <td class="td-card pl-1">
                                                    <input type="text" name="maturityName[{{ $ml['maturityLevelId'] }}]" class="form-control DescMaturity @error('maturityName') is-invalid @enderror" value="{{ $ml['description']}}" required>
                                                </td>
                                                @error('maturityName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </tr>
                                            @php($count++)
                                        @endforeach
                                    </table>

                                <div class='container text-center mt-3'>
                                    <input type="submit" class="btn btn-warning" value="Guardar Cambios">
                                    <a href="{{route('CancelML')}}" class="btn btn-primary"> Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
