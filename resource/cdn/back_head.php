<!-- Site style -->
<link rel="stylesheet" href="<?= resource('cdn/back_style.min.css', true) ?>">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" type="text/css">

<!-- Custom styles for this template-->
<link href="https://cdn.jsdelivr.net/gh/startbootstrap/startbootstrap-sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">

<!-- Data Tables -->
<?php if (isset($site['cdn']) and in_array('datatables', $site['cdn'])) { ?>
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.4/dataTables.bootstrap5.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.4/dataTables.bootstrap5.min.css">
    </noscript>
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs5/2.4.1/responsive.bootstrap5.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs5/2.4.1/responsive.bootstrap5.min.css">
    </noscript>
<?php } ?>

<?php if (isset($site['cdn']) and in_array('login', $site['cdn'])) { ?>
    <!-- Cloudflare Turnstile -->
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" defer></script>
    <!-- Google Oauth -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <meta name="google-signin-client_id" content="<?= config('site.google.id') ?>">
<?php } ?>