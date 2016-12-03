<section id="sidebar">

						<!-- Intro -->
							<section id="intro">
								<a href="#" class="logo"><img src="<?=base_url();?>img/logo.jpg" alt="" /></a>
								<header>
									<?php $item = $this->site_model->get_data(); 
							        foreach($item as $header): ?>
									<h2><?php echo $header->title;?></h2>
									<?php echo $header->description; endforeach;?>
								</header>
							</section>
							<?php 
							$item = $this->look_model->get_sidebars(); 
							foreach($item as $sidebar): ?>
								<section class="blurb">
									<?php echo $sidebar->content?>
								</section>
							<?php endforeach;?>

						<!-- Mini Posts -->
							<!-- <section>
								<div class="mini-posts">

									<!-- Mini Post -->
										<!-- <article class="mini-post">
											<header>
												<h3><a href="#">Vitae sed condimentum</a></h3>
												<time class="published" datetime="2015-10-20">October 20, 2015</time>
												<a href="#" class="author"><img src="<?=base_url();?>images/avatar.jpg" alt="" /></a>
											</header>
											<a href="#" class="image"><img src="<?=base_url();?>images/pic04.jpg" alt="" /></a>
										</article>

									<!-- Mini Post -->
										<!-- <article class="mini-post">
											<header>
												<h3><a href="#">Rutrum neque accumsan</a></h3>
												<time class="published" datetime="2015-10-19">October 19, 2015</time>
												<a href="#" class="author"><img src="<?=base_url();?>images/avatar.jpg" alt="" /></a>
											</header>
											<a href="#" class="image"><img src="<?=base_url();?>images/pic05.jpg" alt="" /></a>
										</article>

									<!-- Mini Post -->
										<!-- <article class="mini-post">
											<header>
												<h3><a href="#">Odio congue mattis</a></h3>
												<time class="published" datetime="2015-10-18">October 18, 2015</time>
												<a href="#" class="author"><img src="<?=base_url();?>images/avatar.jpg" alt="" /></a>
											</header>
											<a href="#" class="image"><img src="<?=base_url();?>images/pic06.jpg" alt="" /></a>
										</article>

									<!-- Mini Post -->
										<!-- <article class="mini-post">
											<header>
												<h3><a href="#">Enim nisl veroeros</a></h3>
												<time class="published" datetime="2015-10-17">October 17, 2015</time>
												<a href="#" class="author"><img src="<?=base_url();?>images/avatar.jpg" alt="" /></a>
											</header>
											<a href="#" class="image"><img src="<?=base_url();?>images/pic07.jpg" alt="" /></a>
										</article>

								</div>
							</section> -->

						<!-- Posts List -->
							<section>
								<ul class="posts">
										<?php 
										$item = $this->look_model->get_websites(); 
										foreach($item as $website): ?>
									<li>
											<article>
												<header>
													<h3><a href="<?php echo $website->link ?>"><?php echo $website->name ?></a></h3>
													<span class="published"><?php echo $website->description ?></span>
												</header>
												<?php if($website->icon!=''): ?>
												<img src="<?php echo $website->icon ?>" alt="" />

												<?php endif; ?>
											</article>
									</li>
										<?php endforeach;?>
								</ul>
							</section>

						<!-- Footer -->
							<section id="footer">
								<ul class="icons">
									<?php 
									$item = $this->look_model->get_socmeds(); 
									
									foreach($item as $socmed): ?>
										<?php if($socmed->codepen != '') { ?>
										<li><a href="<?php echo $socmed->codepen ?>" class="fa-codepen"></a></li>
										<?php } ?>
										<?php if($socmed->deviantart != '') { ?>
										<li><a href="<?php echo $socmed->deviantart ?>" class="fa-deviantart"></a></li>
										<?php } ?>
										<?php if($socmed->facebook != '') { ?>
										<li><a href="<?php echo $socmed->facebook ?>" class="fa-facebook"></a></li>
										<?php } ?>
										<?php if($socmed->flickr != '') { ?>
										<li><a href="<?php echo $socmed->flickr ?>" class="fa-flickr"></a></li>
										<?php } ?>
										<?php if($socmed->instagram != '') { ?>
										<li><a href="<?php echo $socmed->instagram ?>" class="fa-instagram"></a></li>
										<?php } ?>
										<?php if($socmed->linkedin != '') { ?>
										<li><a href="<?php echo $socmed->linkedin ?>" class="fa-linkedin"></a></li>
										<?php } ?>
										<?php if($socmed->soundcloud != '') { ?>
										<li><a href="<?php echo $socmed->soundcloud ?>" class="fa-soundcloud"></a></li>
										<?php } ?>
										<?php if($socmed->tumblr != '') { ?>
										<li><a href="<?php echo $socmed->tumblr ?>" class="fa-tumblr"></a></li>
										<?php } ?>
										<?php if($socmed->twitter != '') { ?>
										<li><a href="<?php echo $socmed->twitter ?>" class="fa-twitter"></a></li>
										<?php } ?>
										<?php if($socmed->youtube != '') { ?>
										<li><a href="<?php echo $socmed->youtube ?>" class="fa-youtube"></a></li>
										<?php } ?>
										<?php if($socmed->behance != '') { ?>
										<li><a href="<?php echo $socmed->behance ?>" class="fa-behance"></a></li>
										<?php } ?>
										<?php if($socmed->github != '') { ?>
										<li><a href="<?php echo $socmed->github ?>" class="fa-github"></a></li>
										<?php } ?>
									<?php endforeach; ?>
								</ul>
								<p class="copyright">&copy; Untitled. Design: <a href="http://html5up.net">HTML5 UP</a> (Modified by Hello Little Red)</p>
							</section>

					</section>
