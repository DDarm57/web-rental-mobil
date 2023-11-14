<?= $this->extend('layout/template'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <div class="card">
        <form action="<?= site_url('admin/buat_jadwal'); ?>" method="POST">
            <input type="hidden" name="status" value="dijadwalkan">
            <div class="card-header bg-info">
                transaksi
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card-header">
                            Pilih Merek Mobil
                        </div>
                        <div class="card-body" style="overflow-x: auto;">
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Pilih</th>
                                        <th>No</th>
                                        <th>ID Mobil</th>
                                        <th>Merek</th>
                                        <th style="width: 100%;">No Pol</th>
                                        <th>Biaya</th>
                                        <th>Jumlah Kursi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $n = 1; ?>
                                    <?php foreach ($mobil as $m) : ?>
                                        <tr>
                                            <td>
                                                <input type="radio" name="id_mobil" value="<?= $m['id_mobil']; ?>" id="buka">
                                            </td>
                                            <td><?= $n++; ?></td>
                                            <td><?= $m['id_mobil']; ?></td>
                                            <td><?= $m['merek']; ?></td>
                                            <td><?= $m['no_pol']; ?></td>
                                            <td>
                                                <?= $m['biaya']; ?>
                                            </td>
                                            <td><?= $m['jumlah_kursi']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <small class="text-danger"><?= $validation->getError('id_mobil'); ?></small>
                    </div>
                    <div class="col-sm-6">
                        <div class="card-header">
                            Penyewa
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Pilih</th>
                                        <th>No</th>
                                        <th>ID Penyewa</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Jenis Kelamin</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Pilih</th>
                                        <th>No</th>
                                        <th>ID Penyewa</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Jenis Kelamin</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $n = 1; ?>
                                    <?php foreach ($penyewa as $p) : ?>
                                        <tr>
                                            <td>
                                                <input type="radio" name="id_penyewa" value="<?= $p['id_penyewa']; ?>">
                                            </td>
                                            <td><?= $n++; ?></td>
                                            <td><?= $p['id_penyewa']; ?></td>
                                            <td><?= $p['nik']; ?></td>
                                            <td><?= $p['nama']; ?></td>
                                            <td><?= $p['alamat']; ?></td>
                                            <td><?= $p['jenis_kelamin']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <small class="text-danger"><?= $validation->getError('id_penyewa'); ?></small>
                    </div>
                    <div class="col-sm-6">
                        <label for="waktu_boking">Waktu Boking</label>
                        <input type="time" class="form-control" id="appt" name="waktu_boking">
                    </div>
                    <div class="col-sm-6">
                        <label for="waktu_boking">Tutup Boking</label>
                        <input type="time" class="form-control" id="appt" name="tutup_boking">
                    </div>
                    <div class="col-sm-6">
                        <label for="">Tanggal Sewa</label>
                        <input type="date" class="form-control <?= ($validation->hasError('tanggal_sewa')) ? 'is-invalid' : ''; ?>" name="tanggal_sewa">
                        <div class="invalid-feedback"><?= $validation->getError('tanggal_sewa'); ?></div>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Tanggal Kembali</label>
                        <input type="date" forma class="form-control <?= ($validation->hasError('tanggal_kembali')) ? 'is-invalid' : ''; ?>" name="tanggal_kembali">
                        <div class="invalid-feedback"><?= $validation->getError('tanggal_kembali'); ?></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="bayar_dp">Bayar DP</label>
                            <input type="text" class="form-control" name="bayar_dp">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>

    <?php if (session()->getFlashdata('pesan_merah')) : ?>
        <div class="alert alert-danger mt-2 mb-2" role="alert">
            <?= session()->getFlashdata('pesan_merah'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('pesan_hijau')) : ?>
        <div class="alert alert-success mt-2 mb-2" role="alert">
            <?= session()->getFlashdata('pesan_hijau'); ?>
        </div>
    <?php endif; ?>

    <div class="card mt-2 mb-2">
        <div class="card-header bg-info text-light">
            Data Jadwal Sewa
        </div>
        <div class="card-body" style="overflow-x: auto;">
            <h5>Sekarang adalah Jam :</h5>
            <h5 style="font-size: 20px; font-family: arial;" id="jam"></h5>
            <table id="myTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Mobil</th>
                        <th>ID Penyewa</th>
                        <th>Waktu_boking</th>
                        <th>Tutup Boking</th>
                        <th>DP Dibayar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 1; ?>
                    <?php $now = date('H-i-s'); ?>
                    <?php foreach ($jadwal as $j) : ?>
                        <tr>
                            <td><?= $n++; ?></td>
                            <td><?= $j['J_mobilID']; ?></td>
                            <td><?= $j['J_penyewaID']; ?></td>
                            <td><?= $j['waktu_boking']; ?></td>
                            <td><?= $j['tutup_boking']; ?></td>
                            <td><?= $j['bayar_dp']; ?></td>
                            <td><?= $j['status']; ?></td>
                            <td>
                                <a href="<?= site_url('admin/update_jadwal'); ?>/<?= $j['J_penyewaID']; ?>" class="btn btn-warning">Update</a>
                                <a href="" class="btn btn-danger" data-toggle="modal" id="hapus_jadwal" data-id_jadwal="<?= $j['J_penyewaID']; ?>" data-target="#exampleModalHapus"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-info"></i> info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        Jika anda <strong class="text-danger">manghapus</strong> jadwal sewa maka akan <strong class="text-danger">manghapus</strong> juga list di bagian data transaksi yang sedang berjalan
                        apakah anda yakin akan menghapus data jadwal ?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <form action="<?= site_url('admin/hapus_jadwal'); ?>">
                        <input type="hidden" id="id_jadwal" name="id_jadwal">
                        <button type="submit" class="btn btn-primary">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>