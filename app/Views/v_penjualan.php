<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Leasing</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.min.css">

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.min.js"></script>
    <!-- Auto Numeric -->
    <script src="<?= base_url('autoNumeric') ?>/src/AutoNumeric.js"></script>
    <!-- terbilang -->
    <script src="<?= base_url('terbilang') ?>/terbilang.js"></script>
    <style>
  
      .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .pagination li {
            list-style: none;
            margin: 0 5px;
            display: inline-block;
        }

        .pagination li a,
        .pagination li span {
            padding: 8px 12px;
            border: 1px solid #ddd;
            color: #555;
            text-decoration: none;
            display: inline-block;
            background-color: #f8f9fa;
        }

        .pagination .active a {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

    </style>
   
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="../../index3.html" class="navbar-brand">
                    <span class="brand-text font-weight-light"><i class="	fab fa-acquisitions-incorporated text-primary"></i><b> Penggajian</b></span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">

                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">
                        <?php if (session()->get('level') == '1') { ?>
                            <a class="nav-link" href="<?= base_url('Admin') ?>">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        <?php } else { ?>
                            <a class="nav-link" href="<?= base_url('Home/Logout') ?>">
                                <i class="fas fa-sign-in-alt"></i> Logout
                            </a>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="row">
                    <!-- /.col-md-6 -->

                    <div class="col-lg-6">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                            <?php echo form_open('Transaksi/InsertData') ?>
            <div class="modal-body">

                <div class="form-group">
                    <label for="">NO Karyawan</label>
                    <input name="nk" class="form-control" placeholder="No Karyawan" required>
                </div>

                <div class="form-group">
                    <label for="">Nama Karyawan</label>
                    <input name="nm_kry" class="form-control" placeholder="nm_kry" required>
                </div>

                <div class="form-group">
                    <label for="kode_jab">Kode Jabatan</label>
                        <select name="kode_jab" class="form-control" required>
                             <option value="1">1</option>
                             <option value="2">2</option>
                             <option value="3">3</option>
                             <option value="4">4</option>
                             <option value="5">5</option>
                        </select>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                        <select name="status" class="form-control" required>
                             <option value="BK">Belum Kawin</option>
                             <option value="KW">Kawin</option>
                        </select>
                </div>

                <div class="form-group">
                    <label for="anak">Jumlah Anak</label>
                        <select name="anak" class="form-control" required>
                             <option value="0">0</option>
                             <option value="1">1</option>
                             <option value="2">2</option>
                        </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-flat">Save</button>
            </div>
            <?php echo form_close() ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>NK</th>
                        <th>Nama Karyawan</th>
                        <th>Kode Jabatan</th>
                        <th>Status</th>
                        <th>Anak</th>
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($transaksi as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['nk'] ?></td>
                            <td><?= $value['nm_kry'] ?></td>
                            <td><?= $value['kode_jab'] ?></td>
                            <td><?= $value['status'] ?></td>
                            <td><?= $value['anak'] ?></td>
                            <td class="text-center">
                            <a href="<?= base_url('Penjualan/PrintStruk/' . $value['nk']) ?>" class="btn btn-success btn-sm btn-flat" target="_blank">
                                        <i class="fas fa-print"></i>
                                        </a>
                            </td>
                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
                        <?= $pager->Links() ?>
                        </div>
                        </div>
                    </div>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2023 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->
</body>


</html>
