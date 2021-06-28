<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('admin/layout/fungsi'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p>
                    <a href="<?= base_url('password') ?>" class="btn btn-success"><i class="fas fa-lock"></i> Ubah Password</a>
                </p>
                <table class="table table-bordered table-hover">
                    <tr>
                        <td style="width: 20%;">Your ID</td>
                        <td><?= $user['id_user'] ?></td>
                    </tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td><?= $user['nm_user'] ?></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><?= $user['username'] ?></td>
                    </tr>
                    <tr>
                        <td>Level</td>
                        <td><?= $user['level'] ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><?= $user['status'] ?></td>
                    </tr>
                    <tr>
                        <td>Last Update</td>
                        <td><?= datetime($user['updated_at']) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>