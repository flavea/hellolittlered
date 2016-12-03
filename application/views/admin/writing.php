<script>
function delete_writing($id) {
	var check = confirm('Are you sure you want to delete?');
	var id = $id;
	 if (check == true) {
          window.location.href = "delete_writing/".concat(id);
        }
        else {
            return false;
        }
}
function update_writing($id) {
	var id = $id;
    window.location.href = "writing/".concat(id);
}
</script>

<div class="container" style="margin-top:60px;">
  	<div class="row">
			
			<h2>Add New Story</h2>
			<?php if(validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
            <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
			<?php if( $query != '' ): foreach($query as $post): ?>
			<?php echo form_open('admin/writing/'.$post->id);?>
			
			<p><label>Title</label><br>
			<input type="text" name="title" style="display:block;width:100%" value="<?php echo $post->title ?>"/><p>
			
			<p><label>Type</label><br>
			<input type="text" name="type"  style="display:block;width:100%" value="<?php echo $post->type ?>"/></p>

			<p><label>Genre</label><br>
			<input type="text" name="genre"  style="display:block;width:100%" value="<?php echo $post->genre ?>" /></p>
			
			<p><label>Rating</label><br>
			<input type="text" name="rating"  style="display:block;width:100%" value="<?php echo $post->rating ?>" /></p>
			
			<p><label>Fandom</label><br>
			<input type="text" name="fandom"  style="display:block;width:100%" value="<?php echo $post->fandom ?>" /></p>
			
			<p><label>Pairs</label><br>
			<input type="text" name="pairs"  style="display:block;width:100%" value="<?php echo $post->pairs ?>" /></p>
			
			<p><label>Summary</label><br>
			<input type="text" name="summary"  style="display:block;width:100%" value="<?php echo $post->summary ?>" /></p>
			
			<p><label>Link 1</label><br>
			<input type="text" name="link1"  style="display:block;width:100%" value="<?php echo $post->link1 ?>" /></p>
			
			<p><label>Link 2</label><br>
			<input type="text" name="link2"  style="display:block;width:100%" value="<?php echo $post->link2 ?>" /></p>
			
			<p><label>Link 3</label><br>
			<input type="text" name="link3"  style="display:block;width:100%" value="<?php echo $post->link3 ?>" /></p>

			<p><label>Hide</label><br>
			<input type="text" name="hide"  style="display:block;width:100%" value="<?php echo $post->hide ?>" /></p>
			
			<p><label>Language</label><br>
			<input type="text" name="hide"  style="display:block;width:100%" value="<?php echo $post->language ?>" /></p>
			
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>

			<?php endforeach; else:?>
			<?php echo form_open('admin/writing');?>
			
			
			<p><label>Title</label><br>
			<input type="text" name="title" style="display:block;width:100%"/><p>
			
			<p><label>Type</label><br>
			<input type="text" name="type"  style="display:block;width:100%"/></p>

			<p><label>Genre</label><br>
			<input type="text" name="genre"  style="display:block;width:100%" /></p>
			
			<p><label>Rating</label><br>
			<input type="text" name="rating"  style="display:block;width:100%"/></p>
			
			<p><label>Fandom</label><br>
			<input type="text" name="fandom"  style="display:block;width:100%"/></p>
			
			<p><label>Pairs</label><br>
			<input type="text" name="pairs"  style="display:block;width:100%" /></p>
			
			<p><label>Summary</label><br>
			<input type="text" name="summary"  style="display:block;width:100%" /></p>
			
			<p><label>Link 1</label><br>
			<input type="text" name="link1"  style="display:block;width:100%"/></p>
			
			<p><label>Link 2</label><br>
			<input type="text" name="link2"  style="display:block;width:100%" /></p>
			
			<p><label>Link 3</label><br>
			<input type="text" name="link3"  style="display:block;width:100%" /></p>

			<p><label>Hide</label><br>
			<input type="text" name="hide"  style="display:block;width:100%" /></p>
			<p><label>Language</label><br>
			<input type="text" name="language"  style="display:block;width:100%" /></p>
			
			
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
						<th>Title</th>
						<th>Type</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tr>
				<?php if( isset($categories) && $categories): foreach($categories as $category): ?>
					<?php 
						echo '<td>'.$category->id.'</td>';
						echo '<td>'.$category->title.'</td>';
						echo '<td>'.$category->type.'</td>';
						echo '<td>
							<button class="button" onclick="update_writing('.$category->id.')">update</button>
							<button class="button" onclick="delete_writing('.$category->id.')">delete</button>
							</td>';
					?>
				</tr>
				<?php endforeach; else:?>
				<td colspan="4">There is no category.</td>
				<?php endif; ?>
			</table>
		</div>
	</div>