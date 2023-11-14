<?= $this->extend('layout/template'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

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
            Data Transaksi
        </div>
        <div class="card-body">
            <table id="example" class="table table-striped table-bordered dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Mobil</th>
                        <th>ID Penyewa</th>
                        <th>Biaya</th>
                        <th>Tanggal Sewa</th>
                        <th>Tanggal Kembali</th>
                        <th>DP Dibayar</th>
                        <th>Status Jadwal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 1; ?>
                    <?php $now = date('Y-m-d'); ?>
                    <?php foreach ($transaksi as $t) : ?>
                        <tr>
                            <td><?= $n++; ?></td>
                            <td><?= $t['mobil_id']; ?></td>
                            <td><?= $t['penyewa_id']; ?></td>
                            <td><?= $t['harga']; ?></td>
                            <td><?= $t['tanggal_sewa']; ?></td>
                            <td>
                                <p class="<?= ($now > $t['tanggal_kembali']) ? 'text-danger' : ''; ?>">
                                    <strong><?= $t['tanggal_kembali']; ?></strong>
                                    <small><?= ($now > $t['tanggal_kembali']) ? 'Terlambat'  : ''; ?></small>
                                </p>
                            </td>
                            <td><?= $t['dp_dibayar']; ?></td>
                            <td><?= $t['status_jadwal']; ?></td>
                            <td>
                                <a href="<?= site_url('admin/cek_detail'); ?>/<?= $t['penyewa_id']; ?>" class="btn btn-warning">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>