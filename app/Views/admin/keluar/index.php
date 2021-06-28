<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('admin/layout/fungsi') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('export/searching') ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Pencarian" name="keyword" value="<?= $keyword; ?>" autocomplete="off">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                        </div>
                    </div>
                </form>

                <p>
                    <a href="<?= base_url('export/new') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                </p>
                <table id="dataTable1" class="table table-bordered table-hover table-striped table-valign-middle">
                    <thead align="center">
                        <tr>
                            <td style="width: 70px;">No.</td>
                            <td style="width: 100px;">ID</td>
                            <td style="width: 120px;">Tanggal Keluar</td>
                            <td>Keterangan</td>
                            <td style="width: 80px;">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 + (25 * ($currentPage - 1));
                        foreach ($keluar as $data) : ?>
                            <tr align="center">
                                <td><?= $i++ ?></td>
                                <td><?= $data['id_keluar'] ?></td>
                                <td><?= tanggal($data['tanggal']) ?></td>
                                <td align="left"><?= nl2br($data['keterangan']) ?></td>
                                <td>
                                    <a href="<?= base_url('export/' . $data['id_keluar']) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <i>Menampilkan 25 data per halaman.</i>
                <div class="float-right">
                    <?= $pager->links('export', 'paging'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>