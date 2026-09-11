<div class="text-center">
    <h1 class="h4 text-gray-900 mb-4">Please login!</h1>
</div>

<?php echo $message; ?>

<form class="user" action="<?php echo site_url('auth'); ?>" method="post">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <div class="form-group">
        <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?php echo set_value('username'); ?>">
        <?php echo form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
        <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <hr>
    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
</form>


  