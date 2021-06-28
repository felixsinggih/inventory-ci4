<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="form-group">
                <div class="card-body">
                    <form action="<?= base_url('newpassword') ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group row">
                            <label for="pass" class="col-sm-3 col-form-label">Password Anda</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control <?= ($validation->hasError('pass')) ? 'is-invalid' : ''; ?><?= (session()->getflashdata('failed')) ? 'is-invalid' : '' ?>" id="pass" name="pass" value="<?= old('pass') ?>" autocomplete="off">
                                <input type="hidden" name="id_user" name="id_user" value="<?= $user['id_user'] ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('pass'); ?>
                                    <?= session()->getflashdata('failed') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pass_baru" class="col-sm-3 col-form-label">Password Baru Anda</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control <?= ($validation->hasError('pass_baru')) ? 'is-invalid' : ''; ?>" id="pass_baru" name="pass_baru" value="<?= old('pass_baru') ?>" autocomplete="off">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('pass_baru'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pass_konfirmasi" class="col-sm-3 col-form-label">Ketik Ulang Password Baru Anda</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control <?= ($validation->hasError('pass_konfirmasi')) ? 'is-invalid' : ''; ?>" id="pass_konfirmasi" name="pass_konfirmasi" value="<?= old('pass_konfirmasi') ?>" autocomplete="off">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('pass_konfirmasi'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary">Ubah Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>