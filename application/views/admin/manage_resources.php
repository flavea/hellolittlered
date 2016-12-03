<script>
function delete_page($id) {
	var check = confirm('Are you sure you want to delete?');
	var id = $id;
	 if (check == true) {
          window.location.href = "delete_resource/".concat(id);
        }
        else {
            return false;
        }
}
</script>
<div class="container" style="margin-top:60px;">
  	<div class="row">
  		<h2>Manage Resources</h2>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th width="25%">Resource ID</th>
						<th width="25%">Resource Name</th>
						<th width="25%">Resource Type</th>
						<th width="25%">Action</th>
					</tr>
				</thead>
				<tr>
			<?php if( $posts ): foreach($posts as $post): ?>
			<?php 
				echo '<td>'.$post->resource_id.'</td>';
				echo '<td>'.$post->resource_name.'</td>';
				echo '<td>'.$post->type_name.'</td>';
				echo '<td><button class="button" onclick="delete_page('.$post->resource_id.')">delete</button></td>';
			?>
			</tr>
			<?php endforeach; else: ?>
			<h2>No post yet!</h2>
			<?php endif;?>

			
		</div>
	</div>
		