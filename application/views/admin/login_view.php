<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style>
#info {
	margin: 9%;
}
</style>
<article class="post">
    <?= form_open('admin/login',array('class'=>'login-form'));?>

        <?= form_label('Username','username');?>
            <?= form_input('username','','class="form-username form-control" id="form-username" required');?>
                <?= form_label('Password','password');?>
                    <?= form_password('password','','class="form-password form-control" id="form-password" required');?>
                        <input type="checkbox" name="remember" value="1" /> Remember Me
                        <center>
                            <?= form_submit('submit', 'Log in', 'class="button button-inverse" id="login-button"');?>
                                <?= form_close();?>
                        </center>
</article>

<script>
    $(document).ready(function () {
        $('#bg, #container').show();
        $('#loader, #posts-loader').hide();
    });
</script>