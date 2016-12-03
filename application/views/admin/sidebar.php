	<!-- content starts -->
	<script>
	function delete_sb($id) {
		var check = confirm('Are you sure you want to delete?');
		var id = $id;
		 if (check == true) {
	          window.location.href = "delete_sidebar/".concat(id);
	        }
	        else {
	            return false;
	        }
	}

	function update_sb($id) {
		var id = $id;
	    window.location.href = "/admin/sidebar/".concat(id);
	}
	</script>
	<div class="container" style="margin-top:60px;">
  	<div class="row">
			
			<h2>Manage Photo Album</h2>
			<?php if( $query != '' ): foreach($query as $post): ?>
			<?php echo form_open('admin/sidebar/'.$post->id);?>
			
			<p><label>ID</label><br>
			<input type="text" name="id" style="display:block;width:100%"/ value="<?php echo $post->id ?>" readonly></p>

			<p><label>Name</label><br>
			<input type="text" name="name"  style="display:block;width:100%" value="<?php echo $post->name ?>"/></p>
		
			<p><label>Content</label><br>
			<textarea rows="16" cols="80%" name="content" style="resize:none;" id="textarea"><?php echo $post->content ?></textarea></p>
			<br />	
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>

			<?php endforeach; else:?>
			<?php echo form_open('admin/sidebar');?>
			
			<?php if(validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
            <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
			
			<p><label>Name</label><br>
			<input type="text" name="name"  style="display:block;width:100%"/></p>

			<p><label>Content</label><br>
			<textarea rows="16" cols="100%" name="content" style="resize:none;height:200px" id="textarea"></textarea></p>

			<br />	
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>
		<?php endif; ?>

			<h2>Existing Sidebars</h2>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th width="20%">Sidebar Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tr>
				<?php if( isset($categories) && $categories): foreach($categories as $category): ?>
					<?php 
						echo '<td>'.$category->name.'</td>';
						echo '<td>
							<button class="button" onclick="update_sb('.$category->id.')">update</button>
							<button class="button" onclick="delete_sb('.$category->id.')">delete</button>
							</td>';
					?>
				</tr>
				<?php endforeach; else:?>
				<td colspan="4">There is no category.</td>
				<?php endif; ?>
			</table>
			

			
			
	</div>
</div>