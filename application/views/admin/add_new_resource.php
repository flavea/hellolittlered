<div class="card-panel white">
	<?php if( $query != '' ): foreach($query as $post): ?>
		<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Edit Resource</h2>
		<?php echo form_open('admin/update_resource/'.$post->resource_id);?>

		<input type="hidden" name="resource_id" value="<?php echo $post->resource_id ?>" readonly>

		<div class="input-field">
			<label>Name</label>
			<input type="text" name="resource_name" value="<?php echo $post->resource_name ?>">
		</div>

		<label>Type</label><br>
		<?php if( isset($categories) && $categories): foreach($categories as $category): ?>
			<input type="radio" name="resource_category" value="<?php echo $category->type_id;?>"id="status-<?php echo $category->type_id;?>"  <?php if($post->resource_type == $category->type_id) echo 'checked';?>>
			<label for="status-<?php echo $category->type_id;?>" style="margin-right:1em"><?php echo $category->type_name;?></label>
		<?php endforeach; else:?>
		Please add your category first!
	<?php endif; ?>


	<div class="input-field">
		<label>Preview</label>
		<input type="url" name="resource_preview" value="<?php echo $post->resource_preview ?>"/>
	</div>

	<div class="input-field">
		<label>Download</label>
		<input type="url" name="resource_download" value="<?php echo $post->resource_download ?>"/>
	</div>

	<label>Status</label><br>

	<?php if( isset($statuses) && $statuses): foreach($statuses as $status): ?>
		<input name="status" type="radio" id="status-<?php echo $status->id;?>" value="<?php echo $status->id;?>" <?php if($post->status == $status->id) echo 'checked';?>/>
		<label for="status-<?php echo $status->id;?>" style="margin-right:1em"><?php echo $status->name;?></label>
	<?php endforeach;endif; ?>

	<div class="switch">
		<label>
			<input type="checkbox" name="tweet" value="1"  />
			<span class="lever"></span>
			Tweet?
		</label>
	</div>
	<br>
	<br>
	<input class="waves-effect waves-light btn red darken-4" type="submit" value="Submit"/>
	<input class="waves-effect waves-light btn red darken-4" type="reset" value="Reset"/>	

</form>

<?php endforeach; else:?>

	<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Add New Resource</h2>
	<?php echo form_open('admin/add-new-resource');?>

	<div class="input-field">
		<label>Name</label>
		<input type="text" name="resource_name"/>
	</div>

	<label>Type</label><br>
	<?php if( isset($categories) && $categories): foreach($categories as $category): ?>
		<input type="radio" name="resource_category" value="<?php echo $category->type_id;?>"id="status-<?php echo $category->type_id;?>">
		<label for="status-<?php echo $category->type_id;?>" style="margin-right:1em"><?php echo $category->type_name;?></label>
	<?php endforeach; else:?>
	Please add your category first!
<?php endif; ?>

<div class="input-field">
	<label>Preview</label>
	<input type="text" name="resource_preview"/>
</div>

<div class="input-field">
	<label>Download</label>
	<input type="text" name="resource_download" />
</div>

<label>Status</label><br>

<?php if( isset($statuses) && $statuses): foreach($statuses as $status): ?>
	<input name="status" type="radio" id="status-<?php echo $status->id;?>" value="<?php echo $status->id;?>" />
	<label for="status-<?php echo $status->id;?>" style="margin-right:1em"><?php echo $status->name;?></label>
<?php endforeach;endif; ?>
<br>
<br>
<input class="waves-effect waves-light btn red darken-4" type="submit" value="Submit"/>
<input class="waves-effect waves-light btn red darken-4" type="reset" value="Reset"/>	

</form>

<?php endif;?>

</div>