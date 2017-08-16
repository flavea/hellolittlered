

	<div id="projects-real">

		<?php 
		$i = 1;
		foreach($projects as $project): ?>
		
    
		<section>
		    <div class="number">0<?php echo $i ?></div>
    		<h3><a href="<?php echo $project->link ?>" target="_blank"><?php echo $project->name ?></a></h3>
    		<span><?php echo $project->link ?></span>
		</section>
		
		<!--<div id="image" class="<?php echo $project->name ?>">
		    <img src="<?php echo $project->img ?>">
		</div>-->
	<?php 
	    $i++;
	endforeach; ?>
</div>

</div>
</div>
