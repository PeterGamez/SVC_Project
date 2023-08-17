<!-- Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js"></script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net/1.13.6/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs4/1.13.6/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive/2.5.0/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs4/2.5.0/responsive.bootstrap4.min.js"></script>
<?php } ?>
<!-- Cookie -->
<script type="module" src="<?= resource('js/cookieconsent.min.js', true) ?>" data-cfasync="false"></script>