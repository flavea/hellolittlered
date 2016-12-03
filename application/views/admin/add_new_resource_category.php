<script>
function delete_category($id) {
	var check = confirm('Are you sure you want to delete?');
	var id = $id;
	 if (check == true) {
          window.location.href = "delete_resource_category/".concat(id);
        }
        else {
            return false;
        }
}
</script>

<div class="container" style="margin-top:60px;">
  	<div class="row">
			
			<h2>Add New Resources Category</h2>
			<?php echo form_open('admin/add-new-resource-type');?>
			
			<?php if(validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
            <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
			
			<p><label>Category Name</label><br>
			<input type="text" name="category_name" style="display:block;width:100%" /><p>
			
			<p><label>Slug</label><br>
			<input type="text" name="category_slug"  style="display:block;width:100%" /></p>
			
			<br />	
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>


			<br><br><br>
			<h2>Existing Categories</h2>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Category ID</th>
						<th>Category Name</th>
						<th>Category Slug</th>
						<th>Action</th>
					</tr>
				</thead>
				<tr>
				<?php if( isset($categories) && $categories): foreach($categories as $category): ?>
					<?php 
						echo '<td>'.$category->type_id.'</td>';
						echo '<td>'.$category->type_name.'</td>';
						echo '<td>'.$category->type_slug.'</td>';
						echo '<td>
							<button class="button" onclick="delete_category('.$category->type_id.')">delete</button>
							</td>';
					?>
				</tr>
				<?php endforeach; else:?>
				<td colspan="4">There is no category.</td>
				<?php endif; ?>
			</table>
		</div>
	</div>