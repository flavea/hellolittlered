

	<div id="projects-real">

		<?php foreach($projects as $project): ?>

		<section>
			<div id="image">
				<img src="<?php echo $project->img ?>">
			</div>
			<div id="explanation">
				<h2><?php echo $project->name ?></h2>
				<p><?php echo $project->exp ?></p>
				<center>
					<a href="<?php echo $project->link ?>" class="button">Visit Website</a>
					<a href="<?php echo $project->behance ?>" class="button">On Behance</a>
				</center>
			</div>
		</section>
	<?php endforeach; ?>
</div>

</div>
</div>
