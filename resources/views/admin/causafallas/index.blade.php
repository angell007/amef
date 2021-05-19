@extends('layouts.app')
@section('content')

<div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

    <a href="javascript:history.back()" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title=""
        data-original-title="Regresar">
        <i class="fa fa-reply text-info"></i>
    </a>

    <a href="javascript:void(0)" class="tooltip-wrapper" data-toggle="modal" data-placement="top"
        data-target="#modalCausaFallaRegister" title="Registrar">
        <i class="fa fa-edit btn btn-icon text-success"></i>
    </a>

    <h5 class="m-2">
        <i class="fa fa-group"></i> Causas de Falla
    </h5>

</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="export-table-wrapper table-responsive">
                    <table class="table table-bordered " style="color:black" id="dataTableCausaFalla" width="100%" cellspacing="0">
                        <thead class="thead">
                            <tr>
                                <th>S. No</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@include('admin.causafallas.partials.formUpdate') 
@include('admin.causafallas.partials.formRegister')

@stop

@section('scripts')
<script src="{{ asset('/js/apiCausaFalla.js') }}"></script>
<script defer src="{{ asset('/js/causafallasListener.js') }}"></script>
@endsection
