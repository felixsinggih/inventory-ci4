<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?> | Inventory</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/adminlte/adminlte_dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- DatePicker -->
    <script src="<?= base_url() ?>/adminlte/plugins/datepicker/js/jquery-1.10.2.js"></script>
    <link href="<?= base_url() ?>/adminlte/plugins/datepicker/css/bootstrap-datepicker.css" rel="stylesheet" media="screen">
    <link href="<?= base_url() ?>/adminlte/plugins/datepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <!-- JQueryUI -->
    <link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/jquery-ui/jquery-ui.min.css">

    <script>
        function isNumberKeyTrue(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (((charCode < 58) && (charCode > 47)) || (charCode == 8))
                return true;
            return false;
        }

        function isNumberKeyTrueWithSpace(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (((charCode < 58) && (charCode > 47)) || (charCode == 8) || (charCode == 32))
                return true;
            return false;
        }

        $(function() {
            $.datepicker.setDefaults({
                monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
                dayNamesMin: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
                // showButtonPanel: true,
                // currentText: "Hari Ini",
                // closeText: "Close",
                nextText: "Berikutnya",
                prevText: "Sebelum",
                changeMonth: true,
                numberOfMonths: 1,
                dateFormat: "yy-mm-dd",
                yearRange: "-100:+100",
                changeYear: true,
            });
            $("#tgl1").datepicker();
        });
    </script>
</head>

<body class="hold-transition layout-top-nav layout-navbar-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?= $this->include('admin/layout/navbar'); ?>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= $title ?></h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <?php if (session()->getflashdata('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getflashdata('success'); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (session()->getflashdata('failed')) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session()->getflashdata('failed'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- content -->
                    <?= $this->renderSection('content'); ?>
                    <!-- content -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/adminlte/adminlte_dist/js/adminlte.min.js"></script>
    <!-- DataTables -->
    <script src="<?= base_url() ?>/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- DatePicker -->
    <script src="<?= base_url() ?>/adminlte/plugins/datepicker/js/bootstrap-datepicker.js"></script>
    <script src="<?= base_url() ?>/adminlte/plugins/datepicker/js/bootstrap-datetimepicker.js"></script>
    <!-- JQueryUI -->
    <script src="<?= base_url() ?>/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script>
        $(function() {
            $('#dataTable1').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
</body>

</html>