<nav class="navbar navbar-expand navbar-dark  topbar mb-4 static-top">
    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
        <i class="text-primary fa fa-bars"></i>
    </button>
    <ul class="navbar-nav ml-auto ">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="text-primary fas fa-search fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="navbar-search" method="GET" action="{{route('service.buscar')}}">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-1 small" name="query"
                            placeholder="Numero de servicio..." aria-label="Search" aria-describedby="basic-addon2"
                            style="border-color: #3f51b5;">
                        <div class="input-group-append">
                            <button class="btn btn-primary btnSearh" type="submit">
                                <i class=" fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="{{asset('img/logo3.png')}}" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-primary small">{{Auth::user()->email}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="text-primary fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="text-primary fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="text-primary fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <input type="submit" class="dropdown-item" value="Logout">
                </form>
            </div>
        </li>
    </ul>
</nav>