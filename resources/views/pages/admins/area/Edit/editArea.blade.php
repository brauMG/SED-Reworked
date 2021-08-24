@extends('layouts.app')

@section('content')
    <div class="layoutContainer" >
        <div class="container mb-4">
            <div class="row">
                <div class="col text-center btn-hover">
                    <a href="{{url('/admin')}}" class="btn btns-grid border-light btn-layout btn-grid">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    format_list_numbered
                                </i></div>
                            <div>Lista de Áreas</div>
                    </a>
                </div>
                <div class="col text-center btn-hover">
                    <a href="{{ url('/admins/maturity/index') }}" class="btn btns-grid border-light btn-layout btn-grid">
                        <div><i class="material-icons" style="vertical-align: bottom;">
                                format_list_numbered
                            </i></div>
                        <div>Lista de Niveles de Madurez</div>
                    </a>
                </div>
                <div class="col text-center btn-hover">
                    <a href="{{ url('/admins/user/index') }}" class="btn btns-grid border-light btn-layout btn-grid">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    format_list_numbered
                                </i></div>
                            <div>Lista de Usuarios</div>
                    </a>
                </div>
                <div class="col text-center btn-hover">
                    <a href="{{url('/admins/area/test/listTest')}}" class="btn btns-grid border-light btn-layout btn-grid">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    format_list_numbered
                                </i></div>
                            <div>Lista de Pruebas</div>
                    </a>
                </div>
                <div class="col text-center btn-hover">
                    <a href="{{url('/admins/history')}}" class="btn btns-grid border-light btn-layout btn-grid">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    history
                                </i></div>
                            <div>Historial</div>
                    </a>
                </div>
                @if(empty($areas))
                    <div class="col text-center btn-hover">
                        <a href="" class="btn btns-grid border-light btn-layout btn-grid">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    remove_red_eye
                                </i></div>
                            <div>Ver Resultados</div>
                        </a>
                    </div>

                @else
                    <div class="col text-center btn-hover">
                        <a href="{{route('adminViewResults',$areas[0]->areaId)}}" class="btn btns-grid border-light btn-layout btn-grid">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    remove_red_eye
                                </i></div>
                            <div>Ver Resultados</div>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div id="editArea" class="container">
        <div data-simplebar class="card-height-add-admin">
            <div class="col text-center">
            <section class="addArea">
                <div class="justify-content-center">
                    <div class="card card-add-company">

                        <div class="card-header card-header-cute">
                            <h4 class="no-bottom" style="text-transform: uppercase">Registro de Área</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('UpdateArea',[$area->areaId]) }}" id="formEditArea">
                                @method('PUT')
                                @csrf
                                <table class="table-responsive table-card-inline" id="tAdmin">
                                    <tr class="tr-card-complete">
                                        <th class="th-card" id="name"><i class="fas fa-file-signature"></i> Nombre de Área</th>
                                        <td class="td-card">
                                            <input type="text" name="name" id="areaEdi" class="form-control" readonly value="{{ $area->name }}">
                                        </td>
                                    </tr>
                                </table>

                                <div id="buttContainer" class="container">
                                    <div class='bttns'>
                                        <input type="button" value="Editar" class="btn Button_Edit bttn" id="editarA" style="background-color: #25A1F9" onclick="ShowButtonEditArea()">
                                        <input type="button" value="Eliminar" class="btn Button_Edit bttn" id="deleteA" style="background-color: #d9534f" onclick="$('#NoteDeleteArea').modal()">
                                        <input type="submit" value="Guardar" class="btn Button_Edit bttn" id="guardarA" style="display: none;background-color: #5cb85c">
                                        <input type="button" value="Cancelar" class="btn Button Edit bttn" id="cancelarA" style="display:none;background-color: #d9534f;" onclick="EditAreaAD(false)">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            </div>
        </div>
    </div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="ModalareaE">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background-color: green;color: white;" >
      <div class="modal-header " >
        <h5 class="modal-title"  id="exampleModalLongTitle">Actualizar cambios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div style="background-color: white;color: black;">
           <center>
             <div class="modal-body" >
                ¿Desea actualizar los datos del Area?
              </div>
              <div class="update" style="display: none;"><br><h1>Actualizando datos ...</h1></div>
              <div class="spinner-border m-5" role="status" style="display: none;">
                  <span class="sr-only">Loading...</span>
              </div>
        </center>
      </div>

      <div class="modal-footer" style="background-color: white;color: black;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="EditAreaAD(true)">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal show" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="NoteDeleteArea">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title"  id="exampleModalLongTitle">Elminación de Área</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div style="background-color: white;color: black;">
           <center>
                 <div class="modal-body">
                    ¿Desea eliminar esta área?
                  </div>
                  <div class="update" style="display: none;"><br><h1>Actualizando datos ...</h1></div>
                  <div class="spinner-border m-5" role="status" style="display: none;">
                      <span class="sr-only">Cargando...</span>
                  </div>
            </center>
       </div>
      <div class="modal-footer" style="background-color: white;color: black;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="window.location='{{ route('DeleteArea',$area->areaId) }}'">Aceptar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="errorDataArea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #D9534F;color: white;">
        <h5 class="modal-title" id="exampleModalLongTitle">¡ERROR!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Necesita llenar todos los campos de forma adecuada.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
