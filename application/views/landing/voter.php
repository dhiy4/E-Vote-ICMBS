<div class="col-md-7 col-lg-6">

    <div class="card" id="center-plus">

        <div class="card-body p-0">

            <div class="row">

                <div class="col-lg p-5">

                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Data Diri</h1>
                    </div>

                    <form class="user">
                    <?php foreach($voter as $voter) : ?>
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-user" id="name" value="<?php echo $voter['name']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Keterangan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-user" id="name" value="<?php echo $voter['information']; ?>" readonly>
                            </div>
                        </div>
                        <hr>
                        <a href="<?php echo site_url('landing/candidate'); ?>" class="btn btn-primary btn-user btn-block">Lanjut</a>
                    <?php endforeach; ?>
                    </form>

                </div>
            
            </div>

        </div>

    </div>

</div>