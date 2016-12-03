<script>
function delete_category($id) {
	var check = confirm('Are you sure you want to delete?');
	var id = $id;
	 if (check == true) {
          window.location.href = "delete_category/".concat(id);
        }
        else {
            return false;
        }
}
</script>

<div class="container" style="margin-top:60px;">
  	<div class="row">
		
			<?php if( $query  ): foreach($query as $post): ?>
			<h2>Add New Category</h2>
			<?php echo form_open('admin/socmeds');?>

			<?php if(validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
            <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
			
			<p><label>ID</label><br>
			<input type="text" name="id" style="display:block;width:100%" value="<?php echo $post->id ?>" readonly/><p>

			<p><label>Codepen</label><br>
			<input type="text" name="codepen" style="display:block;width:100%" value="<?php echo $post->codepen ?>" /><p>

			<p><label>Deviantart</label><br>
			<input type="text" name="deviantart" style="display:block;width:100%" value="<?php echo $post->deviantart ?>" /><p>

			<p><label>Facebook</label><br>
			<input type="text" name="facebook" style="display:block;width:100%" value="<?php echo $post->facebook ?>" /><p>

			<p><label>Flickr</label><br>
			<input type="text" name="flickr" style="display:block;width:100%" value="<?php echo $post->flickr ?>" /><p>

			<p><label>Instagram</label><br>
			<input type="text" name="instagram" style="display:block;width:100%" value="<?php echo $post->instagram ?>" /><p>

			<p><label>Linkedin</label><br>
			<input type="text" name="linkedin" style="display:block;width:100%" value="<?php echo $post->linkedin ?>" /><p>

			<p><label>Soundcloud</label><br>
			<input type="text" name="soundcloud" style="display:block;width:100%" value="<?php echo $post->soundcloud ?>" /><p>

			<p><label>Twitter</label><br>
			<input type="text" name="twitter" style="display:block;width:100%" value="<?php echo $post->twitter ?>" /><p>

			<p><label>Tumblr</label><br>
			<input type="text" name="tumblr" style="display:block;width:100%" value="<?php echo $post->tumblr ?>" /><p>

			<p><label>Youtube</label><br>
			<input type="text" name="youtube" style="display:block;width:100%" value="<?php echo $post->youtube ?>" /><p>

			<p><label>Behance</label><br>
			<input type="text" name="behance" style="display:block;width:100%" value="<?php echo $post->behance ?>" /><p>

			<p><label>Github</label><br>
			<input type="text" name="github" style="display:block;width:100%" value="<?php echo $post->github ?>" /><p>
			
			<br />	
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>
		<?php endforeach; endif;?>

		</div>
	</div>