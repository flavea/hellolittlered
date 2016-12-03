
	<!-- content starts -->
	<div class="container" style="margin-top:60px;">
  	<div class="row">
	
			<h2>Add New Entry</h2>
			<?php echo form_open('admin/add-new-photo');?>
			
			<?php if(validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
            <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
			
			<p><label>Name</label><br>
			<input type="text" name="photo_name"  style="display:block;width:100%"/></p>
			
			
			<p><label>Album</label><br>
				<?php if( isset($categories) && $categories): foreach($categories as $category): ?>
				<label style="display:block;">
					<input class="checkbox" type="checkbox" name="photo_album" value="<?php echo $category->album_id;?>">
					<?php echo $category->album_name;?><br>
				</label>
				<?php endforeach; else:?>
				Please add your album first!
				<?php endif; ?>
			</p>

			<p><label>Image</label><br>
			<input type="text" name="photo_image" style="display:block;width:100%" /></p>

			<br />	
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>

	</div>
</div>