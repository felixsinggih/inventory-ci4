<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="<?= base_url('dashboard') ?>" class="navbar-brand">
            <span class="brand-text font-weight-light">Inventory</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link<?= ($act == 'dashboard') ? ' active' : ''; ?>">Dashboard</a>
                </li>
                <?php if (session()->get('level') == 'Admin') { ?>
                    <li class="nav-item">
                        <a href="<?= base_url('settings') ?>" class="nav-link<?= ($act == 'settings') ? ' active' : ''; ?>">Pengaturan</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin') ?>" class="nav-link<?= ($act == 'admin') ? ' active' : ''; ?>">Admin</a>
                    </li>
                <?php } ?>
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle<?= ($act == 'barang') ? ' active' : ''; ?>">Barang</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="<?= base_url('item') ?>" class="dropdown-item">Data Barang</a></li>
                        <li><a href="<?= base_url('supply') ?>" class="dropdown-item">Barang Masuk</a></li>
                        <li><a href="<?= base_url('export') ?>" class="dropdown-item">Barang Keluar</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('history') ?>" class="nav-link<?= ($act == 'history') ? ' active' : ''; ?>">History</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('logout') ?>" class="nav-link">Log Out</a>
                </li>
            </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-slide="true" href="<?= base_url('profile') ?>">
                    <i class="fas fa-user-circle"> <?php $exp = explode(" ", session()->get('name'));
                                                    echo $exp[0]; ?></i>
                </a>
            </li>
        </ul>
    </div>
</nav>