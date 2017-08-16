<div class="card-panel white">
	<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Commission Detail</h2>
	<?php if( $posts ): ?>
		<?php foreach($posts as $post): ?>
			<b>Name:</b> <?php echo $post->name.'</br>'; ?>
			<b>Email:</b> <?php echo $post->email.'</br>'; ?>
			<b>Site:</b> <?php echo $post->site.'</br>'; ?>						
			<b>Orders:</b> 
			<ul>
				<?php $item = $this->commission_model->get_related_categories($post->commission_id); foreach($item as $category): ?><li><?php echo $category->category_name;?></li><?php endforeach;?>
			</ul>
			<b>Site:</b> <?php echo $post->site.'</br>'; ?>	
			<b>Sketch:</b> <?php echo $post->sketch.'</br>'; ?>		
			<b>Message:</b> <?php echo $post->message.'</br>'; ?>				
		<?php endforeach; ?>
	<?php endif;?>
</div>