<!-- Jquery -->
<?php if (in_array('jquery', $site['cdn'])) { ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<?php } ?>
<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>
<!-- LazySizes -->
<?php if (in_array('lazysizes', $site['cdn'])) { ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
<?php } ?>
<!-- Data Tables -->
<?php if (in_array('datatables', $site['cdn'])) { ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net/1.13.4/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.4/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive/2.4.1/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs5/2.4.1/responsive.bootstrap5.min.js"></script>
<?php } ?>
<!-- AOS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<!-- Site style -->
<script src="<?= resource('js/fontend.min.js', true) ?>"></script>