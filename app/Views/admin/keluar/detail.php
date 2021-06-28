<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('admin/layout/fungsi') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <a href="<?= base_url('export') ?>" class="btn btn-default"><i class="fas fa-undo"></i> Kembali</a>
                        <a href="<?= base_url('export/print/' . $keluar['id_keluar']) ?>" class="btn btn-danger"><i class="fas fa-print"></i> Print</a>
                    </div>
                    <div class="col-sm-6">
                        <p class="float-right">Tanggal input : <?= datetime($keluar['created_at']) ?></p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ID</label>
                    <p class="col-sm-10 col-form-label"><?= $keluar['id_keluar'] ?></p>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Masuk</label>
                    <p class="col-sm-10 col-form-label"><?= tanggal($keluar['tanggal']) ?></p>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Keterangan</label>
                    <p class="col-sm-10 col-form-label"><?= nl2br($keluar['keterangan']) ?></p>
                </div>

                <div class="form-group">
                    <table id="dataTable1" class="table table-bordered table-hover table-striped table-valign-middle">
                        <thead align="center">
                            <tr>
                                <td style="width: 70px;">No.</td>
                                <td>Nama Barang</td>
                                <td>Spesifikasi</td>
                                <td style="width: 200px;">Jumlah</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($keluarDetail as $data) : ?>
                                <tr align="center">
                                    <td><?= $i++ ?></td>
                                    <td align="left"><?= $data['nm_barang'] ?></td>
                                    <td align="left"><?= nl2br($data['spek_attime']) ?></td>
                                    <td><?= ribuan($data['jumlah']) . ' ' . $data['satuan'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>