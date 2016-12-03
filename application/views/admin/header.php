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
			<h2>Change Header</h2>
			<?php echo form_open('admin/header');?>

			<?php if(validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
            <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
			
			<p><label>ID</label><br>
			<input type="text" name="id" style="display:block;width:100%" value="<?php echo $post->id ?>" readonly/><p>
			
			<p><label>Image Link</label><br>
			<input type="text" name="link" style="display:block;width:100%" value="<?php echo $post->link ?>" /><p>

			<br />	
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>
		<?php endforeach; endif;?>

		</div>
	</div>