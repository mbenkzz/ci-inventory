<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Features</div>
            <a class="nav-link <?= getSegment(2) == 'dashboard' ? 'active' : ''?>" href="<?= admin_url('dashboard') ?>">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-fw"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Modul</div>
            <a class="nav-link <?= getSegment(2) == 'inventory' ? 'active' : ''?>" href="<?= admin_url('inventory') ?>">
                <div class="sb-nav-link-icon"><i class="fas fa-boxes fa-fw"></i></div>
                Inventaris
            </a>
            <a class="nav-link <?= getSegment(2) == 'user' ? 'active' : ''?>" href="<?= admin_url('user') ?>">
                <div class="sb-nav-link-icon"><i class="fas fa-users fa-fw"></i></div>
                Pengguna
            </a>
            <div class="sb-sidenav-menu-heading">Other</div>
            <a role="button" class="nav-link" href="#" onclick="logout()">
                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt fa-fw"></i></div>
                Keluar
            </a>
            <!-- Templates -->
            <!-- <a class="nav-link" href="tables.html">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Tables
            </a>
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Layouts
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a> -->
        </div>
    </div>
</nav>