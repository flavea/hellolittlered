<script>
function delete_design($id) {
	var check = confirm('Are you sure you want to delete?');
	var id = $id;
	 if (check == true) {
          window.location.href = "delete_design/".concat(id);
        }
        else {
            return false;
        }
}
function update_design($id) {
	var id = $id;
    window.location.href = "design/".concat(id);
}
</script>

<div class="container" style="margin-top:60px;">
  	<div class="row">
			
			<h2>Add New Design</h2>
			<?php if(validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
            <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
			<?php if( $query != '' ): foreach($query as $post): ?>
			<?php echo form_open('admin/design/'.$post->id);?>
			
			<p><label>Design Name</label><br>
			<input type="text" name="name" style="display:block;width:100%" value="<?php echo $post->name ?>"/><p>
			
			<p><label>Image</label><br>
			<input type="text" name="image"  style="display:block;width:100%" value="<?php echo $post->image ?>"/></p>

			<p><label>Redbubble</label><br>
			<input type="text" name="redbubble"  style="display:block;width:100%" value="<?php echo $post->redbubble ?>" /></p>
			
			<p><label>Tees</label><br>
			<input type="text" name="tees"  style="display:block;width:100%" value="<?php echo $post->tees ?>" /></p>
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>

			<?php endforeach; else:?>
			<?php echo form_open('admin/design');?>
			
			
			<p><label>Design Name</label><br>
			<input type="text" name="name" style="display:block;width:100%" /><p>
			
			<p><label>Image</label><br>
			<input type="text" name="image"  style="display:block;width:100%" /></p>

			<p><label>Redbubble</label><br>
			<input type="text" name="redbubble"  style="display:block;width:100%" /></p>
			
			<p><label>Tees</label><br>
			<input type="text" name="tees"  style="display:block;width:100%" /></p>
			
			<br />	
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>

			<?php endif; ?>


			<br><br><br>
			<h2>Existing Designs</h2>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Image</th>
						<th>Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tr>
				<?php if( isset($categories) && $categories): foreach($categories as $category): ?>
					<?php 
						echo '<td>'.$category->id.'</td>';
						echo '<td><img src="'.$category->image.'" width="100"></td>';
						echo '<td>'.$category->name.'</td>';
						echo '<td>
							<button class="button" onclick="update_design('.$category->id.')">update</button>
							<button class="button" onclick="delete_design('.$category->id.')">delete</button>
							</td>';
					?>
				</tr>
				<?php endforeach; else:?>
				<td colspan="4">There is no category.</td>
				<?php endif; ?>
			</table>
		</div>
	</div>