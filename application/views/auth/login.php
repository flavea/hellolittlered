<html>
<head>
	<title>Login &rarr; <?= $this->config->item('site_title', 'ion_auth')?></title>
	<link rel="stylesheet" href="<?= base_url();?>assets/css/unbound.css" type="text/css" />
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
				
				<div id="infoMessage"><?= $message;?></div>
				
				<?= form_open("auth/login");?>
					
				  <p>
					<label for="identity">Email:</label>
					<?= form_input($identity);?>
				  </p>
				  
				  <p>
					<label for="password">Password:</label>
					<?= form_input($password);?>
				  </p>
				  
				  <p>
					  <label for="remember">Remember Me:</label>
					  <?= form_checkbox('remember', '1', FALSE);?>
				  </p>
				  
				  
				  <p><?= form_submit('submit', 'Login');?></p>

				  
				<?= form_close();?>
			</div>
		</div></div>
	</div></div>
	<?php $this->load->view('blog/footer');?>
	
</body>
</html>