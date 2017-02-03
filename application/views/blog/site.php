


<div id="posts" class="content" data-aos="fade-up">
	<a class="tag rotate" href="/blog">Blog Posts</a>
	<div class="left">
		<?php foreach ($posts as $post) { ?>
		<div>
			<div class="inside">
				<a href="<?php echo base_url().'post/'.$post->entry_id;?>">
					<h4>
						<?php echo $post->entry_name ?></h4>
						<?php 
						echo mdate('%n %M %Y',human_to_unix($post->entry_date));?>
					</a>
				</div>
			</div>

			<?php } ?>
		</div>
	</div>
</div>


	<div id="projects" class="content">
		<center><h1>Latest Project</h1></center>

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
				<a href="<?php echo $project->link ?>">Check Out Project</a>
				<a href="<?php echo $project->behance ?>">On Behance</a>
			</div>
		</section>
	<?php endforeach; ?>
</div>



<div id="themes" class="content">
		<?php foreach($themes as $post): ?>
		<article class="mini-theme">				
			<a href="<?=base_url();?>theme/<?php echo $post->theme_id ?>" class="image">
				<img src="<?php echo $post->theme_image ?>" alt="" />
			</a>
		</article>
	<?php endforeach; ?>
<center>
	<a class="button" href="/themes">More Themes</a>
</center>
</div>