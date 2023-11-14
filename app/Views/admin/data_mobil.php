<?= $this->extend('layout/template'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="mb-2">
        <?php if (session()->getFlashdata('pesan_hijau')) : ?>
            <div class="alert alert-success mt-2 mb-2" role="alert">
                <?= session()->getFlashdata('pesan_hijau'); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="mb-2">
        <?php if (session()->getFlashdata('pesan_merah')) : ?>
            <div class="alert alert-danger mt-2 mb-2" role="alert">
                <?= session()->getFlashdata('pesan_merah'); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="mb-2">
        <a href="<?= site_url('admin/tambah_mobil'); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DataTable Example
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Merek</th>
                        <th>No Pol</th>
                        <th>Biaya</th>
                        <th>Jumlah Kursi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Merek</th>
                        <th>No Pol</th>
                        <th>Biaya</th>
                        <th>Jumlah Kursi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $n = 1; ?>
                    <?php foreach ($mobil as $m) : ?>
                        <tr>
                            <td><?= $n++; ?></td>
                            <td><?= $m['merek']; ?></td>
                            <td><?= $m['no_pol']; ?></td>
                            <td><?= $m['biaya']; ?></td>
                            <td><?= $m['jumlah_kursi']; ?></td>
                            <td>
                                <img src="/assets/mobil/<?= $m['gambar_mobil']; ?>" alt="" style="width: 150px;">
                            </td>
                            <td>
                                <a href="<?= site_url('admin/edit_mobil'); ?>/<?= $m['id_mobil']; ?>" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                                <a href="<?= site_url('admin/hapus_mobil'); ?>" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalHapus" data-id_mobil="<?= $m['id_mobil']; ?>" data-merek="<?= $m['merek']; ?>" id="hapus_mobil"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

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
                        <div class="mb-2">
                            <h2 id="merek"></h2>
                        </div>
                        jika ada yang salah di bagian data bisa menggunakan form edit data
                        jika yakin ingin menghapsu data klik di bagian tombol hapus
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <form action="<?= site_url('admin/hapus_mobil'); ?>">
                        <input type="hidden" id="id_mobil" name="id_mobil">
                        <button type="submit" class="btn btn-primary">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>