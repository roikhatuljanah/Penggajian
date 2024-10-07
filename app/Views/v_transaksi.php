<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $subjudul ?></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#add-data"><i class="fas fa-plus"></i> Add Data
                </button>
            </div>
        </div>
        <div class="card-body">
            <?php
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>';
                echo session()->getFlashdata('pesan');
                echo '</h5></div>';
            }
            ?>
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
                                <button class="btn btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#edit-data<?= $value['nk'] ?>">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete-data<?= $value['nk'] ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
            <?= $pager->Links() ?>
        </div>
    </div>
</div>

<!-- Modall Add Data-->
<div class="modal fade" id="add-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Data <?= $subjudul ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
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
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modall edit Data-->
<?php foreach ($transaksi as $key => $value) { ?>

    <div class="modal fade" id="edit-data<?= $value['nk'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data <?= $subjudul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open('Transaksi/UpdateData/' . $value['nk']) ?>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="">Nama Karyawan</label>
                        <input name="nm_kry" value="<?php echo $value['nm_kry']; ?>" class="form-control" placeholder="Nama Karyawan" required>
                    </div>

                    <div class="form-group">
                        <label for="kode_jab">Kode Jabatan</label>
                            <select name="kode_jab" class="form-control" required>
                                <option value="1" <?php echo ($value['kode_jab'] == '1') ? 'selected' : ''; ?>>1</option>
                                <option value="2" <?php echo ($value['kode_jab'] == '2') ? 'selected' : ''; ?>>2</option>
                                <option value="3" <?php echo ($value['kode_jab'] == '3') ? 'selected' : ''; ?>>3</option>
                                <option value="4" <?php echo ($value['kode_jab'] == '4') ? 'selected' : ''; ?>>4</option>
                                <option value="5" <?php echo ($value['kode_jab'] == '5') ? 'selected' : ''; ?>>5</option>
                            </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="BK" <?php echo ($value['status'] == 'BK') ? 'selected' : ''; ?>>BK</option>
                                <option value="KW" <?php echo ($value['status'] == 'KW') ? 'selected' : ''; ?>>KW</option>
                            </select>
                    </div>

                    <div class="form-group">
                        <label for="anak">Jumlah Anak</label>
                            <select name="anak" class="form-control" required>
                                <option value="0" <?php echo ($value['anak'] == '0') ? 'selected' : ''; ?>>0</option>
                                <option value="1" <?php echo ($value['anak'] == '1') ? 'selected' : ''; ?>>1</option>
                                <option value="2" <?php echo ($value['anak'] == '2') ? 'selected' : ''; ?>>2</option>
                            </select>
                    </div>

                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning btn-flat">Save</button>
                </div>
                <?php echo form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>

<!-- Modall delete Data-->
<?php foreach ($transaksi as $key => $value) { ?>
    <div class="modal fade" id="delete-data<?= $value['nk'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Data <?= $subjudul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    Apakah Anda Yakin Hapus <b><?= $value['nm_kry'] ?></b> ..?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('Transaksi/DeleteData/' . $value['nk']) ?>" class="btn btn-danger btn-flat">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
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
<?php } ?>
