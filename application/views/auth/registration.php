<div class="text-center">
    <h1 class="h4 text-gray-900 mb-4">Register your account!</h1>
</div>

<?php echo $message; ?>

<form class="user" action="<?php echo site_url('auth/registration'); ?>" method="post">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <div class="form-group">
        <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?php echo set_value('username'); ?>">
        <?php echo form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
        </div>
        <div class="col-sm-6">
            <input type="password" class="form-control form-control-user" id="password_rpt" name="password_rpt" placeholder="Repeat Password">
        </div>
        <div class="col-sm">
            <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
    </div>
    <hr>
    <button type="submit" class="btn btn-primary btn-user btn-block">Register</button>
</form><br>
<div class="text-center">
    <a class="small" href="<?php echo site_url('auth'); ?>">Already have an account</a>
</div>
  