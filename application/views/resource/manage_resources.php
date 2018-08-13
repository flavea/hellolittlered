<script>
	function delete_page($id) {
		var check = confirm('Are you sure you want to delete?');
		var id = $id;
		if (check == true) {
			window.location.href = "<?=base_url()?>resource/delete_resource/".concat(id);
		}
		else {
			return false;
		}
	}

	function update_page($id) {
		window.location.href = "<?=base_url()?>resource/update_resource/".concat(id);
	}
</script>
<div class="card-panel white">
	<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Manage Resources</h2>
	<table class="highlight striped">
		<thead>
			<tr>
				<th width="25%">Resource ID</th>
				<th width="25%">Resource Name</th>
				<th width="25%">Resource Type</th>
				<th width="25%">Resource Status</th>
				<th width="25%">Action</th>
			</tr>
		</thead>
		<tr>
			<?php if( $posts ): foreach($posts as $post): ?>
				<?php 
				echo '<td>'.$post->resource_id.'</td>';
				echo '<td>'.$post->resource_name.'</td>';
				echo '<td>'.$post->type_name.'</td>';
				echo '<td>'.$post->name.'</td>';
				echo '<td><a class="waves-effect waves-light btn red darken-4" href="update_resource/'.$post->resource_id.'">update</a></td>';
				echo '<td><button class="waves-effect waves-light btn red darken-4" onclick="delete_page('.$post->resource_id.')">delete</button></td>';
				?>
			</tr>
		<?php endforeach; else: ?>
		<h2>No post yet!</h2>
	<?php endif;?>
</table>

</div>
</div>
