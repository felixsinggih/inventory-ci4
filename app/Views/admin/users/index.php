<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('admin/searching') ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Pencarian" name="keyword" value="<?= $keyword; ?>" autocomplete="off">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                        </div>
                    </div>
                </form>

                <p>
                    <a href="<?= base_url('admin/add') ?>" class="btn btn-primary"><i class="fas fa-user-plus"></i> Tambah</a>
                </p>
                <table id="dataTable1" class="table table-bordered table-hover table-striped">
                    <thead align="center">
                        <tr>
                            <td style="width: 70px;">No.</td>
                            <td>Nama</td>
                            <td>Username</td>
                            <td style="width: 120px;">Level</td>
                            <td style="width: 60px;">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 + (10 * ($currentPage - 1));
                        foreach ($admin as $data) : ?>
                            <tr>
                                <td align="center"><?= $i++ ?></td>
                                <td><?= $data['nm_user'] ?></td>
                                <td><?= $data['username'] ?></td>
                                <td align="center"><?= $data['level'] ?></td>
                                <td align="center">
                                    <a href="<?= base_url('admin/' . $data['id_user']) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="<?= base_url('admin/edit/' . $data['id_user']) ?>" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <i>Menampilkan 10 data per halaman.</i>
                <div class="float-right">
                    <?= $pager->links('admin', 'paging'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>