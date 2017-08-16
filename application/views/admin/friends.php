<script>
	function delete_friend($id) {
		var check = confirm('Are you sure you want to delete?');
		var id = $id;
		if (check == true) {
			window.location.href = "<?=base_url()?>admin/delete_friend/".concat(id);
		}
		else {
			return false;
		}
	}
</script>


<div class="card-panel white">
	<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Manage Friends</h2>

	<?php if( $query != '' ): foreach($query as $post): ?>
		<?php echo form_open('admin/friends/'.$post->id);?>

		<input type="hidden" name="id" value="<?php echo $post->id ?>" >

		<div class="input-field">
			<label>Design Name</label>
			<input type="text" name="name"value="<?php echo $post->name ?>"  required>
		</div>

		<div class="input-field">
			<label>Website</label>
			<input type="url" name="website" value="<?php echo $post->website ?>" required/>
		</div>

		<div class="input-field">
			<label>Description</label>
			<input type="text" name="description" value="<?php echo $post->description ?>" />
		</div>


		<label>Status</label><br>

		<?php if( isset($statuses) && $statuses): foreach($statuses as $status): if($status->alias != ""):?>
			<input name="status" type="radio" id="status-<?php echo $status->id;?>" value="<?php echo $status->id;?>" <?php if($post->status == $status->id) echo 'checked';?>/>
			<label for="status-<?php echo $status->id;?>" style="margin-right:1em"><?php echo $status->alias;?></label>
		<?php endif;endforeach;endif; ?>


		<div class="switch">
			<label>
				<input type="checkbox" name="tweet" value="1"  />
				<span class="lever"></span>
				Tweet?
			</label>
		</div>

		<p>
		<input class="waves-effect waves-light btn red darken-4" type="submit" value="Submit"/>
		<input class="waves-effect waves-light btn red darken-4" type="reset" value="Reset"/>
		</p>	

	</form>

<?php endforeach; else:?>
	<?php echo form_open('admin/friends');?>

	<div class="input-field">
		<label>Name</label>
		<input type="text" name="name" required>
	</div>

	<div class="input-field">
		<label>Website</label>
		<input type="url" name="website" required>
	</div>

	<div class="input-field">
		<label>Description</label>
		<input type="text" name="description" />
	</div>

	<label>Status</label><br>
	<?php if( isset($statuses) && $statuses): foreach($statuses as $status): if($status->alias != ""): ?>
		<input name="status" type="radio" id="status-<?php echo $status->id;?>" value="<?php echo $status->id;?>"/>
		<label for="status-<?php echo $status->id;?>" style="margin-right:1em"><?php echo $status->alias;?></label>
	<?php endif;endforeach;endif; ?>

	<div class="switch">
		<label>
			<input type="checkbox" name="tweet" value="1"  />
			<span class="lever"></span>
			Tweet?
		</label>
	</div>
			
	<p>
	<input class="waves-effect waves-light btn red darken-4" type="submit" value="Submit"/>
	<input class="waves-effect waves-light btn red darken-4" type="reset" value="Reset"/>
	</p>	

</form>

<?php endif; ?>

</div>

<div class="card-panel white">
	<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Friends</h2>
	<table class="highlight striped">
		<thead>
			<tr>
				<th>ID</th>
				<th>Image</th>
				<th>Name</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tr>
			<?php if( isset($categories) && $categories): foreach($categories as $category): ?>
				<?php 
				echo '<td>'.$category->id.'</td>';
				echo '<td>'.$category->name.'</td>';
				echo '<td>'.$category->website.'</td>';
				echo '<td>'.$category->alias.'</td>';
				echo '<td>
				<a class="waves-effect waves-light btn red darken-4" href="'.base_url().'admin/friends/'.$category->id.'">update</a>
				<button class="waves-effect waves-light btn red darken-4" onclick="delete_design('.$category->id.')">delete</button>
			</td>';
			?>
		</tr>
	<?php endforeach; else:?>
	<td colspan="4">There is no friends yet.</td>
<?php endif; ?>
</table>
</div>