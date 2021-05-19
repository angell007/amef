<ul class=" navbar-nav sidebar sidebar accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon">

        </div>
        <div class="sidebar-brand-text text-dark mx-3">AMEF</div>
    </a>
    <hr class="sidebar-divider my-0">




    {{-- <li class="nav-item mt-2"> <a class="nav-link text text-dark" href="{{route('propietarios.index')}}"><i class="fa fa-users"></i> <small>Propietarios</small></a> </li>
    <li class="nav-item "> <a class="nav-link text text-dark" href="{{route('clientes.index')}}"><i class="fa fa-users"></i> <small>Clientes</small></a> </li>
    <li class="nav-item "> <a class="nav-link text text-dark" href="{{route('proveedors.index')}}"><i class="fa fa-users"></i> <small>Proveedores</small></a> </li> --}}


    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Gestion de Datos
    </div>

    {{-- <li class="nav-item "> <a class="nav-link text text-dark" href='{{route('vehiculos.index')}}'><i class="fa fa-users"></i> <small>Todos</small></a> </li>
    <li class="nav-item "> <a class="nav-link text text-dark" href='{{route('aggkm')}}'><i class="fa fa-users"></i>
            <small> Actualizar Km</small></a> </li> --}}

    <li class="nav-item">
        <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse" data-target="#collapseMtos" aria-expanded="true" aria-controls="collapseMtos">
            <i class="fa fa-cogs"></i>
            <span>Sistemas</span>
        </a>
        <div id="collapseMtos" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('sistemas.index')}}">Gestión de Sistemas</a>
                <a class="collapse-item" href="{{route('componentes.index')}}">Gestión de Componentes</a>
                <a class="collapse-item" href="{{route('partes.index')}}">Gestion Partes</a>
            </div>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse" data-target="#collapseBootstrap" aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="fa fa-cogs"></i>
            <span>Administración</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item text text-nowrap" href="{{route('funcion-subsistemas.index')}}">Funciones del subsistema</a>
                <a class="collapse-item" href="{{route('funcions.index')}}">Gestion de Funciones</a>
                <hr>
                <a class="collapse-item" href="{{route('falla-funcionals.index')}}">Gestion Fallas Funcionales</a>
                <a class="collapse-item" href="{{route('modo-fallas.index')}}">Gestion Modos de Falla</a>
                <hr>

                <a class="collapse-item" href="{{route('causa-fallas.index')}}">Gestion Causa de la Falla</a>
                <a class="collapse-item" href="{{route('efecto-fallas.index')}}">Gestion Efectos de Falla</a>
                <hr>

                <a class="collapse-item" href="{{route('actividades.index')}}">Tareas o Actividades</a>

            </div>
        </div>
    </li>




    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>


</ul>