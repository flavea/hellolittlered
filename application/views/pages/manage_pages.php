<script>
	function delete_page($id) {
		var check = confirm('Are you sure you want to delete?');
		var id = $id;
		if (check == true) {
			window.location.href = "<?=base_url()?>pages/delete_page/".concat(id);
		}
		else {
			return false;
		}
	}
	function update_page($id) {
		var id = $id;
		window.location.href = "<?=base_url()?>pages/update_page/".concat(id);
	}
</script>
<div class="card-panel white">
	<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Manage Pages</h2>
	<table class="highlight striped">
		<thead>
			<tr>
				<th width="10%">ID</th>
				<th width="25%">Page Name</th>
				<th width="15%">Page Slug</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tr>
			<?php if( $posts ): foreach($posts as $post): ?>
				<?php 
				echo '<td>'.$post->page_id.'</td>';
				echo '<td><a href="'.base_url().'post/'.$post->page_id.'">'.$post->page_title.'</a></td>';
				echo '<td>'.$post->slug.'</td>';
				echo '<td>'.$post->name.'</td>';
				echo '<td>
				<a class="waves-effect waves-light btn red darken-4 " href="update_page/'.$post->page_id.'">update</a>
				<button class="waves-effect waves-light btn red darken-4 " onclick="delete_page('.$post->page_id.')">delete</button>
			</td>';
			?>
		</tr>
	<?php endforeach; else: ?>
	<h2>No post yet!</h2>
<?php endif;?>
</table>
</div>