<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="top-content">
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1><strong>Registering</strong></h1>
                    
                </div>
             </div>
         <div class="row">
        <div class="col-sm-6 col-sm-offset-3 form-box">
            <div class="login-message"></div>
            <div class="form-bottom">
                <?php
                echo isset($_SESSION['auth_message']) ? $_SESSION['auth_message'] : FALSE;
                ?>
                <?php
                echo form_open();
                echo form_label('First name:','first_name').'<br />';
                echo form_error('first_name');
                echo form_input('first_name',set_value('first_name'),'class="form-username form-control" id="form-username"').'<br />';
                echo form_label('Last name:','last_name').'<br />';
                echo form_error('last_name');
                echo form_input('last_name',set_value('last_name'),'class="form-username form-control" id="form-username"').'<br />';
                echo form_label('Username:','username').'<br />';
                echo form_error('username');
                echo form_input('username',set_value('username'),'class="form-username form-control" id="form-username"').'<br />';
                echo form_label('Email:','email').'<br />';
                echo form_error('email');
                echo form_input('email',set_value('email'),'class="form-username form-control" id="form-username"').'<br />';
                echo form_label('Password:', 'password').'<br />';
                echo form_error('password');
                echo form_password('password', '','class="form-password form-control" id="form-password"').'<br />';
                echo form_label('Confirm password:', 'confirm_password').'<br />';
                echo form_error('confirm_password');
                echo form_password('confirm_password', '','class="form-password form-control" id="form-password"').'<br /><br />';
                echo form_submit('register','Register', 'class="btn btn-default" id="login-button"');
                echo form_close();
                ?>
            </div>
</div>