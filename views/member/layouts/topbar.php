<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600"><?= $_SESSION['user_username'] ?></span>
                <img class="img-profile rounded-circle" src="<?= $_SESSION['user_avatar'] ?>">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= url('/') ?>">
                    <i class="fa-sharp fa-solid fa-house-chimney mr-2 text-gray-400"></i> หนัาบ้าน
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= member_url('profile.password') ?>">
                    <i class="fa-sharp fa-solid fa-gear-code mr-2 text-gray-400"></i> เปลี่ยนรหัสผ่าน
                </a>
                <a class="dropdown-item" href="<?= member_url('logout') ?>">
                    <i class="fa-sharp fa-solid fa-person-from-portal mr-2 text-gray-400"></i> ออกจากระบบ
                </a>
            </div>
        </li>
    </ul>
</nav>