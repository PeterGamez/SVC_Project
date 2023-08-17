<!-- Jquery -->
<?php if (in_array('jquery', $site['cdn'])) { ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<?php } ?>
<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
<!-- Data Tables -->
<?php if (in_array('datatables', $site['cdn'])) { ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net/1.13.6/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.6/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive/2.5.0/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs5/2.5.0/responsive.bootstrap5.min.js"></script>
<?php } ?>
<!-- AOS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<!-- Site style -->
<script src="<?= resource('js/fontend.min.js', true) ?>"></script>
<!-- Tawk.to -->
<?php if (in_array('tawk', $site['cdn'])) { ?>
    <script>
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = '<?= config('site.tawk.url') ?>';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
<?php } ?>
<!-- Cookie -->
<script type="module" src="<?= resource('js/cookieconsent.min.js', true) ?>" data-cfasync="false"></script>