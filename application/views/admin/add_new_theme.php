<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>

<div class="card-panel white">
	<?php if( $query != '' ): foreach($query as $post): ?>
		<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Edit Theme</h2>
		<?php echo form_open_multipart('admin/update-theme');?>

		<input type="hidden" name="theme_id" value="<?php echo $post->theme_id ?>"/>
		<div class="input-field">
			<label>Theme Name</label>
			<input type="text" name="theme_name" value="<?php echo $post->theme_name ?>" required/>
		</div>

		<p>
			<label>Status</label><br>

			<?php if( isset($statuses) && $statuses): foreach($statuses as $status): ?>
				<input name="status" type="radio" id="status-<?php echo $status->id;?>" value="<?php echo $status->id;?>" <?php if($post->status == $status->id) echo 'checked';?>/>
				<label for="status-<?php echo $status->id;?>" style="margin-right:1em"><?php echo $status->name;?></label>
			<?php endforeach;endif; ?>
		</p>

		<div class="input-field">
			<label>Image Preview</label>
			<input type="url" name="theme_image"value="<?php echo $post->theme_image ?>" required/>
		</div>

		<div class="input-field">
			<label>Preview Code</label>
			<textarea rows="16" cols="80%" name="theme_preview" style="resize:none;max-height:300px;overflow: auto;" class="materialize-textarea"> <?php echo $post->theme_preview ?></textarea>
		</div>

		<div class="input-field">
			<label>Code Link</label>
			<input type="url" name="theme_code" value="<?php echo $post->theme_code ?>"/>
		</div>

		<label>Descriptions/Features</label>
		<textarea rows="16" cols="80%" name="theme_body" id="textarea"> <?php echo $post->theme_body ?></textarea>

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

	<h2>Add New Theme</h2>
	<?php echo form_open_multipart('admin/add-new-theme');?>

	<div class="input-field">
		<label>Theme Name</label>
		<input type="text" name="theme_name" required />
	</div>

	<p>
		<label>Status</label><br>

		<?php if( isset($statuses) && $statuses): foreach($statuses as $status): ?>
			<input name="status" type="radio" id="status-<?php echo $status->id;?>" value="<?php echo $status->id;?>" />
			<label for="status-<?php echo $status->id;?>" style="margin-right:1em"><?php echo $status->name;?></label>
		<?php endforeach;endif; ?>
	</p>

	<p>
		<label>Status</label>
		<?php if( isset($categories) && $categories): foreach($categories as $category): ?>
			<input class="checkbox" type="checkbox" name="theme_category[]" id="cat-<?php echo $category->category_id;?>" value="<?php echo $category->category_id;?>">
			<label for="cat-<?php echo $category->category_id;?>" style="margin-right:1em"><?php echo $category->category_name;?></label>
		<?php endforeach; else:?>
		Please add your category first!
	<?php endif; ?>
</p>

<div class="input-field">
	<label>Image Preview</label>
	<input type="url" name="theme_image"  required/>
</div>

<div class="input-field">
	<label>Preview Code</label>
	<textarea rows="16" cols="80%" name="theme_preview" style="resize:none;max-height:300px;overflow: auto;" class="materialize-textarea"></textarea></div>

	<div class="input-field">
		<label>Code Link</label>
		<input type="url" name="theme_code"/>
	</div>

	<label>Descriptions/Features</label>
	<textarea rows="16" cols="80%" name="theme_body" style="resize:none;height:500px" id="textarea"></textarea>

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

<?php endif;?>

</div>
<script>
	CKEDITOR.replace( 'theme_body' );
</script>
