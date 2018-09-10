

<div class="post">
	<?php if( $query != '' ): foreach($query as $post): ?>
		<h2>Edit Entry</h2>
		<?= form_open('blog/update_entry/'.$post->entry_id);?>

		<input type="hidden" name="entry_id" style="display:block;width:100%"/ value="<?= $post->entry_id ?>" readonly>

		<div class="input-field">
			<label>Title</label>
			<input type="text" name="entry_name" style="display:block;width:100%" value="<?= $post->entry_name ?>">
		</div>

		<div class="input-field">
			<label>Image</label>
			<input type="text" name="entry_image" style="display:block;width:100%"  value="<?= $post->entry_image ?>"/>
		</div>

		<div class="input-field">
			<label>Video</label>
			<input type="text" name="entry_video" style="display:block;width:100%"  value="<?= $post->entry_video ?>"/>
		</div>

		<p>
			<label>Content (English)</label>
			<textarea rows="16" cols="80%" name="entry_body" id="textarea"><?= $post->entry_body ?></textarea>
		</p>

		<p>
			<label>Content (Indonesian)</label>
			<textarea rows="16" cols="80%" name="entry_body_id" id="textarea"><?= $post->entry_body_id ?></textarea>
		</p>

		<input class="button" type="submit" value="Submit"/>
		<input class="button" type="reset" value="Reset"/>	

		<?= form_close() ?>

	<?php endforeach; else:?>

	<h2>Add New Entry</h2>
	<?= form_open('blog/add-new-entry');?>

	<?php if(validation_errors()){echo validation_errors('<p class="error">','</div>');} ?>
	<?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</div>';}?>

	<div class="input-field">
		<label>Title</label>
		<input type="text" name="entry_name"  style="display:block;width:100%"/>
	</div>


	<p>
		<label>Label</label><br>
		<?php if( isset($categories) && $categories): foreach($categories as $category): ?>
			<input class="checkbox" type="checkbox" name="entry_category[]" value="<?= $category->category_id;?>" id="cat-<?= $category->category_id;?>">
			<label for="cat-<?= $category->category_id;?>" style="margin-right:1em"><?= $category->category_name;?></label>
			<br>
		<?php endforeach; 
	else:
		?>
		Please add your category first!
	<?php endif; ?>
</p>


	<p>
	<label>Status</label><br>

	<?php if( isset($statuses) && $statuses): foreach($statuses as $status): ?>
		<input name="status" type="radio" id="status-<?= $status->id;?>" value="<?= $status->id;?>"/>
		<label for="status-<?= $status->id;?>" style="margin-right:1em"><?= $status->name;?></label>
	<?php endforeach;endif; ?>
	</p>

	<div class="input-field">
		<label>Image</label>
		<input type="text" name="entry_image" style="display:block;width:100%" />
	</div>

	<div class="input-field">
		<label>Video</label>
		<input type="text" name="entry_video"  style="display:block;width:100%" />
	</div>

		<p>
			<label>Content (English)</label>
			<textarea rows="16" cols="80%" name="entry_body" id="textarea"></textarea>
		</p>

		<p>
			<label>Content (Indonesian)</label>
			<textarea rows="16" cols="80%" name="entry_body_id" id="textarea"></textarea>
		</p>

	<div class="switch">
		<label>
			<input type="checkbox" name="tweet" value="1"  />
			<span class="lever"></span>
			Tweet?
		</label>
	</div>

	<input class="waves-effect waves-light btn" type="submit" value="Submit"/>
	<input class="waves-effect waves-light btn" type="reset" value="Reset"/>	

<?= form_close() ?>

<?php endif;?>

</div>
</div>
<script>
	CKEDITOR.replace( 'entry_body' );
	CKEDITOR.replace( 'entry_body_id' );
</script>
