<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="top-content">
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <center><h1><strong>Hello Little Red</strong> Dashboard Login</h1>
                    <div class="description">
                        <p>Enter your username and password to log on.</p>
                    </div></center>
                </div>
             </div>
         <div class="row">
            <div class="col-sm-6 col-sm-offset-3 form-box">
            <div class="login-message"></div>
            <div class="form-bottom">
            <?php echo form_open('admin/login',array('class'=>'login-form'));?>
            <div class="form-group">
                <?php echo form_label('Username','username');?>
                <div class="username_error"></div>
                <?php echo form_input('username','','class="form-username form-control" id="form-username"');?>
            </div>
            <div class="form-group">
                <?php echo form_label('Password','password');?>
                <div class="password_error"></div>
                <?php echo form_password('password','','class="form-password form-control" id="form-password"');?>
            </div>
            <div class="form-group">
                <label>
                    <?php echo form_checkbox('remember','1',FALSE);?> Remember me
                </label>
            </div>
            <?php echo form_submit('submit', 'Log in', 'class="btn btn-default" id="login-button"');?>
            <?php echo form_close();?>
        </div>
                        </div>
                    </div>
                
                </div>
            </div>
            
        </div>