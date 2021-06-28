<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('admin/layout/fungsi'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pencarian Barang Keluar</h3>
            </div>
            <div class="card-body">
                <form name="frm_cari_keluar" action="<?= base_url('export/add') ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <input type="text" class="form-control <?= ($validation->hasError('id_barang')) ? 'is-invalid' : ''; ?>" id="cari" name="cari" value="<?= old('cari'); ?>" placeholder="Ketik ID Barang atau Nama Barang">
                        <input type="hidden" name="id_barang" id="id_barang">
                        <input type="hidden" name="stok" id="stok">
                        <div class="invalid-feedback">
                            <?= $validation->getError('id_barang'); ?>
                        </div>
                    </div>

                    <div class="float-right">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $title ?></h3>
            </div>
            <div class="card-body">
                <?php if (empty($cartKeluar->contents())) { ?>
                    <p>Lakukan pencarian untuk menambah barang!</p>
                <?php } else { ?>
                    <p>
                        <a href="<?= base_url('export/clear') ?>" class="btn btn-danger"><i class="fas fa-times-circle"></i> Clear</a>
                    </p>

                    <table class="table table-bordered table-valign-middle">
                        <thead>
                            <tr align="center">
                                <th style="width: 50px;">#</th>
                                <th>Nama Barang</th>
                                <th>Spesifikasi</th>
                                <th style="width: 120px;">Jumlah</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cartKeluar->contents() as $data) : ?>
                                <tr>
                                    <td align="center">
                                        <a href="<?= base_url('export/delete/' . $data['rowid']) ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                    <td><?= $data['name'] ?></td>
                                    <td><?= nl2br($data['options']['spek']) ?></td>
                                    <td align="center">
                                        <form name="ubah_keluar_<?= $data['rowid'] ?>" action="<?= base_url('export/edit') ?>" method="post">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="rowid" value="<?= $data['rowid'] ?>">
                                            <input type="hidden" name="id_barang" value="<?= $data['id'] ?>">
                                            <input type="number" class="form-control" name="jumlah" min="0" value="<?= $data['qty'] ?>" onkeypress="return isNumberKeyTrue(event)" onChange="submit()">
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table><br />

                    <form name="frm_export" action="<?= base_url('export/save') ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Keluar</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" id="tgl1" name="tanggal" placeholder="YYYY-MM-DD" value="<?= old('tanggal') ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('tanggal'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="3" id="keterangan" name="keterangan"><?= old('keterangan'); ?></textarea>
                            </div>
                        </div>

                        <div class="float-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#cari').autocomplete({
            minLength: 0,
            source: '<?= base_url('items') ?>',
            focus: function(event, ui) {
                $('#cari').val(ui.item.label);
                return false;
            },
            select: function(event, ui) {
                $('#cari').val(ui.item.label);
                $('#id_barang').val(ui.item.id_barang);
                $('#stok').val(ui.item.stok);
                return false;
            }
        })
    });
</script>
<?= $this->endSection(); ?>