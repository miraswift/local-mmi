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

    <?php

    $total_downtime_card = 0;

    foreach ($downtimes as $downtime) {
        $start_downtime = new DateTime($downtime['date_start_downtime']);
        $end_downtime = new DateTime($downtime['date_done_downtime']);

        $dwntime_diff = $start_downtime->diff($end_downtime);

        $total_downtime = $dwntime_diff->days . "Hari " . $dwntime_diff->h . "Jam " . $dwntime_diff->i . "Menit " . $dwntime_diff->s . "Detik";

        $total_minutes = ($dwntime_diff->days * 24 * 60);
        $total_minutes += ($dwntime_diff->h * 60);
        $total_minutes += $dwntime_diff->i;

        $total_downtime_card += $total_minutes;
    }

    ?>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box shadow-none">
                                <span class="info-box-icon bg-olive elevation-1"><i class="fas fa-clock"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Ttl Downtime</span>
                                    <span class="info-box-number">
                                        <?= number_format($total_downtime_card / 60, 2, '.', ',') . " Jam" ?>
                                        <!-- <small>%</small> -->
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-2">
                            <!-- <div class="info-box shadow-none">
                                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-check-alt"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Ttl Byr</span>
                                    <span class="info-box-number">
                                        <?= 0 ?>
                                    </span>
                                </div>
                            </div> -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-2">
                            <!-- <div class="info-box shadow-none">
                                <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-money-bill"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Sisa</span>
                                    <span class="info-box-number">
                                        <?= 0 ?>
                                    </span>
                                </div>
                            </div> -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-2">
                        </div>
                        <div class="col-12 col-sm-6 col-md-2">
                        </div>
                        <div class="col-12 col-sm-6 col-md-2">
                            <a class="btn btn-success btn-block py-3" data-toggle="modal" data-target="#filter-modal">
                                <h3><i class="fas fa-filter"></i>&nbsp;&nbsp;Filter</h3>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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
                                            <th>Detail</th>
                                            <th>Penyelesaian</th>
                                            <th>Start Downtime</th>
                                            <th>Done Downtime</th>
                                            <th>Total Downtime</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($downtimes as $downtime): ?>
                                            <?php
                                            $start_downtime = new DateTime($downtime['date_start_downtime']);
                                            $end_downtime = new DateTime($downtime['date_done_downtime']);

                                            $dwntime_diff = $start_downtime->diff($end_downtime);

                                            $total_downtime = $dwntime_diff->days . "Hari " . $dwntime_diff->h . "Jam " . $dwntime_diff->i . "Menit " . $dwntime_diff->s . "Detik";

                                            $total_minutes = ($dwntime_diff->days * 24 * 60);
                                            $total_minutes += ($dwntime_diff->h * 60);
                                            $total_minutes += $dwntime_diff->i;
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td><?= $downtime['equipment_downtime'] ?></td>
                                                <td><?= $downtime['detail_downtime'] ?></td>
                                                <td><?= $downtime['detail_done_downtime'] ?></td>
                                                <td><?= $downtime['date_start_downtime'] ?></td>
                                                <td><?= $downtime['date_done_downtime'] ?? 'Dalam penanganan' ?></td>
                                                <td><?= number_format($total_downtime_card / 60, 2, '.', ',') . " Jam" ?></td>
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
                                    <?php foreach ($equipmentDowntimes as $equipmentDowntime): ?>
                                        <option value="<?= $equipmentDowntime['name_equipment_downtime'] ?>"><?= $equipmentDowntime['name_equipment_downtime'] ?></option>
                                    <?php endforeach; ?>
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
<!-- Filter Modal -->
<div class="modal fade" id="filter-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah <?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/downtime" method="get">
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
                                <label for="date" class="col-form-label">Tanggal</label>
                                <input type="date" name="date" class="form-control">
                                <div id="date_error" class="invalid-feedback">
                                    <?= validation_show_error('date') ?>
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