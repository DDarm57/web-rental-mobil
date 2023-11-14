<?= $this->extend('layout/template'); ?>

<?= $this->section('page-content'); ?>


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="/assets/penyewa/<?= $penyewa->gambar_penyewa; ?>" alt="avatar" style="width: 150px;" class="img-thumbnail">
                    <h5 class="my-3"><?= $penyewa->nama; ?></h5>
                    <p class="text-muted mb-1">NIK : <?= $penyewa->nik; ?></p>
                    <p class="text-muted mb-4">ALAMAT : <?= $penyewa->alamat; ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header bg-info text-light">
                    Mobil Disewa
                </div>
                <div class="card-body">
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Merek</th>
                                <th scope="col">No Pol</th>
                                <th scope="col">Biaya</th>
                                <th scope="col">Jumlah Kursi</th>
                                <th scope="col">Biaya Sewa</th>
                                <th scope="col">Sewa Perhari</th>
                                <th scope="col">Total Sewa</th>
                                <th scope="col">Dp Dibayar</th>
                                <th scope="col">Terlambat</th>
                                <th scope="col">Denda</th>
                                <th scope="col">Total Hari</th>
                                <th scope="col">Total</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mobil as $m) : ?>
                                <tr>
                                    <td><?= $m['merek']; ?></td>
                                    <td><?= $m['no_pol']; ?></td>
                                    <td><?= $m['harga']; ?></td>
                                    <td><?= $m['jumlah_kursi']; ?></td>
                                    <td><?= $m['harga']; ?></td>
                                    <td><?= $m['sewa_perhari']; ?> Hari</td>
                                    <td><?= $m['total_sewa']; ?></td>
                                    <td><?= $m['dp_dibayar']; ?></td>
                                    <td><?= $m['terlambat']; ?> Hari</td>
                                    <td><?= $m['denda']; ?></td>
                                    <td><?= $m['total_hari']; ?></td>
                                    <td><?= $m['total']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            Cek Nota
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cekout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= site_url('admin/bayar'); ?>" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="">Mobil Disewa</label>
                                <h5><?= $cekout->merek; ?></h5>
                                <input type="hidden" class="form-control" name="S_mobilID" value="<?= $cekout->mobil_id; ?>">
                            </div>
                            <div class="col-sm-6">
                                <label for="">Penyewa</label>
                                <h5><?= $penyewa->nama; ?></h5>
                                <input type="hidden" class="form-control" name="S_penyewaID" value="<?= $cekout->penyewa_id; ?>">
                            </div>
                            <div class="col-sm-6">
                                <label for="">Waktu Boking</label>
                                <input type="text" class="form-control" name="boking_waktu" value="<?= $jadwal->waktu_boking; ?>" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Tutup Boking</label>
                                <input type="text" class="form-control" name="boking_tutup" value="<?= $jadwal->tutup_boking; ?>" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Tanggal Sewa</label>
                                <input type="text" class="form-control" name="sewa" value="<?= $cekout->tanggal_sewa; ?>" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Tanggal Kembali</label>
                                <input type="text" class="form-control" name="kembali" value="<?= $cekout->tanggal_kembali; ?>" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Biaya Sewa Mobil</label>
                                <input type="text" class="form-control" name="biaya_sewaMobil" value="<?= $cekout->harga; ?>" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Total Hari Sewa</label>
                                <input type="text" class="form-control" name="total_hariSewa" value="<?= $cekout->sewa_perhari; ?>" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Terlambat</label>
                                <input type="text" class="form-control" name="terlambat_sewa" value="<?= $cekout->terlambat; ?>" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Total Denda</label>
                                <input type="text" class="form-control <?= ($cekout->denda > 0) ? 'text-danger' : 'text-success'; ?>" name="total_denda" value="<?= $cekout->denda; ?>" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Total Hari Semua</label>
                                <input type="text" class="form-control" name="total_hariSemua" value="<?= $cekout->total_hari; ?>" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label for="">DP Dibayar</label>
                                <input type="text" class="form-control" name="dp" value="<?= $cekout->dp_dibayar; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">TOTAL BIAYA SEWA SEMUA</label>
                            <input type="text" class="form-control form-control-lg" name="total_biayaSewa" value="<?= $cekout->total_sewa; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">JUMLAH TOTAL YANG HARUS DI BAYAR</label>
                            <input class="form-control form-control-lg" type="text" name="total_keseluruhan" value="<?= $cekout->total; ?>" readonly>
                            <small class="text-dark bg-warning">Total keseluruhan dikurangi dp dibayar</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" onclick="return ('apakah anda yakin ingin membayar')">BAYAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>