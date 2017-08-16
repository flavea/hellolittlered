<section id="sidebar">

	<!-- Intro -->
	<section id="intro">
		<a href="#" class="logo"><img src="http://i.imgur.com/PhoyaMp.png" alt="" /></a>
			<?php $item = $this->site_model->get_data(); 
			foreach($item as $header): ?>
			<h2><?php echo $header->title;?></h2>
			<?php echo $header->description; endforeach;?>
	</section>
	<?php 
	
	$item = $this->look_model->get_sidebars(); 
	foreach($item as $sidebar): ?>
	<section class="blurb">
		<?php echo $sidebar->content?>
	</section>
<?php endforeach;?>

<section>
	<div class="websites">
	<b>Blog Categories:</b><br>
	<ul>
		<?php 
		foreach($categories as $category):?>
		<li><a href="category/<?php echo $category->slug ?>"><?php echo $category->category_name ?></a></li>
	<?php endforeach;?>
	</ul>
</div>
</section>
<section>
	<div class="websites">
		<?php 

		$item = $this->look_model->get_websites(); 
		foreach($item as $website): ?>
		<div>
			<h5><a href="category/<?php echo $website->link ?>"><?php echo $website->name ?></a></h5>
			<span class="published"><?php echo $website->description ?></span>
		</div>
	<?php endforeach;?>
</div>
</section>

<section id="stat">
<p><b>Last Song Listened:</b><br>
<?php echo $music; ?></p>
<p><b>Last Book Read:</b><br>
<?php echo $read; ?></p>
<p><b>Currently Watching:</b><br>
<?php echo $watch; ?></p>
</section>

<!-- Footer -->
<section id="footer">
	<center>
		<?php 
		$item = $this->look_model->get_socmeds(); 

		foreach($item as $socmed): ?>
		<?php if($socmed->codepen != '') { ?>
		<a href="<?php echo $socmed->codepen ?>" class="fa fa-codepen"></a>
		<?php } ?>
		<?php if($socmed->deviantart != '') { ?>
		<a href="<?php echo $socmed->deviantart ?>" class="fa fa-deviantart"></a>
		<?php } ?>
		<?php if($socmed->facebook != '') { ?>
		<a href="<?php echo $socmed->facebook ?>" class="fa fa-facebook"></a>
		<?php } ?>
		<?php if($socmed->flickr != '') { ?>
		<a href="<?php echo $socmed->flickr ?>" class="fa fa-flickr"></a>
		<?php } ?>
		<?php if($socmed->instagram != '') { ?>
		<a href="<?php echo $socmed->instagram ?>" class="fa fa-instagram"></a>
		<?php } ?>
		<?php if($socmed->linkedin != '') { ?>
		<a href="<?php echo $socmed->linkedin ?>" class="fa fa-linkedin"></a>
		<?php } ?>
		<?php if($socmed->soundcloud != '') { ?>
		<a href="<?php echo $socmed->soundcloud ?>" class="fa fa-soundcloud"></a>
		<?php } ?>
		<?php if($socmed->tumblr != '') { ?>
		<a href="<?php echo $socmed->tumblr ?>" class="fa fa-tumblr"></a>
		<?php } ?>
		<?php if($socmed->twitter != '') { ?>
		<a href="<?php echo $socmed->twitter ?>" class="fa fa-twitter"></a>
		<?php } ?>
		<?php if($socmed->youtube != '') { ?>
		<a href="<?php echo $socmed->youtube ?>" class="fa fa-youtube"></a>
		<?php } ?>
		<?php if($socmed->behance != '') { ?>
		<a href="<?php echo $socmed->behance ?>" class="fa fa-behance"></a>
		<?php } ?>
		<?php if($socmed->github != '') { ?>
		<a href="<?php echo $socmed->github ?>" class="fa fa-github"></a>
		<?php } ?>
	<?php endforeach; ?>
</section>
</center>

</section>
