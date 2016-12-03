<script>
function delete_post($id) {
	var check = confirm('Are you sure you want to delete?');
	var id = $id;
	if (check == true) {
        window.location.href = "delete_theme/".concat(id);
    }
    else {
        return false;
    }
}

function edit_post($id) {
	var id = $id;
    window.location.href = "update_theme/".concat(id);
}
</script>
<div class="container" style="margin-top:60px;">
  	<div class="row">
  		<h2>Manage Blog Entries</h2>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th width="10%">Theme ID</th>
						<th width="30%">Theme Name</th>
						<th width="30%">Theme Types</th>
						<th width="30%">Action</th>
					</tr>
				</thead>
				<tr>
			<?php if( $posts ): foreach($posts as $post): ?>
				<td><?php echo $post->theme_id ?></td>
				<td><?php echo $post->theme_name ?></td>
				<td>
					<?php $item = $this->themes_model->get_related_categories($post->theme_id); foreach($item as $category): ?><a href="<?php echo base_url().$category->slug;?>"><?php echo $category->category_name;?></a> <?php endforeach;?>
				</td>
				<td>
					<button class="button" onclick="delete_post('<?php echo $post->theme_id ?>')">delete</button>
					<button class="button" onclick="edit_post('<?php echo $post->theme_id ?>')">edit</button>
				</td>
			</tr>
			<?php endforeach; else: ?>
				<td colspan="3">No theme yet!</h2>
			<?php endif ;?>
		</table>

		<ul class="actions pagination">
								<?php echo $paginglinks; ?>
							</ul>
			
		</div>
	</div>
		