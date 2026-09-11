<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3"></div>
        <div class="card-body">

            <?php echo $message; ?>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Status PIN</th>
                            <th>PIN</th>
                            <th>Aktifkan PIN</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Status PIN</th>
                            <th>PIN</th>
                            <th>AKtifkan PIN</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($voter as $voter) : ?>
                        <tr>
                            <td><?php echo $voter['name']; ?></td>
                            <td><?php echo $voter['information']; ?></td>
                            <td>
                                <?php 
                                    $status = $voter['status']; 
                                    if($status == "INACTIVE" ) {
                                        $badge = "danger";
                                    } elseif($status == "ACTIVE") {
                                        $badge = "warning";
                                    } else {
                                        $badge = "success";
                                    }
                                    ?>
                                <span class="badge badge-pill badge-<?php echo $badge; ?>">
                                    <?php echo $voter['status']; ?>
                                </span>
                            </td>
                            <td><?php echo $voter['pin']; ?></td>
                            <td width="200px">
                                <form action="<?php echo site_url('dashboard/activePIN'); ?>" method="post">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <input type="hidden" name="id" value="<?php echo $voter['id']; ?>">
                                    <input type="hidden" name="pin" value="<?php echo $voter['pin']; ?>">
                                    <input type="hidden" name="status" value="ACTIVE">
                                    <input type="hidden" name="active" value="<?php echo date('Y-m-d H:i:s');?>">
                                    <button type="submit" class="btn btn-success" <?php echo ($voter['status'] == "INACTIVE") ? "" : "disabled"; ?>>Aktifkan</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <hr>
            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#voter">Tambah</a>
            <a class="btn btn-info" href="<?php echo site_url('dashboard/print'); ?>" target="blank">Cetak</a>

        </div>
    </div>

</div>

<!-- Add Voter Modal-->
<div class="modal fade" id="voter" tabindex="-1" role="dialog" aria-labelledby="voter" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="voter">Tambah Pemilih</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <?php echo form_open_multipart('dashboard/voter'); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nama Pemilih">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="information" class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                        <select class="custom-select" name="information" id="information">
                            <option value="Siswa">Siswa</option>
                            <option value="Guru">Guru</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pin" class="col-sm-3 col-form-label">PIN</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="pin" id="pin" value="<?php echo $pin; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
        </div>
    </div>
</div>