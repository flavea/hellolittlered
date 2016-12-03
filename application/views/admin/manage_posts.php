
<script>
function delete_post($id) {
	var check = confirm('Are you sure you want to delete?');
	var id = $id;
	if (check == true) {
        window.location.href = "delete_post/".concat(id);
    }
    else {
        return false;
    }
}

function edit_post($id) {
	var id = $id;
    window.location.href = "update_entry/".concat(id);
}
</script>
<div class="container" style="margin-top:60px;">
  	<div class="row">
  		<h2>Manage Blog Entries</h2>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th width="10%">Entry ID</th>
						<th width="25%">Entry Name</th>
						<th width="40%">Entry Preview</th>
						<th width="25%">Action</th>
					</tr>
				</thead>
				<tr>
			<?php if( $posts ): ?>
			<?php foreach($posts as $post): ?>
			<?php 
				echo '<td>'.$post->entry_id.'</td>';
				echo '<td><a href="'.base_url().'post/'.$post->entry_id.'">'.$post->entry_name.'</a></td>';
				echo '<td>'.substr($post->entry_body, 0, 200).'....</td>';
				echo '<td>
					<button class="button" onclick="delete_post('.$post->entry_id.')">delete</button>
					<button class="button" onclick="edit_post('.$post->entry_id.')">edit</button>
					</td>';
			?>
			</tr>
			<?php endforeach; else: ?>
				<h2>No post yet!</h2>
			<?php endif;?>
			</table>
			

							<ul class="actions pagination">
								<?php echo $paginglinks; ?>
							</ul>

		</div>
	</div>
		