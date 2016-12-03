<script>
function delete_page($id) {
	var check = confirm('Are you sure you want to delete?');
	var id = $id;
	 if (check == true) {
          window.location.href = "delete_page/".concat(id);
        }
        else {
            return false;
        }
}
function update_page($id) {
    window.location.href = "update_page/".concat(id);
}
</script>
<div class="container" style="margin-top:60px;">
  	<div class="row">
  		<h2>Manage Pages</h2>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th width="10%">Entry ID</th>
						<th width="15%">Entry Name</th>
						<th width="15%">Page Slug</th>
						<th width="30%">Page Preview</th>
						<th width="30%">Action</th>
					</tr>
				</thead>
				<tr>
			<?php if( $posts ): foreach($posts as $post): ?>
			<?php 
				echo '<td>'.$post->page_id.'</td>';
				echo '<td><a href="'.base_url().'post/'.$post->page_id.'">'.$post->page_title.'</a></td>';
				echo '<td>'.$post->slug.'</td>';
				echo '<td>'.substr($post->page_body, 0, 200).'....</td>';
				echo '<td>
				<a class="button" href="update_page/'.$post->page_id.'">update</a>
				<button class="button" onclick="delete_page('.$post->page_id.')">delete</button>
				</td>';
			?>
			</tr>
			<?php endforeach; else: ?>
			<h2>No post yet!</h2>
			<?php endif;?>
			
		</div>
	</div>
		