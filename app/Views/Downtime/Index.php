<?= $this->extend('Layout/Template_Main') ?>
<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><?= $menuGroup ?></a></li>
                        <li class="breadcrumb-item active"><?= $menu ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="#" class="btn bg-teal float-right" data-toggle="modal" data-target="#add-modal" title="Tambah Data"><i class="fas fa-plus"></i>&nbsp; <b>Tambah Data</b></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm table-bordered" id="table-global">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nama</th>
                                            <th>Start Downtime</th>
                                            <th>Done Downtime</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($downtimes as $downtime): ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td><?= $downtime['equipment_downtime'] ?></td>
                                                <td><?= $downtime['date_start_downtime'] ?></td>
                                                <td><?= $downtime['date_done_downtime'] ?? 'Dalam penanganan' ?></td>
                                                <!-- <td class="text-right">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="text-left">Rp</div>
                                                        <div class="text-right"><?= number_format(0, 0, ',', '.') ?></div>
                                                    </div>
                                                </td> -->
                                                <td>
                                                    <?php if (session('level_user') == 'maintennance' || session('level_user') == 'superadmin' || session('level_user') == 'admin'): ?>
                                                        <?php if ($downtime['status_downtime'] == 'Waiting'): ?>
                                                            <a href="#" data-toggle="modal" data-target="#edit-modal<?= $downtime['id_downtime'] ?>" class="btn bg-teal" title="Edit"><i class="fas fa-check"></i></a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if (session('level_user') == 'superadmin' || session('level_user') == 'admin'): ?>
                                                        <?php if ($downtime['status_downtime'] == 'Waiting'): ?>
                                                            <a href="#" data-toggle="modal" data-target="#delete-modal<?= $downtime['id_downtime'] ?>" class="btn bg-danger" title="Hapus"><i class="fas fa-trash"></i></a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <!-- Modal Delete -->
                                            <div class="modal fade" id="delete-modal<?= $downtime['id_downtime'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle text-danger"></i></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah anda yakin akan menghapus data <?= $title ?>?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="/downtime/delete" method="post" class="d-inline">
                                                                <?= csrf_field() ?>
                                                                <input type="hidden" name="id_downtime" value="<?= $downtime['id_downtime'] ?>">
                                                                <button type="submit" class="btn bg-danger">Ya, Hapus</button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="edit-modal<?= $downtime['id_downtime'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit <?= $title ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/downtime/update" method="post">
                                                            <!-- Hidden Form untuk merubah method menjadi PATCH -->
                                                            <input type="hidden" name="id_downtime" value="<?= $downtime['id_downtime'] ?>">
                                                            <?= csrf_field() ?>
                                                            <div class="modal-body">
                                                                <?php if (session()->getFlashdata('failed')) : ?>
                                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                        <strong><i class="fas fa-exclamation-triangle"></i></strong> &nbsp; <?= session()->getFlashdata('failed') ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="equipment_downtime" class="col-form-label">Equipment</label>
                                                                            <input type="text" class="form-control" value="<?= $downtime['equipment_downtime'] ?>" readonly>
                                                                            <!-- Validation Error Msg -->
                                                                            <div id="equipment_downtime_error" class="invalid-feedback">
                                                                                <?= validation_show_error('equipment_downtime') ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="equipment_downtime" class="col-form-label">Start Downtime</label>
                                                                            <input type="text" class="form-control" value="<?= $downtime['date_start_downtime'] ?>" readonly>
                                                                            <!-- Validation Error Msg -->
                                                                            <div id="equipment_downtime_error" class="invalid-feedback">
                                                                                <?= validation_show_error('equipment_downtime') ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="detail_downtime" class="col-form-label">Detail / Keterangan Downtime</label>
                                                                            <textarea name="detail_downtime" id="" cols="30" rows="5" class="form-control" readonly><?= $downtime['detail_downtime'] ?></textarea>
                                                                            <!-- Validation Error Msg -->
                                                                            <div id="detail_downtime_error" class="invalid-feedback">
                                                                                <?= validation_show_error('detail_downtime') ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="detail_done_downtime" class="col-form-label">Detail / Keterangan Penyelesaian</label>
                                                                            <textarea name="detail_done_downtime" id="" cols="30" rows="5" class="form-control"></textarea>
                                                                            <!-- Validation Error Msg -->
                                                                            <div id="detail_done_downtime_error" class="invalid-feedback">
                                                                                <?= validation_show_error('detail_done_downtime') ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn bg-teal">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- Add Modal -->
<div class="modal fade" id="add-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah <?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/downtime/create" method="post">
                <div class="modal-body">
                    <?php if (session()->getFlashdata('failed')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-exclamation-triangle"></i></strong> &nbsp; <?= session()->getFlashdata('failed') ?>
                            <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button> -->
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name_downtime" class="col-form-label">Equipment</label>
                                <select name="equipment_downtime" id="" class="form-control select2bs4">
                                    <option value="Jetflo 1">Jetflo 1</option>
                                    <option value="Jetflo 2">Jetflo 2</option>
                                    <option value="Jetflo Powder">Jetflo Powder</option>
                                    <option value="Screw Pasir 1">Screw Pasir 1</option>
                                    <option value="Screw Pasir 2">Screw Pasir 2</option>
                                    <option value="Screw Semen">Screw Semen</option>
                                    <option value="Screw Kapur">Screw Kapur</option>
                                    <option value="Hopper Additif">Hopper Additif</option>
                                    <option value="Weighing Hopper Powder">Weighing Hopper Powder</option>
                                    <option value="Weighing Hopper Pasir">Weighing Hopper Pasir</option>
                                    <option value="Mixer 1 Ton">Mixer 1 Ton</option>
                                    <option value="Packer">Packer</option>
                                    <option value="Jetflo Tile Grout">Jetflo Tile Grout</option>
                                    <option value="Mixer Tile Grout">Mixer Tile Grout</option>
                                    <option value="Auger">Auger</option>
                                    <option value="Ketrukan">Ketrukan</option>
                                    <option value="Mesin Seal">Mesin Seal</option>
                                    <option value="Vibrator Fletening">Vibrator Fletening</option>
                                    <option value="Kompressor 1">Kompressor 1</option>
                                    <option value="Kompressor 2">Kompressor 2</option>
                                    <option value="Forklift Merah">Forklift Merah</option>
                                    <option value="Forklift Putih">Forklift Putih</option>
                                    <option value="Loader">Loader</option>
                                    <option value="Lain-Lain">Lain-Lain</option>
                                </select>
                                <!-- Validation Error Msg -->
                                <div id="name_downtime_error" class="invalid-feedback">
                                    <?= validation_show_error('name_downtime') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="detail_downtime" class="col-form-label">Detail / Keterangan Downtime</label>
                                <textarea name="detail_downtime" id="" cols="30" rows="5" class="form-control"></textarea>
                                <!-- Validation Error Msg -->
                                <div id="detail_downtime_error" class="invalid-feedback">
                                    <?= validation_show_error('detail_downtime') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-teal">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>