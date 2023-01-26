<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" id="sidebarToggle" href="#!"><?= $title ?? '' ?></a>
    <!-- Navbar-->
    <!-- <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        </li>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#!">Settings</a>
            <a class="dropdown-item" href="#!">Activity Log</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="login.html">Logout</a>
        </div>
    </ul> -->
    <span class="ml-auto mr-4 text-light cursor-default"><i class="fas fa-user fa-fw mr-2"></i><?= getSession()->fullname ?></span>
</nav>