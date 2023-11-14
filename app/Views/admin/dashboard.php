<?= $this->extend('layout/template'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card shadow bg-info text-white mb-4">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">
                                Data Penyewa</div>
                            <div class="h5 mb-0 font-weight-bold text-light"><?= $penyewa; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-light"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="<?= site_url('admin/data_penyewa'); ?>">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">
                                Mobil Disewa</div>
                            <div class="h5 mb-0 font-weight-bold text-light"><?= $disewa; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-car-side fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="<?= site_url('admin/transaksi'); ?>">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow bg-success text-white mb-4">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">
                                Diboking</div>
                            <div class="h5 mb-0 font-weight-bold text-light"><?= $jadwal; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="<?= site_url('admin/data_jadwal'); ?>">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">
                                Selesai</div>
                            <div class="h5 mb-0 font-weight-bold text-light"><?= $selesai; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="<?= site_url('admin/transaksi_selesai'); ?>">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                        <div class="mt-3">
                            <h4><?php echo session()->get('full_name') ?></h4>
                            <p class="text-secondary mb-1">ADMIN</p>
                            <p class="text-muted font-size-sm">Alamat : Pamekasan</p>
                        </div>
                    </div>
                    <div class="m-2">
                        <button class="btn btn-warning form-control">Edit</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Welcome</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;" src="/assets/undraw_posting_photo.svg" alt="...">
                    </div>
                    <p><strong>Selamat Datang</strong> di aplikasi admin rental mobil SI IMRIN</p>
                    <a rel="nofollow" href="<?= site_url('admin/data_jadwal'); ?>">Buat Jadwal Sewa Sekarang!</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>