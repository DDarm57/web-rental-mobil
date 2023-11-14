<?= $this->extend('layout/template'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header bg-info text-light">
            Form tambah data penyewa
        </div>
        <div class="card-body">
            <form action="<?= site_url('admin/simpan_penyewa'); ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" name="nik" id="nik" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>">
                            <div class="invalid-feedback"><?= $validation->getError('nik'); ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>">
                            <div class="invalid-feedback"><?= $validation->getError('nama'); ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>">
                            <div class="invalid-feedback"><?= $validation->getError('alamat'); ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Jenis Kelamin</label>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio1" value="Laki-laki" name="jenis_kelamin">
                                <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio2" value="Perempuan" name="jenis_kelamin">
                                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                            </div>
                            <small class="text-danger"><?php echo $validation->getError('jenis_kelamin') ?></small>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Tambah Gambar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= ($validation->hasError('gambar_penyewa')) ? 'is-invalid' : ''; ?>" name="gambar_penyewa" id="gambar_penyewa" onchange="preview()">
                            <label class="custom-file-label" for="customFile">Tambah Gambar..</label>
                            <div class="invalid-feedback"><?= $validation->getError('gambar_penyewa'); ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mt-2">
                            <img src="/assets/penyewa/default.jpg" class="img-thumbnail img-preview" alt="default" style="width: 150px;">
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>