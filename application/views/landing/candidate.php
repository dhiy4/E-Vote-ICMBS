<form action="<?php echo site_url('landing/candidate'); ?>" method="post">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <input type="hidden" name="status" value="FINISH">
    <input type="hidden" name="finish" value="<?php echo date('Y-m-d H:i:s');?>">
    <div class="row">

        <?php foreach($candidate as $candidate) : ?>
        <div class="col-lg-3">

            <div class="card">

                <div class="card-body p-0">

                    <div class="row">

                        <div class="col-lg p-3">

                            <div class="user text-center">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <h1 class="display-1"><?php echo $candidate['number']; ?></h1>

                                <img src="<?php echo base_url('assets/img/' . $candidate['photo']) ?>" alt="Kandidat" class="img-fluid rounded"><hr>

                                <h2><?php echo $candidate['name1']; ?></h2>
                                <h2><?php echo $candidate['name2']; ?></h2>

                                <label class="check">
                                    <input type="radio" id="vote" name="vote" value="<?php echo $candidate['number']; ?>">
                                    <span class="checkmark"></span>
                                </label>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <?php endforeach; ?>

        <div class="w-100"></div>

        <button type="submit" class="btn btn-primary d-block" id="special-btn">Pilih</button>

    </div>
</form>
