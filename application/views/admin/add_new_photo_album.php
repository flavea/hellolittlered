<script type="text/javascript" src="<?=base_url();?>assets/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "#textarea",
    height:200,
plugins: [
    "advlist autolink lists link image charmap print preview anchor",
    "searchreplace visualblocks code fullscreen",
    "insertdatetime media table contextmenu paste "
],
toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter      alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
	<!-- content starts -->
	<script>
	function delete_album($id) {
		var check = confirm('Are you sure you want to delete?');
		var id = $id;
		 if (check == true) {
	          window.location.href = "delete_photo_album/".concat(id);
	        }
	        else {
	            return false;
	        }
	}

	function update_album($id) {
		var id = $id;
	    window.location.href = "/CI/admin/add-new-photo-album/".concat(id);
	}
	</script>
	<div class="container" style="margin-top:60px;">
  	<div class="row">
			
			<h2>Manage Photo Album</h2>
			<?php if( $query != '' ): foreach($query as $post): ?>
			<?php echo form_open('admin/add-new-photo-album/'.$post->album_id);?>
			
			<p><label>ID</label><br>
			<input type="text" name="album_id" style="display:block;width:100%"/ value="<?php echo $post->album_id ?>" readonly></p>

			<p><label>Name</label><br>
			<input type="text" name="album_name"  style="display:block;width:100%" value="<?php echo $post->album_name ?>"/></p>
		
			<p><label>Taken Where</label><br>
			<input type="text" name="album_location" style="display:block;width:100%"  value="<?php echo $post->album_location ?>"/></p>

			<p><label>Taken When</label><br>
			<input type="text" name="album_date" style="display:block;width:100%"  value="<?php echo $post->album_date ?>"/></p>

			<p><label>Cover</label><br>
			<input type="text" name="album_cover" style="display:block;width:100%" value="<?php echo $post->album_cover ?>" /></p>

			<p><label>Story</label>
			<textarea rows="16" cols="80%" name="album_story" style="resize:none;" id="textarea"><?php echo $post->album_story ?></textarea></p>

			<p><label>Embed Code</label><br>
			<textarea rows="16" cols="80%" name="album_embed" style="resize:none;"><?php echo $post->album_embed ?></textarea></p>
			<br />	
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>

			<?php endforeach; else:?>
			<?php echo form_open('admin/add_new_photo_album');?>
			
			<?php if(validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
            <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
			
			<p><label>Name</label><br>
			<input type="text" name="album_name"  style="display:block;width:100%"/></p>
		
			<p><label>Taken Where</label><br>
			<input type="text" name="album_location" style="display:block;width:100%" /></p>

			<p><label>Taken When</label><br>
			<input type="text" name="album_date" style="display:block;width:100%" /></p>

			<p><label>Cover</label><br>
			<input type="text" name="album_cover" style="display:block;width:100%" /></p>

			<p><label>Story</label>
			<textarea rows="16" cols="80%" name="album_story" style="resize:none;" id="textarea"></textarea></p>

			<p><label>Embed Code</label><br>
			<textarea rows="16" cols="80%" name="album_embed" style="resize:none;"></textarea></p>
			<br />
			

			<br />	
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>
		<?php endif; ?>

			<h2>Existing Albums</h2>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Album ID</th>
						<th>Album Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tr>
				<?php if( isset($categories) && $categories): foreach($categories as $category): ?>
					<?php 
						echo '<td>'.$category->album_id.'</td>';
						echo '<td>'.$category->album_name.'</td>';
						echo '<td>
							<button class="button" onclick="update_album('.$category->album_id.')">update</button>
							<button class="button" onclick="delete_album('.$category->album_id.')">delete</button>
							</td>';
					?>
				</tr>
				<?php endforeach; else:?>
				<td colspan="4">There is no category.</td>
				<?php endif; ?>
			</table>
			

			
			
	</div>
</div>