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
	<div class="container" style="margin-top:60px;">
  	<div class="row">
			<?php if( $query != '' ): foreach($query as $post): ?>
			<h2>Edit Entry</h2>
			<?php echo form_open('admin/update_entry/'.$post->entry_id);?>
			
			<p><label>ID</label><br>
			<input type="text" name="entry_id" style="display:block;width:100%"/ value="<?php echo $post->entry_id ?>" readonly></p>

			<p><label>Title</label><br>
			<input type="text" name="entry_name" style="display:block;width:100%"/ value="<?php echo $post->entry_name ?>"></p>
			
			<p><label>Image</label><br>
			<input type="text" name="entry_image" style="display:block;width:100%"  value="<?php echo $post->entry_image ?>"/></p>

			<p><label>Video</label><br>
			<input type="text" name="entry_video" style="display:block;width:100%"  value="<?php echo $post->entry_video ?>"/></p>

			<p><label>Content:</label>
			<textarea rows="16" cols="80%" name="entry_body" id="textarea"><?php echo $post->entry_body ?></textarea></p>
			
			<br />	
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>

			<?php endforeach; else:?>

			<h2>Add New Entry</h2>
			<?php echo form_open('admin/add-new-entry');?>
			
			<?php if(validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
            <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
			
			<p><label>Title</label><br>
			<input type="text" name="entry_name"  style="display:block;width:100%"/></p>
			
			
			<p><label>Label</label><br>
				<?php if( isset($categories) && $categories): foreach($categories as $category): ?>
				<label><input class="checkbox" type="checkbox" name="entry_category[]" value="<?php echo $category->category_id;?>"><?php echo $category->category_name;?></label><br>
				<?php endforeach; else:?>
				Please add your category first!
				<?php endif; ?>
			</p>

			<p><label>Image</label><br>
			<input type="text" name="entry_image" style="display:block;width:100%" /></p>

			<p><label>Video</label><br>
			<input type="text" name="entry_video"  style="display:block;width:100%" /></p>

			<p><label>Your Entry: (in html)</label>
			<textarea rows="16" cols="80%" name="entry_body" style="resize:none;height:500px" id="textarea"></textarea></p>
			
			<br />	
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>
			
			<?php endif;?>

			
			
	</div>
</div>