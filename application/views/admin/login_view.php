<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style>
    main { margin: 0; height: 100%; position: absolute;width:100%;padding: 5% 25%;}
    footer { display: none }
    .form {padding: 1em!important; margin: 0 auto;}
</style>
<div class="container" class="black">
<center><h3><strong>Hello Little Red</strong> Dashboard Login</h3></center>
    </div>
</div>
<div class="row">
    <div class="card-panel white form">
        <div class="login-message"></div>
        <div class="form-bottom">
            <?php echo form_open('admin/login');?>
            <div class="input-field">
                <?php echo form_label('Username','username');?>
                <?php echo form_input('username','','class="form-username form-control" id="form-username" required');?>
            </div>
            
            <div class="input-field">
                <?php echo form_label('Password','password');?>
                <?php echo form_password('password','','class="form-password form-control" id="form-password" required');?>
            </div>
            
            <div class="switch">
            <label>
              <input type="checkbox" name="remember" value="1"  />
              <span class="lever"></span>
              Remember Me
            </label>
          </div>
          </div>
          <center>
            <?php echo form_submit('submit', 'Log in', 'class="btn red darken-4  btn red darken-4 -default" id="login-button"');?>
            </center>
            <?php echo form_close();?>
        </div>
    </div>
</div>

<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style>
    main { margin: 0; height: 100%; position: absolute;width:100%;padding: 5% 25%;}
    footer { display: none }
    .form {padding: 1em!important; margin: 0 auto;}
</style>
<div class="container">
<center><h3><strong>Hello Little Red</strong> Dashboard Login</h3></center>
    </div>
</div>
<div class="row">
    <div class="card-panel white form">
        <div class="login-message"></div>
        <div class="form-bottom">
            <div class="input-field">
            <?php echo form_open('admin/login',array('class'=>'login-form'));?>
            
                <?php echo form_label('Username','username');?>
                <?php echo form_input('username','','class="form-username form-control" id="form-username" required');?>
            </div>
            
            <div class="input-field">
                <?php echo form_label('Password','password');?>
                <?php echo form_password('password','','class="form-password form-control" id="form-password" required');?>
            </div>
            
            <div class="switch">
            <label>
              <input type="checkbox" name="remember" value="1"  />
              <span class="lever"></span>
              Remember Me
            </label>
          </div>
          </div>
          <center>
            <?php echo form_submit('submit', 'Log in', 'class="btn red darken-4  btn red darken-4 -default" id="login-button"');?>
            <?php echo form_close();?>
            </center>
        </div>
    </div>
</div>

<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style>
    main { margin: 0; height: 100%; position: absolute;width:100%;padding: 5% 25%;}
    footer { display: none }
    .form {padding: 1em!important; margin: 0 auto;}
</style>
<div class="container">
<center><h3><strong>Hello Little Red</strong> Dashboard Login</h3></center>
    </div>
</div>
<div class="row">
    <div class="card-panel white form">
        <div class="login-message"></div>
        <div class="form-bottom">
            <div class="input-field">
            <?php echo form_open('admin/login',array('class'=>'login-form'));?>
            
                <?php echo form_label('Username','username');?>
                <?php echo form_input('username','','class="form-username form-control" id="form-username" required');?>
            </div>
            
            <div class="input-field">
                <?php echo form_label('Password','password');?>
                <?php echo form_password('password','','class="form-password form-control" id="form-password" required');?>
            </div>
            
            <div class="switch">
            <label>
              <input type="checkbox" name="remember" value="1"  />
              <span class="lever"></span>
              Remember Me
            </label>
          </div>
          </div>
          <center>
            <?php echo form_submit('submit', 'Log in', 'class="btn red darken-4  btn red darken-4 -default" id="login-button"');?>
            <?php echo form_close();?>
            </center>
        </div>
    </div>
</div>

