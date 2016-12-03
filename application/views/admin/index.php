<?php $this->load->view('blog/header');?>
<body>

	<!-- header top starts-->
	<?php $this->load->view('blog/menu_top');?>
	<!-- header top ends here -->
	
	<!-- content starts -->
	<div id="content-outer" class="clear"><div id="content-wrapper">
	
		<!-- column-one -->
		<div id="content"><div class="col-one">
			
			<h2>Dashboard</h2>
			<h3>My Profile</h3>
			
			<p>Username: <?php echo $user->username;?></p>
			<p>Email: <?php echo $user->email;?></p>
			<p>Last login: <?php echo unix_to_human($user->last_login);?></p>
			
		</div></div>
		
		<!-- column-two -->
		<?php $this->load->view('blog/menu_sidebar');?>	
	
		<!-- column-three -->
		<?php $this->load->view('blog/sidebar');?>
		
	<!-- contents end here -->	
	</div></div>

	<!-- footer starts here -->	
	<?php $this->load->view('blog/footer');?>
	<!-- footer ends here -->

</body>
</html>