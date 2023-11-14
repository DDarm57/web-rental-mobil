<?= $this->extend('layout/template'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <?php if (session()->getFlashdata('pesan_hijau')) { ?>
        <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
            <strong>Berhasil!!!</strong> <?= session()->getFlashdata('pesan_hijau'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
    <?php if (session()->getFlashdata('pesan_merah')) { ?>
        <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
            <strong>Gagal!!!</strong> <?= session()->getFlashdata('pesan_merah'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
    <div class="mb-2">
        <a href="<?= site_url('admin/tambah_penyewa'); ?>" class="btn btn-primary"><i class="fas fa-user-plus"></i> Tambah Data</a>
    </div>
    <div class="card mb-4">
        <div class="card-header bg-info text-light">
            <i class="fas fa-table me-1"></i>
            DataTable Example
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nik</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nik</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $n = 1; ?>
                    <?php foreach ($penyewa as $p) : ?>
                        <tr>
                            <td><?= $n++; ?></td>
                            <td><?= $p['nik']; ?></td>
                            <td><?= $p['nama']; ?></td>
                            <td><?= $p['alamat']; ?></td>
                            <td><?= $p['jenis_kelamin']; ?></td>
                            <td>
                                <img src="/assets/penyewa/<?= $p['gambar_penyewa']; ?>" alt="" style="width: 120px;">
                            </td>
                            <td>
                                <a href="<?= site_url('admin/edit_penyewa'); ?>/<?= $p['id_penyewa']; ?>" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                                <a href="" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalHapus" id="hapus_penyewa" data-id_penyewa="<?= $p['id_penyewa']; ?>" data-nik="<?= $p['nik']; ?>" data-nama="<?= $p['nama']; ?>"><i class="fas fa-trash"></i></a>
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
                        <div class="row">
                            <div class="col-sm-6">
                                <h4>Nik :</h4>
                                <h4 id="nik"></h4>
                            </div>
                            <div class="col-sm-6">
                                <h4>Nama :</h4>
                                <h4 id="nama"></h4>
                            </div>
                        </div>
                        jika ada yang salah di bagian data bisa menggunakan form edit data.<br>
                        jika yakin ingin menghapus data klik di bagian tombol hapus
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <form action="<?= site_url('admin/hapus_penyewa'); ?>">
                        <input type="hidden" id="id_penyewa" name="id_penyewa">
                        <button type="submit" class="btn btn-primary">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>