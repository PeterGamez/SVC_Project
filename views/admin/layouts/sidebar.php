<?php

use App\Models\Approve;
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= admin_url() ?>">
        <div class="sidebar-brand-icon">
            <img class="img-profile rounded-circle" src="<?= config('site.logo.256') ?>" alt="<?= config('site.name') ?> logo" style="width: 50px">
        </div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="<?= admin_url() ?>">
            <i class="fa-sharp fa-solid fa-house"></i>
            <span>หน้าแรก</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Whitelist
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?= admin_url('whitelist') ?>">
            <i class="fa-regular fa-list"></i>
            <span>รายการไวริส</span>
        </a>
    </li>
    <?php
    $whitelist_waiting = Approve::find(['whitelist_waiting' => 1])->get();
    if ($whitelist_waiting) {
    ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_whitelist_waiting">
                <i class="fa-solid fa-list-tree"></i>
                <span>รายการเพื่มเติม</span>
            </a>
            <div id="collapse_whitelist_waiting" class="collapse">
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php
                    for ($i = 0; $i < count($whitelist_waiting); $i++) {
                    ?>
                        <a class="collapse-item" href="<?= admin_url('whitelist.waiting') . "?s=" . $whitelist_waiting[$i]['id'] ?>">
                            <?= $whitelist_waiting[$i]['name'] ?>
                        </a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </li>
    <?php
    }
    ?>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Blacklist
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?= admin_url('blacklist') ?>">
            <i class="fa-regular fa-list"></i>
            <span>รายการแบล็คลิส</span>
        </a>
    </li>
    <?php
    $blacklist = Approve::find(['blacklist' => 1])->get();
    if ($blacklist) {
    ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_blacklist">
                <i class="fa-solid fa-list-tree"></i>
                <span>รายการเพื่มเติม</span>
            </a>
            <div id="collapse_blacklist" class="collapse">
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php
                    for ($i = 0; $i < count($blacklist); $i++) {
                    ?>
                        <a class="collapse-item" href="<?= admin_url('blacklist') . "?s=" . $blacklist[$i]['id'] ?>">
                            <?= $blacklist[$i]['name'] ?>
                        </a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </li>
    <?php
    }
    ?>

    <?php
    if (in_array($_SESSION['user_role'], ['superadmin', 'admin'])) {
    ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= admin_url('blacklist.category') ?>">
                <i class="fa-solid fa-layer-group"></i>
                <span>จัดการหมวดหมู่</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Setting
        </div>

        <li class="nav-item">
            <a class="nav-link" href="<?= admin_url('account') ?>">
                <i class="fa-solid fa-users"></i>
                <span>จัดการบัญชี</span>
            </a>
            <a class="nav-link" href="<?= admin_url('bank') ?>">
                <i class="fa-sharp fa-solid fa-building-columns"></i>
                <span>จัดการธนาคาร</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= admin_url('approve') ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>จัดการสถานะ</span>
            </a>
        </li>
    <?php
    }
    ?>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>