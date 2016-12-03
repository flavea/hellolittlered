<html>
<head>
	<title>Login &rarr; <?php echo $this->config->item('site_title', 'ion_auth')?></title>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/unbound.css" type="text/css" />
</head>
<body>
	
	<?php $this->load->view('blog/menu_top');?>
	
	<div id="content-outer" class="clear"><div id="content-wrapper">
		<div id="content"><div class="col-one" style="margin-right: 0; padding-right: 25px;">
			<div class='mainInfo'>
				<div class="pageTitle" style><h3>Login</h3></div>
				
				<?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
				
				<div class="pageTitleBorder"></div>
				<p>Please login with your email and password below.</p>
				
				<div id="infoMessage"><?php echo $message;?></div>
				
				<?php echo form_open("auth/login");?>
					
				  <p>
					<label for="identity">Email:</label>
					<?php echo form_input($identity);?>
				  </p>
				  
				  <p>
					<label for="password">Password:</label>
					<?php echo form_input($password);?>
				  </p>
				  
				  <p>
					  <label for="remember">Remember Me:</label>
					  <?php echo form_checkbox('remember', '1', FALSE);?>
				  </p>
				  
				  
				  <p><?php echo form_submit('submit', 'Login');?></p>

				  
				<?php echo form_close();?>
			</div>
		</div></div>
	</div></div>
	<?php $this->load->view('blog/footer');?>
	
</body>
</html>