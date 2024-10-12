<nav class="sidebar sidebar-offcanvas shadow-lg" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="profile-image">
                    <img src="/melody/images/user.png" alt="image" />
                </div>
                <div class="profile-name">
                    <p class="name user-name"></p>
                    <p class="designation user-email"></p>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/dashboard">
                <i class="fa fa-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/plans">
                <i class="fa fa-list-alt menu-icon"></i>
                <span class="menu-title">Planes</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
                <i class="fa fa-users menu-icon"></i>
                <span class="menu-title">Clientes</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-layouts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="/admin/customers">Listado</a></li>
                    <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="/admin/customers/plan">Plan</a></li>
                    <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="/admin/customers/payment">Pagos</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/attendances">
                <i class="fa fa-calendar menu-icon"></i>
                <span class="menu-title">Asistencias</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/routines">
                <i class="fa fa-list menu-icon"></i>
                <span class="menu-title">Rutinas</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/coaches">
                <i class="fa fa-user menu-icon"></i>
                <span class="menu-title">Entrenador</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/users">
                <i class="fa fa-user menu-icon"></i>
                <span class="menu-title">Usuarios</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/companies">
                <i class="fas fa-building menu-icon"></i>
                <span class="menu-title">Empresa</span>
            </a>
        </li>
    </ul>
</nav>