</main>
<footer class="footer mt-auto footer-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 small">Copyright &copy; Your Website 2021</div>
            <div class="col-md-6 text-md-right small">
                <a href="#!">Privacy Policy</a>
                &middot;
                <a href="#!">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>assets/js/scripts.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>assets/assets/demo/datatables-demo.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        $("#search").keyup(function() {
            $(this).autocomplete({
                source: "<?php echo site_url($this->uri->segment(1) . '/s_autocomplete?q='); ?>" + $(this).val(),
                autoFocus: true,

                select: function(event, ui) {
                    $(this).val(ui.item.label);
                    $("#form_search").submit();
                }
            });
        })
    });
</script>
</script>
</body>

</html>