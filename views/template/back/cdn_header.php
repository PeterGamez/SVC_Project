<!-- Bootstrap -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.4.2/css/pro.min.css">
<!-- Data Tables -->
<?php if (isset($site['cdn']) and in_array('datatables', $site['cdn'])) { ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs4/1.13.6/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs4/2.5.0/responsive.bootstrap4.min.css">
<?php } ?>
<!-- Login -->
<?php if (isset($site['cdn']) and in_array('login', $site['cdn'])) { ?>
    <!-- Login style -->
    <link rel="stylesheet" href="<?= resource('css/back_login.min.css', true) ?>">
    <!-- Cloudflare Turnstile -->
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" defer></script>
    <!-- Google Oauth -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <meta name="google-signin-client_id" content="<?= config('site.google.id') ?>">
<?php } ?>
<!-- 404 -->
<?php if (isset($site['cdn']) and in_array('404', $site['cdn'])) { ?>
    <!-- 404 style -->
    <link rel="stylesheet" href="<?= resource('css/back_404.min.css', true) ?>">
<?php } ?>
<!-- Site style -->
<link rel="stylesheet" href="<?= resource('css/back_style.min.css', true) ?>">