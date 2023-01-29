<script src="<?php echo $sourcePath; ?>/public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $sourcePath; ?>/public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $sourcePath; ?>/public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo $sourcePath; ?>/public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo $sourcePath; ?>/public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo $sourcePath; ?>/public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo $sourcePath; ?>/public/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo $sourcePath; ?>/public/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo $sourcePath; ?>/public/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo $sourcePath; ?>/public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo $sourcePath; ?>/public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo $sourcePath; ?>/public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(function() {
        $("#main-table").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [{
                extend: 'excel',
                exportOptions: {
                    columns: [".export"]
                }
            }, {
                extend: 'pdf',
                exportOptions: {
                    columns: [".export"]
                }
            }, "colvis"]
        }).buttons().container().appendTo('#main-table_wrapper .col-md-6:eq(0)');
    });
</script>