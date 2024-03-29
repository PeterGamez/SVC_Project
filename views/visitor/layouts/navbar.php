<nav class="navbar fixed-top navbar-expand-lg navbar-style">
    <div class="container">
        <a class="navbar-brand" href="<?= url('/') ?>">
            <img src="<?= config('site.logo.128') ?>" alt="<?= config('site.name') ?> icon" class="rounded" width="40px" height="40px">
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
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0 justify-content-end">
                <?php
                if ($_SESSION['login'] == false) {
                ?>
                    <li class="nav-item d-flex justify-content-right">
                        <a class="nav-link" href="<?= member_url('login') ?>">Login <i class="fa-solid fa-lock-keyhole"></i></a>
                    </li>
                <?php
                } else if ($_SESSION['login'] == true) {
                ?>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= $_SESSION['user_avatar'] ?>" alt=" <?= $_SESSION['user_username']; ?>" class="rounded" width="30px" height="30px">
                            <?= $_SESSION['user_username']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php
                            if (in_array($_SESSION['user_role'], ['superadmin', 'admin', 'staff'])) {
                                echo '<a class="dropdown-item" href="' . admin_url() . '"><i class="fa-solid fa-users-gear"></i> หลังบ้าน</a>';
                            } else {
                                echo '<a class="dropdown-item" href="' . member_url() . '"><i class="fa-solid fa-users-gear"></i> หลังบ้าน</a>';
                            }
                            ?>
                            <a class="dropdown-item" href="<?= member_url('logout') ?>"><i class="fa-solid fa-lock-keyhole-open"></i> ออกจากระบบ</a>
                        </div>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>