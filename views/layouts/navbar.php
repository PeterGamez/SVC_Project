<nav class="navbar fixed-top navbar-expand-lg navbar-style">
    <div class="container">
        <a class="navbar-brand" href="<?= url('/') ?>">
            <img src="<?= config('site.logo.64') ?>" alt="<?= config('site.name') ?> icon" class="rounded" style="width:40px; ">
            <?= config('site.name') ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbartoggler" aria-controls="navbartoggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbartoggler">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= url('/') ?>"><i class="fa-solid fa-house-chimney"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= url('whitelist') ?>"><i class="fa-regular fa-square-list"></i> Whitelist</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= url('blacklist') ?>"><i class="fa-solid fa-square-list"></i> Blacklist</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= url('contact') ?>"><i class="fa-brands fa-discord"></i> Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0 justify-content-end">
                <?php
                if ($_SESSION['login'] == false) {
                ?>
                    <div class="d-flex justify-content-right">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= sub_url(config('site.admin_panel'), 'login') ?>">Login <i class="fa-solid fa-lock-keyhole"></i></a>
                        </li>
                    </div>
                <?php
                } else if ($_SESSION['login'] == true) {
                ?>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= $_SESSION['user_avatar'] ?>" alt=" <?= $_SESSION['user_username']; ?>" class="rounded" style="width:30px;">
                            <?= $_SESSION['user_username']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="<?= url(config('site.admin_panel')) ?>"><i class="fa-solid fa-users-gear"></i> หลังบ้าน</a>
                            <a class="dropdown-item" href="<?= sub_url(config('site.admin_panel'), 'logout') ?>"><i class="fa-solid fa-lock-keyhole-open"></i> ออกจากระบบ</a>
                        </div>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>