<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= url(config('site.admin_panel')) ?>">
        <div class="sidebar-brand-icon">
            <img class="img-profile rounded-circle" src="<?= config('site.logo.256') ?>" alt="<?= config('site.name') ?> logo" style="width: 50px">
        </div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="<?= url(config('site.admin_panel')) ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>หน้าแรก</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Whitelist
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?= admin_url('whitelist') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>รายการไวริส</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= admin_url('whitelist.category') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>จัดการหมวดหมู่</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Blacklist
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?= admin_url('blacklist') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>รายการแบล็คลิส</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= admin_url('blacklist.category') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>จัดการหมวดหมู่</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Setting
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?= admin_url('account') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>จัดการบัญชี</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>