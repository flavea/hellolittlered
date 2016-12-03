<div class="container" style="margin-top:60px;">
  	<div class="row">
  		<h2>Commissions</h2>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th width="10%">ID</th>
						<th>Name</th>
					</tr>
				</thead>
				<tr>
			<?php if( $posts ): ?>
			<?php foreach($posts as $post): ?>
			<?php 
				echo '<td>'.$post->commission_id.'</td>';
				echo '<td><a href="'.base_url().'admin/commissions/'.$post->commission_id.'">'.$post->name.'</a></td>';
				
			?>
			</tr>
			<?php endforeach; else: ?>
				<h2>No post yet!</h2>
			<?php endif;?>
			
		</div>
	</div>
		