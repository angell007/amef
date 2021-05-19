<div class="modal fade --" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal id="modalSistemaRegister">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Registrar Sistema
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formSistemaRegister" method="POST" action="{{ route('sistemas.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="form-group col-md-12">
                                <label class="text-dark"> Nombre </label>
                                <textarea type="text" class="form-control" name="nombre" placeholder="Nombre"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="text-dark">Descripción </label>
                                <textarea type="text" class="form-control" name="descripcion" placeholder=""></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-info " id="btnSaveSistema" value="Enviar">
                                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>