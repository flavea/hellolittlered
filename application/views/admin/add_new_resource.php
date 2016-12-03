
	<!-- content starts -->
	<div class="container" style="margin-top:60px;">
  	<div class="row">
			<?php if( $query != '' ): foreach($query as $post): ?>
			<h2>Edit Resource</h2>
			<?php echo form_open('admin/update_resource/'.$post->resource_id);?>
			
			<p><label>ID</label><br>
			<input type="text" name="resource_id" style="display:block;width:100%"/ value="<?php echo $post->resource_id ?>" readonly></p>

			<p><label>Name</label><br>
			<input type="text" name="resource_name" style="display:block;width:100%"/ value="<?php echo $post->resource_name ?>"></p>
			
			<p><label>Preview</label><br>
			<input type="text" name="resource_preview" style="display:block;width:100%"  value="<?php echo $post->resource_preview ?>"/></p>

			<p><label>Download</label><br>
			<input type="text" name="resource_download" style="display:block;width:100%"  value="<?php echo $post->resource_download ?>"/></p>
			
			<br />	
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>

			<?php endforeach; else:?>

			<h2>Add New Resource</h2>
			<?php echo form_open('admin/add-new-resource');?>
			
			<?php if(validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
            <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
			
			<p><label>Name</label><br>
			<input type="text" name="resource_name"  style="display:block;width:100%"/></p>
			
			
			<p><label>Type</label><br>
				<?php if( isset($categories) && $categories): foreach($categories as $category): ?>
				<label><input class="checkbox" type="checkbox" name="resource_category" value="<?php echo $category->type_id;?>"><?php echo $category->type_name;?></label><br>
				<?php endforeach; else:?>
				Please add your category first!
				<?php endif; ?>
			</p>

			<p><label>Preview</label><br>
			<input type="text" name="resource_preview" style="display:block;width:100%" /></p>

			<p><label>Download</label><br>
			<input type="text" name="resource_download"  style="display:block;width:100%" /></p>

			<br />	
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>
			
			<?php endif;?>

			
			
	</div>
</div>