@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header mt-2">Bienvenido a AMEF</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif


                    <div class="card-body">

                        <form id="formPrint" method="GET" action="{{ route('print') }}">
                            @csrf
                            <div class="modal-body">

                                <div class="row">

                                    @if (count($sistemas) > 0)
                                    <div class="form-group col-md-12">
                                        <div id="something" style="width:500px">
                                            <label class="text-dark" for="sistema_id">Seleccione el sistema</label>
                                            <select class="form-control valid" data-val="true" data-val-number="El campo Acto Sujeto a debe ser un número." id="Id" name="Id" aria-describedby="Id-error" aria-invalid="false">
                                                @foreach ($sistemas as $item)
                                                <option style="width:500px" class="form-control valid" value="{{$item->id}}"> {{$item->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-outline-info " id="btnPrint" value="Obtener Info">
                                        </div>
                                        @else

                                        <div class="card-body">
                                            <div class="alert alert-info" role="alert">
                                                Hola {{ Auth::user()->name }}
                                            </div>

                                            @endif
                                        </div>


                                    </div>
                                </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection