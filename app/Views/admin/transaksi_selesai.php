<?= $this->extend('layout/template'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <?php if (session()->getFlashdata('pesan_hijau')) : ?>
        <div class="alert alert-success mt-2 mb-2" role="alert">
            <?= session()->getFlashdata('pesan_hijau'); ?>
        </div>
    <?php endif; ?>

    <div class="card mt-2 mb-2">
        <div class="card-header bg-info text-light">
            Data Transaksi
        </div>
        <div class="card-body">
            <table id="example" class="table table-striped table-bordered dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Mobil</th>
                        <th>ID Penyewa</th>
                        <th>Waktu Boking</th>
                        <th>Tutup Boking</th>
                        <th>Tanggal Sewa</th>
                        <th>Tanggal Kembali</th>
                        <th>Biaya Sewa Mobil</th>
                        <th>Total Hari Sewa</th>
                        <th>Total Biaya Sewa Semua</th>
                        <th>Terlambat</th>
                        <th>Total Denda</th>
                        <th>DP Dibayar</th>
                        <th>TOTAL</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 1; ?>
                    <?php $now = date('Y-m-d'); ?>
                    <?php foreach ($selesai as $t) : ?>
                        <tr>
                            <td><?= $n++; ?></td>
                            <td><?= $t['S_mobilID']; ?></td>
                            <td><?= $t['S_penyewaID']; ?></td>
                            <td><?= $t['boking_waktu']; ?></td>
                            <td><?= $t['boking_tutup']; ?></td>
                            <td><?= $t['sewa']; ?></td>
                            <td><?= $t['kembali']; ?></td>
                            <td><?= $t['biaya_sewaMobil']; ?></td>
                            <td><?= $t['total_hariSewa']; ?></td>
                            <td><?= $t['total_biayaSewa']; ?></td>
                            <td><?= $t['terlambat_sewa']; ?></td>
                            <td><?= $t['total_denda']; ?></td>
                            <td><?= $t['dp']; ?></td>
                            <td><?= $t['total_keseluruhan']; ?></td>
                            <td>
                                <a href="" class="btn btn-warning">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>