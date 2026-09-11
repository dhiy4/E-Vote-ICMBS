<div class="col-md-7 col-lg-6">

    <div class="card" id="center-plus">

        <div class="card-body p-0">

            <div class="row">

                <div class="col-lg p-5">

                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang</h1>
                    </div>

                    <?php echo $message; ?>

                    <form class="user" action="<?php echo site_url('landing'); ?>" method="post">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="pin" name="pin" placeholder="Masukan PIN">
                            <?php echo form_error('pin', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary btn-user btn-block">Masuk</button>
                    </form>

                </div>

            </div>

        </div>

    </div>

</div>