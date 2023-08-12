<!-- Bootstrap -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.4.2/css/pro.min.css">
<!-- Sweetalert2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.22/sweetalert2.all.min.js"></script>
<!-- Data Tables -->
<?php if (in_array('datatables', $site['cdn'])) { ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.6/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs5/2.5.0/responsive.bootstrap5.min.css">
<?php } ?>
<!-- AOS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
<!-- Site style -->
<link rel="stylesheet" href="<?= resource('css/font_style.min.css', true) ?>">
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= config('site.google.analytics') ?>"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', '<?= config('site.google.analytics') ?>');
</script>