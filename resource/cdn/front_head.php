<!-- Bootstrap -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.4.0/css/pro.min.css">
<!-- Sweetalert2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.20/sweetalert2.all.min.js"></script>
<!-- Data Tables -->
<?php if (in_array('datatables', $site['cdn'])) { ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.4/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs5/2.4.1/responsive.bootstrap5.min.css">
<?php } ?>
<!-- Highcharts -->
<?php if (in_array('highcharts', $site['cdn'])) { ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/10.3.3/highcharts.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/10.3.3/modules/exporting.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/10.3.3/modules/export-data.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/10.3.3/modules/accessibility.min.js"></script>
<?php } ?>
<!-- AOS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
<!-- Site style -->
<link rel="stylesheet" href="<?= resource('css/font_style.min.css', true) ?>">