<!-- Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap file input -->
<?php if (isset($site['cdn']) and in_array('bs-file', $site['cdn'])) {
?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bs-custom-file-input/1.3.4/bs-custom-file-input.min.js"></script>
    <script>
        $(document).ready(function() {
            bsCustomFileInput.init()
        })
    </script>
<?php } ?>
<!-- Core plugin JavaScript-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="<?= resource('js/backend.min.js', true) ?>"></script>
<!-- Data Tables -->
<?php if (isset($site['cdn']) and in_array('datatables', $site['cdn'])) { ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net/1.13.4/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.4/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive/2.4.1/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs5/2.4.1/responsive.bootstrap5.min.js"></script>
<?php } ?>