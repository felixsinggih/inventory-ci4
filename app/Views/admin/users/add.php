<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('admin/save') ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="nm_user" class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('nm_user')) ? 'is-invalid' : ''; ?>" id="nm_user" name="nm_user" value="<?= old('nm_user'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nm_user'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= old('username'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= old('password'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="level" class="col-sm-2 col-form-label">Level</label>
                        <div class="col-sm-10">
                            <select class="custom-select <?= ($validation->hasError('level')) ? 'is-invalid' : ''; ?>" id="level" name="level">
                                <?php if (empty(old('level'))) { ?>
                                    <option value="" selected disabled>Pilih Level</option>
                                <?php } else { ?>
                                    <option value="<?= old('level') ?>"><?= old('level'); ?></option>
                                <?php } ?>
                                <option value="Admin">Admin</option>
                                <option value="Operator">Operator</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('level'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select class="custom-select <?= ($validation->hasError('status')) ? 'is-invalid' : ''; ?>" id="status" name="status">
                                <?php if (empty(old('status'))) { ?>
                                    <option value="" selected disabled>Pilih Status</option>
                                <?php } else { ?>
                                    <option value="<?= old('status') ?>"><?= old('status'); ?></option>
                                <?php } ?>
                                <option value="Aktif">Aktif</option>
                                <option value="Non Aktif">Non Aktif</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('status'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>