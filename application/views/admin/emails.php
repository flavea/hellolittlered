<div class="container" style="margin-top:60px;">
  	<div class="row">
  		<h2>Emails</h2>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th width="10%">ID</th>
						<th width="15%">Name</th>
						<th width="20%">Email</th>
						<th width="55%">Message</th>
					</tr>
				</thead>
				<tr>
			<?php if( $posts ): ?>
			<?php foreach($posts as $post): ?>
			<?php 
				echo '<td>'.$post->contact_id.'</td>';
				echo '<td>'.$post->name.'</td>';
				echo '<td>'.$post->email.'</td>';
				echo '<td>'.$post->message.'</td>';
				
			?>
			</tr>
			<?php endforeach; else: ?>
				<h2>No post yet!</h2>
			<?php endif;?>

			<ul class="actions pagination">
				<?php echo $paginglinks; ?>
			</ul>
			
		</div>
	</div>
		