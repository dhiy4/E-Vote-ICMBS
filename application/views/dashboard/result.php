<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
    </div>

    <div class="row">
    <?php foreach($candidate as $candidate) : ?>
        <div class="col-lg-3">
            <div class="card shadow mb-4 text-center">
                <div class="card-body">
                    <h1 class="display-1"><?php echo $candidate['number']; ?></h1>
                    <img src="<?php echo base_url('assets/img/' . $candidate['photo']) ?>" alt="Kandidat" class="img-fluid rounded"><hr>
                    <h2><?php echo $candidate['name1']; ?></h2>
                    <h2><?php echo $candidate['name2']; ?></h2>
                    <hr>
                    <h2 class="display-4"><?php echo $candidate['result']; ?></h2>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>

</div>
