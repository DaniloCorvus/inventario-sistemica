<ul class=" navbar-nav sidebar sidebar accordion my-2 py-1" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <div class="sidebar-brand-icon">
            <img src="{{asset('img/logo3.png')}}">
        </div>
        <div class="sidebar-brand-text text-dark mx-3">
            <div class="sidebar-brand-icon">
                <img src="{{asset('img/gst.png')}}">
            </div>
        </div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link text text-dark" href="{{route('home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Inicio</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Menú
    </div>

    @can('get', \App\User::class)
    <li class="nav-item">
        <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse" data-target="#collapseBootstrap" aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="fa fa-cogs"></i>
            <span>Gestión</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Gestión</h6>
                <a class="collapse-item" href="{{route('campañas.index')}}">Campañas</a>
                <a class="collapse-item" href="{{route('estados.index')}}">Estados</a>
                <a class="collapse-item" href="{{route('happycallestados.index')}}">Happy call estados</a>
                <a class="collapse-item" href="{{route('marcas.index')}}">Marcas</a>
                <a class="collapse-item" href="{{route('messages.index')}}">Mensajes</a>
                <a class="collapse-item" href="{{route('modos.index')}}">Modos</a>
                <a class="collapse-item" href="{{route('razons.index')}}">Pendientes</a>
                <a class="collapse-item" href="{{route('tipos.index')}}">Tipos</a>
                <a class="collapse-item" href="{{route('tiporeparacions.index')}}">Tipo Reparacion</a>
                <a class="collapse-item" href="{{route('productos.index')}}">Productos</a>
                <a class="collapse-item" href="{{route('clausulas.index')}}">Clausulas</a>
                <a class="collapse-item" href="{{route('users.index')}}">Usuarios</a>
            </div>
        </div>
    </li>

    <li class="nav-item mt-2">
        <a class="nav-link text text-dark" href="{{route('clientes.index')}}">
            <i class="fa fa-users"></i>
            <span>Clientes</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text text-dark" href="{{route('proveedors.index')}}">
            <i class="fa fa-users"></i>
            <span>Proveedores</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link text text-dark" href="{{route('equipos.index')}}">
            <i class="fa fa-desktop"></i>
            <span>Equipos</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link text text-dark" href="{{route('repuestos.index')}}">
            <i class="fa fa-wrench"></i>
            <span>Repuestos</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link text text-dark" href="{{route('update.busqueda')}}">
            <i class="fa fa-cog"></i>
            <span>Actualizaciones</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true" aria-controls="collapseTable">
            <i class="fa fa-cubes"></i>
            <span>Servicios</span>
        </a>
        <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('services.index')}}">Servicios</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse" data-target="#collapsesinfo" aria-expanded="true" aria-controls="collapsesinfo">
            <i class="fa fa-file"></i>
            <span>Informes</span>
        </a>
        <div id="collapsesinfo" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"></h6>
                <a class="collapse-item" href="{{route('informe.index')}}">Informe de Producción</a>
                <a class="collapse-item" href="{{route('informes.corte')}}">Informe Corte</a>
                <a class="collapse-item" href="{{route('informe.informeServicios')}}">Ingresos entre Fechas</a>
                <a class="collapse-item" href="{{route('informe.dineros')}}">Recepcion de dineros</a>
                <a class="collapse-item" href="{{route('informe.salida')}}">Informe Salida</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse" data-target="#collapcharts" aria-expanded="true" aria-controls="collapcharts">
            <i class="fa fa-chart-pie"></i>
            <span>Graficos</span>
        </a>
        <div id="collapcharts" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"></h6>
                <a class="collapse-item" href="{{route('charts.services')}}">Servicios</a>
            </div>
        </div>

    </li>
    <li class="nav-item">
        <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse" data-target="#collapestadistc" aria-expanded="true" aria-controls="collapestadistc">
            <i class="fa fa-chart-line"></i>
            <span>Estadisticas</span>
        </a>
        <div id="collapestadistc" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"></h6>
                <a class="collapse-item" href="{{route('estadistica.tecnico')}}">Tecnicos</a>
            </div>
        </div>

    </li>
    @endcan

    <li class="nav-item">
        <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse" data-target="#collapseinventario" aria-expanded="true" aria-controls="collapseinventario">
            <i class="fa fa-shopping-cart"></i>
            <span>Inventario</span>
        </a>
        <div id="collapseinventario" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"></h6>

                <a class="collapse-item" href="{{route('productox.index')}}">Productos</a>
                <a class="collapse-item" href="{{route('inventario.index')}}">Inventario</a>
                <a class="collapse-item" href="{{route('categorias.index')}}">Categorias</a>
                <a class="collapse-item" href="{{route('cellars.index')}}">Bodegas</a>
                {{-- <a class="collapse-item" href="{{route('pedidos.index')}}">Pedidos</a> --}}
                <a class="collapse-item" href="{{route('ventas.index')}}">Ventas</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed text text-dark" href="{{url('/tecnico/myservices')}}">
            <i class="fa fa-user"></i>
            <span>Mis Servicios</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>
</ul>