<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= member_url() ?>">
        <div class="sidebar-brand-icon">
            <img class="img-profile rounded-circle" src="<?= config('site.logo.256') ?>" alt="<?= config('site.name') ?> logo" width="50px" height="50px">
        </div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="<?= member_url() ?>">
            <i class="fa-sharp fa-solid fa-house"></i>
            <span>หน้าแรก</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        My Shop
    </div>
    <?php
    if ($_SESSION['user_role'] == 'seller') {
    ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= member_url('whitelist.setting') ?>">
                <i class="fa-sharp fa-solid fa-gear"></i>
                <span>จัดการกิจการ</span>
            </a>
        </li>
    <?php
    } else {
    ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= member_url('whitelist.register') ?>">
                <i class="fa-solid fa-square-pen"></i>
                <span>ลงทะเบียนกิจการ</span>
            </a>
        </li>
    <?php
    }
    ?>
    <div class="sidebar-heading">
        Blacklist
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?= member_url('blacklist.report') ?>">
            <i class="fa-solid fa-megaphone"></i>
            <span>แจ้งผู้ขายที่ควรระวัง</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= member_url('blacklist.myreport') ?>">
            <i class="fa-regular fa-list"></i>
            <span>รายการผู้ขายที่คุณแจ้ง</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>