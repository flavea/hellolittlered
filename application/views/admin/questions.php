<div class="container" style="margin-top:60px;">
  	<div class="row">
  		<h2>Commissions</h2>
			<?php if( $posts ): ?>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th width="10%">ID</th>
						<th width="15%">Name</th>
						<th width="30%">Question</th>
						<th width="30%">Answer</th>
						<th width="15%">Action</th>
					</tr>
				</thead>
				<tr>
			<?php foreach($posts as $post): ?>
			<?php 
				echo '<td>'.$post->id.'</td>';
				echo '<td>'.$post->name.'</td>';
				echo '<td>'.$post->message.'</td>';
				echo '<td>'.$post->answer.'</td>';
				echo '<td>
					<button class="button" onclick="answer('.$post->id.')">delete</button>
					</td>';
				
			?>
			</tr>
			<?php endforeach; else: ?>
				<h2>No post yet!</h2>
			<?php endif;?>
			
		</div>
	</div>
		