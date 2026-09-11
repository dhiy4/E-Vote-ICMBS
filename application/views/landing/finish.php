<div class="col-md-7 col-lg-6">

    <div class="card" id="center-plus">

        <div class="card-body p-0">

            <div class="row">

                <div class="col-lg p-5">

                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Terima Kasih</h1>
                    </div>

                    <form class="user text-center">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <p class="card-text">Terima kasih atas partisipasi Anda, pilihan Anda sangat berguna bagi masa depan sekolah.</p>
                        <hr>
                        <a href="<?php echo site_url(); ?>" class="btn btn-primary btn-user btn-block">Ok</a>
                    </form>

                </div>

            </div>

        </div>

    </div>

</div>