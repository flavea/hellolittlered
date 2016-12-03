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
	<?php if(validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
    <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
			
	<div class="container" style="margin-top:60px;">
  	<div class="row">
			<?php if( $query ): foreach($query as $post): ?>
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

			<p><label>Your Entry: (in html)</label>
			<textarea rows="16" cols="80%" name="entry_body" id="textarea"><?php echo $post->entry_body ?></textarea></p>
			
			<br />	
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>

			<?php endforeach; ?>
			<?php endif;?>
			
	</div>
</div>