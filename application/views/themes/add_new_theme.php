

<div class="post">
	<?php if( $query != '' ): foreach($query as $post): ?>
		<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Edit Theme</h2>
		<?= form_open_multipart('themes/update-theme');?>

		<input type="hidden" name="theme_id" value="<?= $post->theme_id ?>"/>
		<div class="input-field">
			<label>Theme Name</label>
			<input type="text" name="theme_name" value="<?= $post->theme_name ?>" required/>
		</div>

		<p>
			<label>Status</label><br>

			<?php if( isset($statuses) && $statuses): foreach($statuses as $status): ?>
				<input name="status" type="radio" id="status-<?= $status->id;?>" value="<?= $status->id;?>" <?php if($post->status == $status->id) echo 'checked';?>/>
				<label for="status-<?= $status->id;?>" style="margin-right:1em"><?= $status->name;?></label>
			<?php endforeach;endif; ?>
		</p>

		<div class="input-field">
			<label>Image Preview</label>
			<input type="url" name="theme_image"value="<?= $post->theme_image ?>" required/>
		</div>

		<div class="input-field">
			<label>Preview Code</label>
			<textarea rows="16" cols="80%" name="theme_preview" style="resize:none;max-height:300px;overflow: auto;" class="materialize-textarea"> <?= $post->theme_preview ?></textarea>
		</div>

		<div class="input-field">
			<label>Code Link</label>
			<input type="url" name="theme_code" value="<?= $post->theme_code ?>"/>
		</div>

		<label>Descriptions/Features (English)</label>
		<textarea rows="16" cols="80%" name="theme_body" id="textarea"> <?= $post->theme_body ?></textarea>

		<label>Descriptions/Features (Indonesian)</label>
		<textarea rows="16" cols="80%" name="theme_body_id" id="textarea"> <?= $post->theme_body_id ?></textarea>

		<div class="switch">
			<label>
				<input type="checkbox" name="tweet" value="1"  />
				<span class="lever"></span>
				Tweet?
			</label>
		</div>


		<input class="button button-inverse" type="submit" value="Submit"/>
		<input class="button button-inverse" type="reset" value="Reset"/>	

	</form>

<?php endforeach; else:?>

	<h2>Add New Theme</h2>
	<?= form_open_multipart('themes/add-new-theme');?>

	<div class="input-field">
		<label>Theme Name</label>
		<input type="text" name="theme_name" required />
	</div>

	<p>
		<label>Status</label><br>

		<?php if( isset($statuses) && $statuses): foreach($statuses as $status): ?>
			<input name="status" type="radio" id="status-<?= $status->id;?>" value="<?= $status->id;?>" />
			<label for="status-<?= $status->id;?>" style="margin-right:1em"><?= $status->name;?></label>
		<?php endforeach;endif; ?>
	</p>

	<p>
		<label>Status</label>
		<?php if( isset($categories) && $categories): foreach($categories as $category): ?>
			<input class="checkbox" type="checkbox" name="theme_category[]" id="cat-<?= $category->category_id;?>" value="<?= $category->category_id;?>">
			<label for="cat-<?= $category->category_id;?>" style="margin-right:1em"><?= $category->category_name;?></label>
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

	<label>Descriptions/Features (English)</label>
	<textarea rows="16" cols="80%" name="theme_body" style="resize:none;height:500px" id="textarea"></textarea>

	<label>Descriptions/Features (Indonesian)</label>
	<textarea rows="16" cols="80%" name="theme_body_id" id="textarea"></textarea>

	<div class="switch">
		<label>
			<input type="checkbox" name="tweet" value="1"  />
			<span class="lever"></span>
			Tweet?
		</label>
	</div>


	<input class="button button-inverse" type="submit" value="Submit"/>
	<input class="button button-inverse" type="reset" value="Reset"/>	

</form>

<?php endif;?>

</div>
<script>
	CKEDITOR.replace( 'theme_body' );
	CKEDITOR.replace( 'theme_body_id' );
</script>
