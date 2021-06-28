<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('admin/layout/fungsi'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pencarian Barang</h3>
            </div>
            <div class="card-body">
                <form name="frm_cari" action="<?= base_url('supply/add') ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <input type="text" class="form-control <?= ($validation->hasError('id_barang')) ? 'is-invalid' : ''; ?>" id="cari" name="cari" value="<?= old('cari'); ?>" placeholder="Ketik ID Barang atau Nama Barang">
                        <input type="hidden" name="id_barang" id="id_barang">
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
                <?php if (empty($cart->contents())) { ?>
                    <p>Lakukan pencarian untuk menambah barang!</p>
                <?php } else { ?>
                    <p>
                        <a href="<?= base_url('supply/clear') ?>" class="btn btn-danger"><i class="fas fa-times-circle"></i> Clear</a>
                    </p>

                    <table class="table table-bordered table-valign-middle">
                        <thead>
                            <tr align="center">
                                <th style="width: 50px;">#</th>
                                <th>Nama Barang</th>
                                <th style="width: 120px;">Jumlah</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cart->contents() as $data) : ?>
                                <tr>
                                    <td align="center">
                                        <a href="<?= base_url('supply/delete/' . $data['rowid']) ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                    <td><?= $data['name'] ?></td>
                                    <td align="center">
                                        <form name="ubah_<?= $data['rowid'] ?>" action="<?= base_url('supply/edit') ?>" method="post">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="rowid" value="<?= $data['rowid'] ?>">
                                            <input type="number" class="form-control" name="jumlah" min="0" value="<?= $data['qty'] ?>" onkeypress="return isNumberKeyTrue(event)" onChange="submit()">
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table><br />

                    <form name="frm_supply" action="<?= base_url('supply/save') ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group row">
                            <label for="penyuplai" class="col-sm-2 col-form-label">Penyuplai</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= ($validation->hasError('penyuplai')) ? 'is-invalid' : ''; ?>" id="penyuplai" name="penyuplai" value="<?= old('penyuplai'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('penyuplai'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Masuk</label>
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
                return false;
            }
        })
    });
</script>
<?= $this->endSection(); ?>