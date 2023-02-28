<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Features</div>
            <a class="nav-link <?= getSegment(2) == 'dashboard' ? 'active' : ''?>" href="<?= admin_url('dashboard') ?>">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-fw"></i></div>
                Dashboard
            </a>
            <a class="nav-link <?= sprintf('%s/%s', getSegment(2), getSegment(3)) == 'transaction/cashier' ? 'active' : ''?>" href="<?= admin_url('transaction/cashier') ?>">
                <div class="sb-nav-link-icon"><i class="fas fa-cash-register fa-fw"></i></div>
                Transaksi
            </a>
            <a class="nav-link <?= sprintf('%s/%s', getSegment(2), getSegment(3)) == 'transaction/history' ? 'active' : ''?>" href="<?= admin_url('transaction/history') ?>">
                <div class="sb-nav-link-icon"><i class="fas fa-cash-register fa-fw"></i></div>
                Rekap Transaksi
            </a>
            <div class="sb-sidenav-menu-heading">Modul</div>
            <a class="nav-link <?= getSegment(2) == 'category' ? 'active' : ''?>" href="<?= admin_url('category') ?>">
                <div class="sb-nav-link-icon"><i class="fas fa-boxes fa-fw"></i></div>
                Kategori
            </a>
            <a class="nav-link <?= getSegment(2) == 'items' ? 'active' : ''?>" href="<?= admin_url('items') ?>">
                <div class="sb-nav-link-icon"><i class="fas fa-boxes fa-fw"></i></div>
                Inventaris
            </a>
            <?php if(getSession()->role == 'admin'): ?>
            <a class="nav-link <?= getSegment(2) == 'user' ? 'active' : ''?>" href="<?= admin_url('user') ?>">
                <div class="sb-nav-link-icon"><i class="fas fa-users fa-fw"></i></div>
                Pengguna
            </a>
            <?php endif; ?>
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