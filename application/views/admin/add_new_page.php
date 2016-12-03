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
			
			<?php if( $query != ''): foreach($query as $post): ?>
			<h2>Add New Page</h2>
			<?php echo form_open('admin/update_page');?>
			
			<?php if(validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
            <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
			
			<p><label>Page ID</label><br>
			<input type="text" name="page_id" style="display:block;width:100%" value="<?php echo $post->page_id ?>" disable/></p>

			<p><label>Title</label><br>
			<input type="text" name="page_name" style="display:block;width:100%" value="<?php echo $post->page_title ?>" /></p>

			<p><label>Slug</label><br>
			<input type="text" name="page_slug" style="display:block;width:100%"  value="<?php echo $post->slug ?>"/></p>

			<p><label>Content</label>
			<textarea rows="16" cols="80%" name="page_body" style="resize:none;" id="textarea"><?php echo $post->page_body ?>"</textarea></p>
			
			<br />	
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>
		<?php endforeach; else: ?>
		<h2>Edit Page</h2>
			<?php echo form_open('admin/add-new-page');?>
			
			<?php if(validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
            <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
			
			<p><label>Title</label><br>
			<input type="text" name="page_name" style="display:block;width:100%" /></p>

			<p><label>Slug</label><br>
			<input type="text" name="page_slug" style="display:block;width:100%" /></p>

			<p><label>Content</label>
			<textarea rows="16" cols="80%" name="page_body" style="resize:none;" id="textarea"></textarea></p>
			
			<br />	
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>
			<?php endif;?>
			
	</div>
</div>