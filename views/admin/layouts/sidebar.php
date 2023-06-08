<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= url(config('site.admin_panel')) ?>">
        <div class="sidebar-brand-icon">
            <img class="img-profile rounded-circle" src="<?= config('site.logo.256') ?>" alt="<?= config('site.name') ?> logo" style="width: 50px">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= url(config('site.admin_panel')) ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Setting
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?= admin_url('account') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Account</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>