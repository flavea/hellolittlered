<section id="sidebar">

	<!-- Intro -->
	<section id="intro">
		<a href="#" class="logo"><img src="http://i.imgur.com/PhoyaMp.png" alt="" /></a>
			<?php $item = $this->site_model->get_data(); 
			foreach($item as $header): ?>
			<h2><?= $header->title;?></h2>
			<?= $header->description; endforeach;?>
	</section>
	<?php 
	
	$item = $this->look_model->get_sidebars(); 
	foreach($item as $sidebar): ?>
	<section class="blurb">
		<?= $sidebar->content?>
	</section>
<?php endforeach;?>

<section>
	<div class="websites">
	<b>Blog Categories:</b><br>
	<ul>
		<?php 
		foreach($categories as $category):?>
		<li><a href="category/<?= $category->slug ?>"><?= $category->category_name ?></a></li>
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
			<h5><a href="category/<?= $website->link ?>"><?= $website->name ?></a></h5>
			<span class="published"><?= $website->description ?></span>
		</div>
	<?php endforeach;?>
</div>
</section>

<section id="stat">
<p><b>Last Song Listened:</b><br>
<?= $music; ?></p>
<p><b>Last Book Read:</b><br>
<?= $read; ?></p>
<p><b>Currently Watching:</b><br>
<?= $watch; ?></p>
</section>

<!-- Footer -->
<section id="footer">
	<center>
		<?php 
		$item = $this->look_model->get_socmeds(); 

		foreach($item as $socmed): ?>
		<?php if($socmed->codepen != '') { ?>
		<a href="<?= $socmed->codepen ?>" class="fa fa-codepen"></a>
		<?php } ?>
		<?php if($socmed->deviantart != '') { ?>
		<a href="<?= $socmed->deviantart ?>" class="fa fa-deviantart"></a>
		<?php } ?>
		<?php if($socmed->facebook != '') { ?>
		<a href="<?= $socmed->facebook ?>" class="fa fa-facebook"></a>
		<?php } ?>
		<?php if($socmed->flickr != '') { ?>
		<a href="<?= $socmed->flickr ?>" class="fa fa-flickr"></a>
		<?php } ?>
		<?php if($socmed->instagram != '') { ?>
		<a href="<?= $socmed->instagram ?>" class="fa fa-instagram"></a>
		<?php } ?>
		<?php if($socmed->linkedin != '') { ?>
		<a href="<?= $socmed->linkedin ?>" class="fa fa-linkedin"></a>
		<?php } ?>
		<?php if($socmed->soundcloud != '') { ?>
		<a href="<?= $socmed->soundcloud ?>" class="fa fa-soundcloud"></a>
		<?php } ?>
		<?php if($socmed->tumblr != '') { ?>
		<a href="<?= $socmed->tumblr ?>" class="fa fa-tumblr"></a>
		<?php } ?>
		<?php if($socmed->twitter != '') { ?>
		<a href="<?= $socmed->twitter ?>" class="fa fa-twitter"></a>
		<?php } ?>
		<?php if($socmed->youtube != '') { ?>
		<a href="<?= $socmed->youtube ?>" class="fa fa-youtube"></a>
		<?php } ?>
		<?php if($socmed->behance != '') { ?>
		<a href="<?= $socmed->behance ?>" class="fa fa-behance"></a>
		<?php } ?>
		<?php if($socmed->github != '') { ?>
		<a href="<?= $socmed->github ?>" class="fa fa-github"></a>
		<?php } ?>
	<?php endforeach; ?>
</section>
</center>

</section>
