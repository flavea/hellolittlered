

<div id="posts" class="content" data-aos="fade-up">
	<a class="tagged rotate" href="/blog">Blog Posts</a>
	<div class="left">
		<?php foreach ($posts as $post) { ?>
		<div>
			<div class="inside">
				<a href="<?php echo base_url().'post/'.$post->entry_id;?>">
					<h4>
						<?php echo $post->entry_name ?></h4>
						<?php
$date = date_create($post->entry_date);
echo date_format($date, 'F dS Y');
?>
					</a>
				</div>
			</div>

			<?php } ?>
		</div>
	</div>
</div>


<div id="projects" class="content">
	<center><h1><span>Latest Project</h1></span></center>

	<?php foreach($projects as $project): ?>
		<section>
			<div id="project-image">
				<img src="<?php echo $project->img ?>">
			</div>
			<div id="project-ext">
				<div class="inside-project">
					<h2><?php echo $project->name ?></h2>
					<p><?php echo $project->exp ?></p>
				</div>
			</div>
			<div id="proj-button">
				<a href="<?php echo $project->link ?>">Check Out Project</a></h3>
				<a href="<?php echo $project->behance ?>">On Behance</a></h3>
			</div>
		</section>
	<?php endforeach; ?>
</div>

<div id="themes" class="content">
	<center><h1><span>Latest Themes & Templates</span></h1></center>
	<?php foreach($themes as $post): ?>
		<article class="mini-theme">
			<a href="<?=base_url();?>theme/<?php echo $post->theme_id ?>">				
				<div class="image">
					<img src="<?php echo $post->theme_image ?>" alt="" />
				</div>
				<center><h6><?php echo $post->theme_name ?></h6></center>
			</a>
		</article>
	<?php endforeach; ?>
	<center>
		<a class="button" href="/themes">More Themes</a>
	</center>
</div>

<?php if($experiments): ?>
	<div id="experiments" class="content">
	    
		<center><h1><span>Latest Experiments</span></h1></center>
		
		<?php foreach($experiments as $post): ?>
			<div class="post featured clearfix">
				<?php if($post->image != ""): ?>
					<img src="<?php echo $post->image; ?>" alt="<?php echo $post->name; ?>" style="float:left;width:250px;margin-right:1em">
				<?php endif; ?>

				<h4><span><?php echo $post->name; ?></span></h4>
				<p><?php echo $post->description; ?></p>
				<?php if($post->link != ""): ?>
					<a class="button" href="<?php echo $post->name; ?>" target="blank">Check It Out</a>
				<?php endif;
				if($post->code != ""): ?>
				<a class="button" href="<?php echo $post->code; ?>" target="blank">Source Code</a>
			<?php endif; ?>
		</div>
	<?php endforeach;?>
</div>
<?php endif; ?>