<script>
	function delete_post($id) {
		var check = confirm('Are you sure you want to delete?');
		var id = $id;
		if (check == true) {
			window.location.href = "<?=base_url()?>admin/delete_theme/".concat(id);
		}
		else {
			return false;
		}
	}

	function edit_post($id) {
		var id = $id;
		window.location.href = "<?=base_url()?>admin/update_theme/".concat(id);
	}
</script>

<div class="card-panel white">
	<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Manage <?php echo $PgNm; ?> Themes</h2>
	<table class="highlight striped">
		<thead>
			<tr>
				<th width="10%">Theme ID</th>
				<th width="30%">Theme Name</th>
				<th width="30%">Theme Status</th>
				<th width="30%">Action</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php $posts; if( $posts ): foreach($posts as $post): ?>
					<td><?php echo $post->theme_id ?></td>
					<td><?php echo $post->theme_name ?></td>
					<td>
						<?php echo $post->name ?>
					</td>
					<td>
						<button class="waves-effect waves-light btn red darken-4" onclick="delete_post('<?php echo $post->theme_id ?>')">delete</button>
						<button class="waves-effect waves-light btn red darken-4" onclick="edit_post('<?php echo $post->theme_id ?>')">edit</button>
					</td>
				</tr>
			</tbody>
		<?php endforeach; else: ?>
		<td colspan="3">No theme yet!</h2>
		<?php endif ;?>
	</table>

	<ul class="actions pagination">
		<?php echo $paginglinks; ?>
	</ul>

</div>
