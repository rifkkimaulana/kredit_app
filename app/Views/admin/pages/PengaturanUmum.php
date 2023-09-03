<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <form role="form" method="post" action="<?= base_url('pengaturan/umum/update'); ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pengaturan Umum</h3>
                        </div>
                        <div class="card-body">
                            <input type="hidden" class="form-control" name="logoLama" value="<?= $perusahaan['logo']; ?>">
                            <div class="form-group">
                                <label for="nama_aplikasi">Nama Aplikasi</label>
                                <input type="text" class="form-control" name="nama_aplikasi" value="<?= $perusahaan['nama_aplikasi']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="nama_perusahaan">Nama Perusahaan</label>
                                <input type="text" class="form-control" name="nama_perusahaan" value="<?= $perusahaan['nama_perusahaan']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="alamat1">Alamat 1</label>
                                <input type="text" class="form-control" name="alamat1" value="<?= $perusahaan['alamat1']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="alamat2">Alamat 2</label>
                                <input type="text" class="form-control" name="alamat2" value="<?= $perusahaan['alamat2']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="kode_pos">Kode Pos</label>
                                <input type="text" class="form-control" name="kode_pos" value="<?= $perusahaan['kode_pos']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="<?= $perusahaan['email']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="telpon">Telpon</label>
                                <input type="text" class="form-control" name="telpon" value="<?= $perusahaan['telpon']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Rekening Bank</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="no_rekening">Bank 1</label>
                                        <input type="text" class="form-control" name="bank1" value="<?= $perusahaan['bank1']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="atas_nama">Atas Nama</label>
                                        <input type="text" class="form-control" name="atas_nama1" value="<?= $perusahaan['atas_nama1']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bank">No Rekening</label>
                                        <input type="text" class="form-control" name="no_rekening1" value="<?= $perusahaan['no_rekening1']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="no_rekening">Bank 2</label>
                                        <input type="text" class="form-control" name="bank2" value="<?= $perusahaan['bank2']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="atas_nama">Atas Nama</label>
                                        <input type="text" class="form-control" name="atas_nama2" value="<?= $perusahaan['atas_nama2']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bank">No Rekening</label>
                                        <input type="text" class="form-control" name="no_rekening2" value="<?= $perusahaan['no_rekening2']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="no_rekening">Bank 3</label>
                                        <input type="text" class="form-control" name="bank3" value="<?= $perusahaan['bank3']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="atas_nama">Atas Nama</label>
                                        <input type="text" class="form-control" name="atas_nama3" value="<?= $perusahaan['atas_nama3']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bank">No Rekening</label>
                                        <input type="text" class="form-control" name="no_rekening3" value="<?= $perusahaan['no_rekening3']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Logo Aplikasi</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <img src="<?= base_url('assets/image/perusahaan/' . $perusahaan['logo']); ?>" alt="Logo Saat Ini" style="max-width: 200px;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="new_logo">Pilih Logo Baru</label>
                                        <input type="file" class="form-control" name="logonew">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- /.content -->

<?= $this->endSection(); ?>