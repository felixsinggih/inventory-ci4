<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('admin/layout/fungsi') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('history/searching') ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Pencarian" name="keyword" value="<?= $keyword; ?>" autocomplete="off">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                        </div>
                    </div>
                </form>

                <table id="dataTable1" class="table table-bordered table-hover table-striped">
                    <thead align="center">
                        <tr>
                            <td style="width: 70px;">No.</td>
                            <td style="width: 100px;">ID Barang</td>
                            <td style="width: 100px;">ID Transaksi</td>
                            <td>Nama Barang</td>
                            <td style="width: 100px;">Stok</td>
                            <td>Keterangan</td>
                            <td style="width: 130px;">Tanggal</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 + (25 * ($currentPage - 1));
                        foreach ($history as $data) : ?>
                            <tr align="center">
                                <td><?= $i++ ?></td>
                                <td><?= $data['id_barang'] ?></td>
                                <td>
                                    <?php if (substr($data['id'], 0, 2) == "BM") { ?>
                                        <a href="<?= base_url('supply/' . $data['id']) ?>"><?= $data['id'] ?></a>
                                    <?php } elseif (substr($data['id'], 0, 2) == "BK") { ?>
                                        <a href="<?= base_url('export/' . $data['id']) ?>"><?= $data['id'] ?></a>
                                    <?php } ?>
                                </td>
                                <td align="left"><?= $data['nm_barang'] ?></td>
                                <td><?= ribuan($data['jumlah']) . ' ' . $data['satuan'] ?></td>
                                <td>
                                    <?php if (substr($data['id'], 0, 2) == "BM") {
                                        echo 'Barang Masuk';
                                    } elseif (substr($data['id'], 0, 2) == "BK") {
                                        echo 'Barang Keluar';
                                    } ?>
                                </td>
                                <td><?= datetime($data['created_at']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <i>Menampilkan 25 data per halaman.</i>
                <div class="float-right">
                    <?= $pager->links('history', 'paging'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>