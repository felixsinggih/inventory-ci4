<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('admin/layout/fungsi') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p>
                    <a href="<?= base_url('settings/edit') ?>" class="btn btn-success"><i class="fas fa-pencil-alt"></i> Edit</a>
                </p>
                <table class="table table-striped">
                    <tr>
                        <th style="width: 30%;">Nama Website</th>
                        <td><?= $web['nm_web'] ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><?= $web['alamat'] ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= $web['email'] ?></td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td><?= $web['telp'] ?></td>
                    </tr>
                    <tr>
                        <th>Pengaturan Stok Mininal</th>
                        <td><?= $web['min_stok'] ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>