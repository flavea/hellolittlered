	<!-- content starts -->
	<script>
		function delete_sb($id) {
			var check = confirm('Are you sure you want to delete?');
			var id = $id;
			if (check == true) {
				window.location.href = "<?=base_url()?>admin/delete_sidebar/".concat(id);
			}
			else {
				return false;
			}
		}

		function update_sb($id) {
			var id = $id;
			window.location.href = "<?=base_url()?>admin/sidebar/".concat(id);
		}
	</script>
	
	<div class="card-panel white">
		<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Manage Sidebar</h2>
		<?php if( $query != '' ): foreach($query as $post): ?>
			<?php echo form_open('admin/sidebar/'.$post->id);?>
			
			<input type="hidden" name="id" / value="<?php echo $post->id ?>" readonly>

			<div class="input-field">
				<label>Name</label>
				<input type="text" name="name"   value="<?php echo $post->name ?>" required/>
			</div>

			<p>
				<label>Status</label><br>

				<?php if( isset($statuses) && $statuses): foreach($statuses as $status): ?>
					<input name="status" type="radio" id="status-<?php echo $status->id;?>" value="<?php echo $status->id;?>" <?php if($post->status == $status->id) echo 'checked';?>/>
					<label for="status-<?php echo $status->id;?>" style="margin-right:1em"><?php echo $status->name;?></label>
				<?php endforeach;endif; ?>
			</p>
			
			<div class="input-field">
				<label>Content</label>
				<textarea rows="16" cols="80%" name="content" style="resize:none;" id="textarea" class="materialize-textarea"><?php echo $post->content ?></textarea>
			</div>
			
			
			<input class="waves-effect waves-light btn red darken-4" type="submit" value="Submit"/>
			<input class="waves-effect waves-light btn red darken-4" type="reset" value="Reset"/>	
			
		</form>

	<?php endforeach; else:?>
	<?php echo form_open('admin/sidebar');?>
	
	<div class="input-field">
		<label>Name</label>
		<input type="text" name="name" required />
	</div>

	
	<p>
		<label>Status</label><br>

		<?php if( isset($statuses) && $statuses): foreach($statuses as $status): ?>
			<input name="status" type="radio" id="status-<?php echo $status->id;?>" value="<?php echo $status->id;?>" />
			<label for="status-<?php echo $status->id;?>" style="margin-right:1em"><?php echo $status->name;?></label>
		<?php endforeach;endif; ?>
	</p>

	<div class="input-field"><label>Content</label>
		<textarea rows="16" cols="100%" name="content" id="textarea" class="materialize-textarea"></textarea>
	</div>
	
	<input class="waves-effect waves-light btn red darken-4" type="submit" value="Submit"/>
	<input class="waves-effect waves-light btn red darken-4" type="reset" value="Reset"/>	
	
</form>
<?php endif; ?>
</div>

<div class="card-panel white">
	<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Existing Sidebars</h2>
	<table class="highlight striped">
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
				<button class="waves-effect waves-light btn red darken-4" onclick="update_sb('.$category->id.')">update</button>
				<button class="waves-effect waves-light btn red darken-4" onclick="delete_sb('.$category->id.')">delete</button>
			</td>';
			?>
		</tr>
	<?php endforeach; else:?>
	<td colspan="4">There is no category.</td>
<?php endif; ?>
</table>




</div>
</div>