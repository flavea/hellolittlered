<!DOCTYPE HTML>
<html>
	<head>
		<title><?= $title ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="<?=base_url();?>assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>

		<!-- Wrapper -->

		<article class="header">
		<section >
				<?php 
				$item = $this->look_model->get_headers(); 
				foreach($item as $header): ?>
				<img src="<?= $header->link;?>">
				<?php endforeach;?>
		</section>
		<?php if ($pagetitle != ''): ?>
		<section class="post" style="padding-top:40px">
		<h2><center><?= $pagetitle; ?></center></h2>
		</section>
		</article>

		<?php endif; ?>
		<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="#">Hello Little Red</a></h1>
						<nav class="links">
							<ul>
								<li><a href="#">Home</a></li>
								<li><a href="#">Blog</a></li>
								<li>
									<div class="dropdown">
									  <a class="dropbtn">Dropdown</a>
									  <div class="dropdown-content">
									    <a href="#">Link 1</a>
									    <a href="#">Link 2</a>
									    <a href="#">Link 3</a>
									  </div>
									</div>
								</li>
								<li><a href="#">Resources</a></li>
								<li><a href="#">Photos</a></li>
								<li><a href="#">Orders</a></li>
								<li><a href="#">Contact</a></li>
							</ul>
						</nav>
						<nav class="main">
							<ul>
								<li class="search">
									<a class="fa-search" href="#search">Search</a>
									<form id="search" method="get" action="#">
										<input type="text" name="query" placeholder="Search" />
									</form>
								</li>
								<li class="menu">
									<a class="fa-bars" href="#menu">Menu</a>
								</li>
							</ul>
						</nav>
					</header>

				<!-- Menu -->
					<section id="menu">

						<!-- Search -->
							<section>
								<form class="search" method="get" action="#">
									<input type="text" name="query" placeholder="Search" />
								</form>
							</section>

						<!-- Links -->
							<section>
								<ul class="links">
									<li>
										<a href="#">
											<h3>Lorem ipsum</h3>
											<p>Feugiat tempus veroeros dolor</p>
										</a>
									</li>
									<li>
										<a href="#">
											<h3>Dolor sit amet</h3>
											<p>Sed vitae justo condimentum</p>
										</a>
									</li>
									<li>
										<a href="#">
											<h3>Feugiat veroeros</h3>
											<p>Phasellus sed ultricies mi congue</p>
										</a>
									</li>
									<li>
										<a href="#">
											<h3>Etiam sed consequat</h3>
											<p>Porta lectus amet ultricies</p>
										</a>
									</li>
								</ul>
							</section>

						<!-- Actions -->
							<section>
								<ul class="actions vertical">
									<li><a href="#" class="button big fit">Log In</a></li>
								</ul>
							</section>

					</section>

				<!-- Main -->
					
					<div id="main">