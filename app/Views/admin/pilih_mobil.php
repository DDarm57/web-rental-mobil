<?= $this->extend('layout/template'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid px-4">

    <div class="row">
        <?php $get_id = $id->id_mobil ?>
        <?php foreach ($get as $m) : ?>
            <div class="col-xl-3 col-md-6 m-2">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcToyN3D8MSuRlDY1ZYeyNud5CrMKz7qquVuXi8e6wf8B2pyz76nOB7bFsMPa0Z_-Yc6D_0&usqp=CAU" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?= $m['merek']; ?></h5>
                        <hr>
                        <p class="card-text">NO POL : <?= $m['no_pol']; ?></p>
                        <hr>
                        <p class="card-text">Biaya : <?= $m['biaya']; ?></p>
                        <hr>
                        <p class="card-text">Jumlah Kursi : <?= $m['jumlah_kursi']; ?></p>
                        <hr>
                        <!-- Button trigger modal -->

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?= $m['id_mobil']; ?>">
                            Sewa
                        </button>
                        <!-- <a href="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">CEk</a> -->
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal<?= $get_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Penyewa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <a href="" class="btn btn-primary">Transaksi Baru</a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nik</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1; ?>
                            <?php foreach ($penyewa as $p) : ?>
                                <tr>
                                    <th scope="row"><?= $n++; ?></th>
                                    <td><?= $p['nik']; ?></td>
                                    <td><?= $p['nama']; ?></td>
                                    <td><?= $p['alamat']; ?></td>
                                    <td><?= $p['jenis_kelamin']; ?></td>
                                    <td>
                                        <a href="<?= site_url('admin/transaksi'); ?>/<?= $p['id_penyewa']; ?>/<?= $get_id; ?>" class="btn btn-warning"><i class="fas fa-plus"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>