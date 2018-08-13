<script>
	function delete_post($id) {
		var check = confirm('Are you sure you want to delete?');
		var id = $id;
		if (check == true) {
			window.location.href = "<?=base_url()?>blog/delete_post/".concat(id);
		}
		else {
			return false;
		}
	}

	function edit_post($id) {
		var id = $id;
		window.location.href = "<?=base_url()?>blog/update_entry/".concat(id);
	}
</script>
<div class="card-panel white">
	<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Manage Blog Entries</h2>
	<table class="highlight striped">
		<thead>
			<tr>
				<th width="10%">Entry ID</th>
				<th width="25%">Entry Name</th>
				<th width="25%">Status</th>
				<th width="25%">Action</th>
			</tr>
		</thead>
		<tr>
			<?php if( $posts ): ?>
				<?php foreach($posts as $post): ?>
					<?php 
					echo '<td>'.$post->entry_id.'</td>';
					echo '<td><a href="'.base_url().'post/'.$post->entry_id.'">'.$post->entry_name.'</a></td>';
					echo '<td>'.$post->name.'</a></td>';
					echo '<td>
					<button class="waves-effect waves-light btn red darken-4" onclick="delete_post('.$post->entry_id.')">delete</button>
					<button class="waves-effect waves-light btn red darken-4" onclick="edit_post('.$post->entry_id.')">edit</button>
				</td>';
				?>
			</tr>
		<?php endforeach; else: ?>
		<h2>No post yet!</h2>
	<?php endif;?>
</table>


<ul class="actions pagination">
	<?= $paginglinks; ?>
</ul>

</div>