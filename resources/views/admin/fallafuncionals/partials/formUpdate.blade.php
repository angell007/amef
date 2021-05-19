<div class="modal fade --" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal id="modalFallaFuncionalUpdate">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Actualizar Falla Funcional
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formFallaFuncionalUpdate" method="" action="">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" name="id" id="id">

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Nombre </label>
                                <input type="text" class="form-control"="" name="nombre" placeholder="nombre">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Descripcion </label>
                                <textarea type="text" class="form-control"="" name="descripcion" placeholder=""></textarea>
                            </div>

                            
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-info " id="btnUpdateFallaFuncional" value="Enviar">
                                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
