<div class="modal fade --" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal id="modalFuncionRegister">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Registrar Funcion
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formFuncionRegister" method="POST" action="{{ route('funcions.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="text-dark" for="parte_id">Seleccione el parte</label>
                                <select class="custom-select form-control" name="parte_id" tag="parte_id">
                                    @foreach ($partes as $item)
                                    <option value="{{$item->id}}"> {{$item->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark"> Nombre </label>
                                <textarea type="text" class="form-control" name="nombre" placeholder="Nombre"></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark">Descripción </label>
                                <textarea type="text" class="form-control" name="descripcion" placeholder=""></textarea>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-info " id="btnSaveFuncion" value="Enviar">
                                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>