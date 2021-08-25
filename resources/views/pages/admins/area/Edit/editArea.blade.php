@extends('layouts.app', ['activePage' => 'AdminAddAreas', 'titlePage' => __('Editar Area')])

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
                            <h4 class="card-title text-white">Editar Registro de Area</h4>
                            <p class="card-category">Realiza los cambios de datos necesarios para editar el area.</p>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('UpdateArea',[$area->areaId]) }}" id="formEditArea">
                                @method('PUT')
                                @csrf
                                <table class="table-responsive table-card-inline" style="width: fit-content !important;; margin: auto" id="tAdmin">
                                    <tr>
                                        <th class="th-card pr-1" id="name"><span class="material-icons" style="vertical-align: sub">manage_accounts</span> Nombre de Área</th>
                                        <td class="td-card pl-1">
                                            <input type="text" name="name" id="areaEdi" class="form-control" readonly value="{{ $area->name }}">
                                        </td>
                                    </tr>
                                </table>

                                <div class='container text-center mt-3'>
                                    <input type="button" value="Editar" class="btn btn-primary" id="editarA" style="background-color: #25A1F9" onclick="ShowButtonEditArea()">
                                    <input type="button" value="Eliminar" class="btn btn-danger" id="deleteA" style="background-color: #d9534f" onclick="$('#NoteDeleteArea').modal()">
                                    <input type="submit" value="Guardar" class="btn btn-success" id="guardarA" style="display: none;background-color: #5cb85c">
                                    <input type="button" value="Cancelar" class="btn btn-warning" id="cancelarA" style="display:none;background-color: #d9534f;" onclick="EditAreaAD(false)">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
