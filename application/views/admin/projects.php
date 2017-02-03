<script>
function delete_design($id) {
	var check = confirm('Are you sure you want to delete?');
	var id = $id;
	 if (check == true) {
          window.location.href = "delete_project/".concat(id);
        }
        else {
            return false;
        }
}
function update_design($id) {
	var id = $id;
    window.location.href = "projects/".concat(id);
}
</script>
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
<div class="container" style="margin-top:60px;">
  	<div class="row">
			<?php if(validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
            <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
			<?php if( $status != "add" ): foreach($query as $post): ?>

			<h2>Edit Project</h2>
			<?php echo form_open('admin/projects/'.$post->id);?>
			
			<p><label>Name</label><br>
			<input type="text" name="name" style="display:block;width:100%" value="<?php echo $post->name ?>"/><p>
			
			<p><label>Image</label><br>
			<input type="text" name="img"  style="display:block;width:100%" value="<?php echo $post->img ?>"/></p>

			<p><label>Link</label><br>
			<input type="text" name="link"  style="display:block;width:100%" value="<?php echo $post->link ?>" /></p>
			
			<p><label>Behance</label><br>
			<input type="text" name="behance"  style="display:block;width:100%" value="<?php echo $post->behance ?>" /></p>

			<p><label>Descriptions/Features</label>
			<textarea rows="16" cols="80%" name="exp" style="resize:none;height:500px" id="textarea"> <?php echo $post->exp ?></textarea></p>
			
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>

			<?php endforeach; else:?>

			<h2>Add New Project</h2>
			<?php echo form_open('admin/projects');?>
			
			<p><label>Name</label><br>
			<input type="text" name="name" style="display:block;width:100%" /><p>
			
			<p><label>Image</label><br>
			<input type="text" name="img" style="display:block;width:100%"/></p>

			<p><label>Link</label><br>
			<input type="text" name="link" style="display:block;width:100%" /></p>
			
			<p><label>Behance</label><br>
			<input type="text" name="behance" style="display:block;width:100%" /></p>

			<p><label>Descriptions/Features</label>
			<textarea rows="16" cols="80%" name="exp" style="resize:none;height:500px" id="textarea"></textarea></p>
			
			
			<br />	
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>

			<?php endif; ?>


			<br><br><br>
			<h2>Existing Porjects</h2>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tr>
				<?php if( isset($categories) && $categories): foreach($categories as $category): ?>
					<?php 
						echo '<td>'.$category->id.'</td>';
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