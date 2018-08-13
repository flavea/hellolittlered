

	<div id="projects-real">

		<?php 
		$i = 1;
		foreach($projects as $project): ?>
		
    
		<section>
		    <div class="number">0<?= $i ?></div>
    		<h3><a href="<?= $project->link ?>" target="_blank"><?= $project->name ?></a></h3>
    		<span><?= $project->link ?></span>
		</section>
		
		<!--<div id="image" class="<?= $project->name ?>">
		    <img src="<?= $project->img ?>">
		</div>-->
	<?php 
	    $i++;
	endforeach; ?>
</div>

</div>
</div>
