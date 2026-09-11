<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
    </div>


    <?php echo $message; ?>

    <div class="row">
    <?php foreach($candidate as $candidate) : ?>
        <div class="col-lg-3">
            <div class="card shadow mb-4 text-center">
                <div class="card-body">
                    <h1 class="display-1"><?php echo $candidate['number']; ?></h1>
                    <img src="<?php echo base_url('assets/img/' . $candidate['photo']) ?>" alt="Kandidat" class="img-fluid rounded"><hr>
                    <h2><?php echo $candidate['name1']; ?></h2>
                    <h2><?php echo $candidate['name2']; ?></h2>

                    <a class="btn btn-primary btn-danger btn-block" href="<?php echo site_url('dashboard/delete/' . $candidate['number'] . '/' . $candidate['photo']) ?>">Hapus</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#candidate">Tambah</a>
            <a class="btn btn-success" href="#" data-toggle="modal" data-target="#result">Hasil</a>
        </div>
    </div>


</div>

<!-- Add Candidate Modal-->
<div class="modal fade" id="candidate" tabindex="-1" role="dialog" aria-labelledby="candidate" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="candidate">Tambah Kandidat</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <?php echo form_open_multipart('dashboard/candidate'); ?>
            <div class="modal-body">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="form-group row">
                    <label for="number" class="col-sm-3 col-form-label">Nomor Urut</label>
                    <div class="col-sm-9">
                        <select class="custom-select" name="number" id="number">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name1" class="col-sm-3 col-form-label">Nama Kandidat</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name1" id="nama1" placeholder="Nama Kandidat">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name2" class="col-sm-3 col-form-label">Nama Kandidat</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name2" id="nama2" placeholder="Nama Kandidat">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="photo" class="col-sm-3 col-form-label">Foto</label>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="photo" id="photo">
                            <label class="custom-file-label" for="photo">Pilih Foto</label>
                        </div>
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

<!-- Result Modal-->
<div class="modal fade" id="result" tabindex="-1" role="dialog" aria-labelledby="candidate" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="result">Hasil Voting</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Lanjut" untuk melihat hasil voting.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
                <a class="btn btn-primary" href="<?php echo site_url('dashboard/result'); ?>">Lanjut</a>
            </div>
        </div>
    </div>
</div>
