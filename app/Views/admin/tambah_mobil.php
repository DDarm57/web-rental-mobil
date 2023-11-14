<?= $this->extend('layout/template'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header bg-info text-light">
            Form tambah data mobil
        </div>
        <div class="card-body">
            <form action="<?= site_url('admin/simpan_mobil'); ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="merek">Merek</label>
                            <input type="text" name="merek" id="merek" class="form-control <?= ($validation->hasError('merek')) ? 'is-invalid' : ''; ?>">
                            <div class="invalid-feedback"><?= $validation->getError('merek'); ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="no_pol">No Pol/Plat Nomor</label>
                            <input type="text" name="no_pol" id="no_pol" class="form-control <?= ($validation->hasError('no_pol')) ? 'is-invalid' : ''; ?>">
                            <div class="invalid-feedback"><?= $validation->getError('no_pol'); ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="biaya">Biaya Sewa</label>
                            <input type="number" name="biaya" id="biaya" class="form-control <?= ($validation->hasError('biaya')) ? 'is-invalid' : ''; ?>">
                            <div class="invalid-feedback"><?= $validation->getError('biaya'); ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="jumlah_jursi">Jumlah Kursi</label>
                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_kursi')) ? 'is-invalid' : ''; ?>" name="jumlah_kursi" id="jumlah_kursi" min="1" max="10">
                            <div class="invalid-feedback"><?= $validation->getError('jumlah_kursi'); ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Tambah Gambar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= ($validation->hasError('gambar_mobil')) ? 'is-invalid' : ''; ?>" name="gambar_mobil" id="gambar_mobil" onchange="preview()">
                            <label class="custom-file-label" for="customFile">Tambah Gambar..</label>
                            <div class="invalid-feedback"><?= $validation->getError('gambar_mobil'); ?></div>
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