<footer class="bg-light text-center text-lg-start">
    <div class="container">
        <hr>
        <div class="text-center p-2" style="background-color: rgba(250, 250, 250, 0.5);">
            <span class="text-dark">
                Copyright © 2022-2023 <a class="text-dark" href="<?= url('/') ?>"><?= config('site.name') ?></a>. All rights reserved
            </span>
        </div>
        <div class="text-center p-2" style="background-color: rgba(250, 250, 250, 0.5);">
            <span class="text-dark">
                <a class="text-dark" href="<?= url('privacy') ?>">Privacy Policy</a> | <a class="text-dark" href="https://<?= $_SERVER['SERVER_NAME'] ?>/tos">Terms of Service</a>
            </span>
        </div>
        <hr>
    </div>
</footer>
<?= resource('cdn/front_foot.php') ?>