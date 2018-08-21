<script>
	function delete_design($id) {
		var check = confirm('Are you sure you want to delete?');
		var id = $id;
		if (check == true) {
			window.location.href = "<?=base_url()?>graphics/delete_design/".concat(id);
		}
		else {
			return false;
		}
	}
</script>


<div class="card-panel white">
	<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Manage Designs</h2>

	<?php if( $query != '' ): foreach($query as $post): ?>
		<?= form_open('graphics/design/'.$post->id);?>

		<input type="hidden" name="id" value="<?= $post->id ?>" >

		<div class="input-field">
			<label>Design Name</label>
			<input type="text" name="name"value="<?= $post->name ?>"  required>
		</div>

		<div class="input-field">
			<label>Image</label>
			<input type="url" name="image" value="<?= $post->image ?>" required/>
		</div>

		<div class="input-field">
			<label>Redbubble</label>
			<input type="url" name="redbubble" value="<?= $post->redbubble ?>" />
		</div>

		<div class="input-field">
			<label>Tees</label>
			<input type="url" name="tees" value="<?= $post->tees ?>" />
		</div>


		<label>Status</label><br>

		<?php if( isset($statuses) && $statuses): foreach($statuses as $status): ?>
			<input name="status" type="radio" id="status-<?= $status->id;?>" value="<?= $status->id;?>" <?php if($post->status == $status->id) echo 'checked';?>/>
			<label for="status-<?= $status->id;?>" style="margin-right:1em"><?= $status->name;?></label>
		<?php endforeach;endif; ?>

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
	<?= form_open('graphics/design');?>

	<div class="input-field">
		<label>Design Name</label>
		<input type="text" name="name">
	</div>

	<div class="input-field">
		<label>Image</label>
		<input type="text" name="image" />
	</div>

	<div class="input-field">
		<label>Redbubble</label>
		<input type="text" name="redbubble" />
	</div>

	<div class="input-field">
		<label>Tees</label>
		<input type="text" name="tees" />
	</div>		

	<label>Status</label><br>
	<?php if( isset($statuses) && $statuses): foreach($statuses as $status): ?>
		<input name="status" type="radio" id="status-<?= $status->id;?>" value="<?= $status->id;?>"/>
		<label for="status-<?= $status->id;?>" style="margin-right:1em"><?= $status->name;?></label>
	<?php endforeach;endif; ?>	

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
	<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Existing Designs</h2>
	<table class="highlight striped">
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
				<a class="waves-effect waves-light btn red darken-4" href="'.base_url().'graphics/design/'.$category->id.'">update</a>
				<button class="waves-effect waves-light btn red darken-4" onclick="delete_design('.$category->id.')">delete</button>
			</td>';
			?>
		</tr>
	<?php endforeach; else:?>
	<td colspan="4">There is no category.</td>
<?php endif; ?>
</table>
</div>