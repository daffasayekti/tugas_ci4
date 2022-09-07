<?= $this->extend('/layouts/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <h3 class="mt-4 mb-4 mx-auto text-center">Data Siswa</h3>
    <button type="button" class="btn btn-primary mb-3 btn-sm" data-bs-toggle="modal" data-bs-target="#createData">
        <i class="fas fa-plus"></i> Tambah Data Siswa
    </button>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashData('success'); ?>
        </div>
    <?php endif; ?>
    <table class="table table-hover table-bordered">
        <thead>
            <tr class="text-center">
                <th scope="col">Kode</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Tempat, Tgl Lahir</th>
                <th scope="col">No. Telepon</th>
                <th scope="col">Alamat</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($dataSiswa as $value) { ?>
                <tr class="text-center">
                    <td><?= $value['kd_siswa']; ?></td>
                    <td><?= $value['nama']; ?></td>
                    <td><?= $value['jenis_kelamin']; ?></td>
                    <td><?= $value['tempat_lahir'] ?>, <?= $value['tanggal_lahir']; ?></td>
                    <td><?= $value['no_telp']; ?></td>
                    <td><?= $value['alamat']; ?></td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editData<?= $value['kd_siswa'] ?>">
                            <i class="fas fa-pencil-alt text-white"></i>
                        </button>
                        <a href="/siswa/delete/<?= $value['kd_siswa']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal Edit -->
<?php foreach ($dataSiswa as $value) { ?>
    <div class="modal fade" id="editData<?= $value['kd_siswa'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/siswa/edit/<?= $value['kd_siswa']; ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <?= csrf_field(); ?>
                        <div class="mb-3">
                            <label for="kd_siswa" class="form-label">Kode Siswa</label>
                            <input type="number" class="form-control <?= ($validation->hasError('kd_siswa')) ? 'is-invalid' : ''; ?>" id="kd_siswa" name="kd_siswa" autofocus value="<?= $value['kd_siswa']; ?>" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('kd_siswa'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= $value['nama'] ?>" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                <?php
                                if ($value['jenis_kelamin'] == 'Pria') {
                                    echo '<option value="Pria" selected>Pria</option>';
                                } else {
                                    echo '<option value="Pria">Pria</option>';
                                }

                                if ($value['jenis_kelamin'] == 'Wanita') {
                                    echo '<option value="Wanita" selected>Wanita</option>';
                                } else {
                                    echo '<option value="Wanita">Wanita</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control <?= ($validation->hasError('tempat_lahir')) ? 'is-invalid' : ''; ?>" id="tempat_lahir" name="tempat_lahir" value="<?= $value['tempat_lahir']; ?>" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tempat_lahir'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control <?= ($validation->hasError('tanggal_lahir')) ? 'is-invalid' : ''; ?>" id="tanggal_lahir" name="tanggal_lahir" value="<?= $value['tanggal_lahir'] ?>" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tanggal_lahir'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">Nomor Telepon</label>
                            <input type="number" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>" id="no_telp" name="no_telp" value="<?= $value['no_telp'] ?>" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_telp'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" value="<?= $value['alamat'] ?>" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('alamat'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>


<!-- Modal Create -->
<div class="modal fade" id="createData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/siswa/create" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="kd_siswa" class="form-label">Kode Siswa</label>
                        <input type="number" class="form-control <?= ($validation->hasError('kd_siswa')) ? 'is-invalid' : ''; ?>" id="kd_siswa" name="kd_siswa" autofocus value="<?= old('kd_siswa'); ?>" autocomplete="off">
                        <div class="invalid-feedback">
                            <?= $validation->getError('kd_siswa'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= old('nama'); ?>" autocomplete="off">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                            <option selected>-- Pilih Jenis Kelamin --</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control <?= ($validation->hasError('tempat_lahir')) ? 'is-invalid' : ''; ?>" id="tempat_lahir" name="tempat_lahir" value="<?= old('tempat_lahir'); ?>" autocomplete="off">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tempat_lahir'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control <?= ($validation->hasError('tanggal_lahir')) ? 'is-invalid' : ''; ?>" id="tanggal_lahir" name="tanggal_lahir" value="<?= old('tanggal_lahir'); ?>" autocomplete="off">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tanggal_lahir'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">Nomor Telepon</label>
                        <input type="number" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>" id="no_telp" name="no_telp" value="<?= old('no_telp'); ?>" autocomplete="off">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_telp'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" value="<?= old('alamat'); ?>" autocomplete="off">
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>