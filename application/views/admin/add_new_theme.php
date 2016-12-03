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
			<h2>Edit Theme</h2>
			<?php echo form_open_multipart('admin/update-theme');?>
			
			<?php if(validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
            <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
			
			<p><label>Theme ID</label><br>
			<input type="text" name="theme_id" style="display:block;width:100%" value="<?php echo $post->theme_id ?>" disable/></p>

			<p><label>Theme Name</label><br>
			<input type="text" name="theme_name" style="display:block;width:100%" value="<?php echo $post->theme_name ?>"/></p>

			<p><label>Image Preview</label><br>
			<input type="text" name="theme_image" style="display:block;width:100%"  value="<?php echo $post->theme_image ?>"/></p>

			<p><label>Preview Link</label><br>
			<textarea rows="16" cols="80%" name="theme_preview" style="resize:none;height:500px"> <?php echo $post->theme_preview ?></textarea></p>
			
			<p><label>Code Link</label><br>
			<input type="text" name="theme_code"  style="display:block;width:100%"  value="<?php echo $post->theme_code ?>"/></p>

			<p><label>Descriptions/Features</label>
			<textarea rows="16" cols="80%" name="theme_body" style="resize:none;height:500px" id="textarea"> <?php echo $post->theme_body ?></textarea></p>
			
			<br />	
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>

			<?php endforeach; else:?>

			<h2>Add New Theme</h2>
			<?php echo form_open_multipart('admin/add-new-theme');?>
			
			<?php if(validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
            <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
			
			<p><label>Theme Name</label><br>
			<input type="text" name="theme_name"  style="display:block;width:100%"/></p>
			
			
			<p><label>Theme Type</label><br>
				<?php if( isset($categories) && $categories): foreach($categories as $category): ?>
				<label><input class="checkbox" type="checkbox" name="theme_category[]" value="<?php echo $category->category_id;?>"><?php echo $category->category_name;?></label><br>
				<?php endforeach; else:?>
				Please add your category first!
				<?php endif; ?>
			</p>

			<p><label>Image Preview</label><br>
			<input type="text" name="theme_image" style="display:block;width:100%" /></p>

			<p><label>Preview Link</label><br>
			<textarea rows="16" cols="80%" name="theme_preview" style="resize:none;height:500px"></textarea></p>

			<p><label>Code Link</label><br>
			<input type="text" name="theme_code"  style="display:block;width:100%" /></p>

			<p><label>Descriptions/Features</label>
			<textarea rows="16" cols="80%" name="theme_body" style="resize:none;height:500px" id="textarea"></textarea></p>
			
			<br />	
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>
			
			<?php endif;?>

			
			
	</div>
</div>