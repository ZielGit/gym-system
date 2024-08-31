<nav class="sidebar sidebar-offcanvas shadow-lg" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="profile-image">
                    <img src="/assets/images/user.png" alt="image" />
                </div>
                <div class="profile-name">
                    <p class="name">
                        <!-- <?php echo $_SESSION['nombre']; ?> -->
                    </p>
                    <p class="designation">
                        <!-- <?php echo $_SESSION['usuario']; ?> -->
                    </p>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="dashboard">
                <i class="fa fa-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="usuarios">
                <i class="fa fa-user menu-icon"></i>
                <span class="menu-title">Empleados</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="planes">
                <i class="fa fa-list-alt menu-icon"></i>
                <span class="menu-title">Planes y servicios</span>
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
                    <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="customers">Listado</a></li>
                    <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="clientes/plan">Plan</a></li>
                    <li class="nav-item"> <a class="nav-link" href="clientes/pagos">Pagos</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="asistencias">
                <i class="fa fa-calendar menu-icon"></i>
                <span class="menu-title">Asistencias</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="rutinas">
                <i class="fa fa-list menu-icon"></i>
                <span class="menu-title">Rutinas</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="entrenador">
                <i class="fa fa-user menu-icon"></i>
                <span class="menu-title">Entrenador</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="administracion">
                <i class="fa fa-cog menu-icon"></i>
                <span class="menu-title">Contactos</span>
            </a>
        </li>
    </ul>
</nav>