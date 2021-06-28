<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('admin/layout/fungsi'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('settings/update/' . $web['id_web']) ?>" method="post">
                    <?= csrf_field(); ?>
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="nm_web" class="col-sm-2 col-form-label">Nama Website</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('nm_web')) ? 'is-invalid' : ''; ?>" id="nm_web" name="nm_web" value="<?= (old('nm_web')) ? old('nm_web') : $web['nm_web'] ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nm_web'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="alamat" id="alamat" rows="3"><?= (old('alamat')) ? old('alamat') : $web['alamat'] ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('alamat'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= (old('email')) ? old('email') : $web['email'] ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('email'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telp" class="col-sm-2 col-form-label">Telepon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('telp')) ? 'is-invalid' : ''; ?>" id="telp" name="telp" value="<?= (old('telp')) ? old('telp') : $web['telp'] ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('telp'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="min_stok" class="col-sm-2 col-form-label">Pengaturan Stok Minimal</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('min_stok')) ? 'is-invalid' : ''; ?>" id="min_stok" name="min_stok" value="<?= (old('min_stok')) ? old('min_stok') : $web['min_stok'] ?>">
                            <i>*digunakan untuk notifikasi pengingat saat stok barang sudah mencapai batas minimal</i>
                            <div class="invalid-feedback">
                                <?= $validation->getError('min_stok'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>