<script>
	function delete_design($id) {
		var check = confirm('Are you sure you want to delete?');
		var id = $id;
		if (check == true) {
			window.location.href = "<?=base_url()?>lab/delete_experiment/".concat(id);
		}
		else {
			return false;
		}
	}
	function update_design($id) {
		var id = $id;
		window.location.href = "<?=base_url()?>lab/lab/".concat(id);
	}
</script>
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>

<div class="card-panel white">
	<?php if( $status != "add" ): 
	foreach($query as $post): ?>

	<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Edit Experitment</h2>
	<?= form_open('lab/lab/'.$post->id);?>

	<div class="input-field">
		<label>Name</label>
		<input type="text" name="name"value="<?= $post->name ?>" required/>
	</div>

	<p>
		<label>Status</label><br>

		<?php if( isset($statuses) && $statuses): foreach($statuses as $status): ?>
			<input name="status" type="radio" id="status-<?= $status->id;?>" value="<?= $status->id;?>" <?php if($post->status == $status->id) echo 'checked';?>/>
			<label for="status-<?= $status->id;?>" style="margin-right:1em"><?= $status->name;?></label>
		<?php endforeach;endif; ?>
	</p>

	<div class="input-field">
		<label>Image</label>
		<input type="url" name="image" value="<?= $post->image ?>"/>
	</div>

	<div class="input-field">
		<label>Link</label>
		<input type="url" name="link" value="<?= $post->link ?>"  required//>
	</div>

	<div class="input-field">
		<label>Code</label>
		<input type="url" name="code" value="<?= $post->code ?>" />
	</div>

	<div class="input-field">
		<label>Descriptions/Features</label>
		<textarea rows="16" cols="80%" name="exp" style="resize:none;height:500px" id="textarea"> <?= $post->description ?></textarea>
	</div>

	<div class="switch">
		<label>
			<input type="checkbox" name="tweet" value="1"  />
			<span class="lever"></span>
			Tweet?
		</label>
	</div>


	<input class="waves-effect waves-light btn red darken-4" type="submit" value="Submit"/>
	<input class="waves-effect waves-light btn red darken-4" type="reset" value="Reset"/>	

</form>

<?php endforeach; else:?>

	<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Add New Experiemtn</h2>
	<?= form_open('lab/lab');?>

	<div class="input-field">
		<label>Name</label>
		<input type="text" name="name" required//>
	</div>


	<p>
		<label>Status</label><br>

		<?php if( isset($statuses) && $statuses): foreach($statuses as $status): ?>
			<input name="status" type="radio" id="status-<?= $status->id;?>" value="<?= $status->id;?>" required//>
			<label for="status-<?= $status->id;?>" style="margin-right:1em"><?= $status->name;?></label>
		<?php endforeach;endif; ?>
	</p>

	<div class="input-field">
		<label>Image</label>
		<input type="url" name="image"/>
	</div>

	<div class="input-field">
		<label>Link</label>
		<input type="url" name="link" required//>
	</div>

	<div class="input-field">
		<label>Code</label>
		<input type="url" name="code"/>
	</div>

	<label>Descriptions/Features</label>
	<textarea rows="16" cols="80%" name="exp" id="textarea"></textarea>

	<div class="switch">
		<label>
			<input type="checkbox" name="tweet" value="1"  />
			<span class="lever"></span>
			Tweet?
		</label>
	</div>

	<input class="waves-effect waves-light btn red darken-4" type="submit" value="Submit"/>
	<input class="waves-effect waves-light btn red darken-4" type="reset" value="Reset"/>	

</form>

<?php endif; ?>

</div>


<div class="card-panel white">
	<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Existing Experiments</h2>
	<table class="highlight striped">
		<thead>
			<tr>
				<th>ID</th>
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
				echo '<td>'.$category->status_name.'</td>';
				echo '<td>
				<button class="waves-effect waves-light btn red darken-4" onclick="update_design('.$category->id.')">update</button>
				<button class="waves-effect waves-light btn red darken-4" onclick="delete_design('.$category->id.')">delete</button>
			</td>';
			?>
		</tr>
	<?php endforeach; else:?>
	<td colspan="4">There is no category.</td>
<?php endif; ?>
</table>
</div>

<script>
	CKEDITOR.replace( 'exp' );
</script>
