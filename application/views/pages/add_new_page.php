<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>

<div class="card-panel white">

	<?php if( $query != ''): foreach($query as $post): ?>
		<h2 style="margin: .2em 0 1em 0" class="teal-text text-lighten-2">Edit Page</h2>
		<?= form_open('pages/update_page');?>

		<input type="hidden" name="page_id" value="<?= $post->page_id ?>"/>

		<div class="input-field">
			<label>Title</label>
			<input type="text" name="page_name" value="<?= $post->page_title ?>" required/>
		</div>
		<p>
			<label>Status</label><br>

			<?php if( isset($statuses) && $statuses): foreach($statuses as $status): ?>
				<input name="status" type="radio" id="status-<?= $status->id;?>" value="<?= $status->id;?>" <?php if($post->status == $status->id) echo 'checked';?>/>
				<label for="status-<?= $status->id;?>" style="margin-right:1em"><?= $status->name;?></label>
			<?php endforeach;endif; ?>
		</p>

		<div class="input-field">
			<label>Slug</label>
			<input type="text" name="page_slug"  value="<?= $post->slug ?>" required/>
		</div>

		<p>
			<label>Content (English)</label>
			<textarea rows="16" cols="80%" name="page_body" style="resize:none;" id="textarea"><?= $post->page_body ?></textarea>
		</p>

		<p>
			<label>Content (Indonesian)</label>
			<textarea rows="16" cols="80%" name="page_body_id" style="resize:none;" id="textarea"><?= $post->page_body_id ?></textarea>
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

	</form>
<?php endforeach; else: ?>
	<h2 style="margin: .2em 0 1em 0" class="teal-text text-lighten-2">Add New Page</h2>
	<?= form_open('pages/add-new-page');?>

	<div class="input-field"><label>Title</label>
		<input type="text" name="page_name" required />
	</div>
	<p>
		<label>Status</label><br>

		<?php if( isset($statuses) && $statuses): foreach($statuses as $status): ?>
			<input name="status" type="radio" id="status-<?= $status->id;?>" value="<?= $status->id;?>" />
			<label for="status-<?= $status->id;?>" style="margin-right:1em"><?= $status->name;?></label>
		<?php endforeach;endif; ?>
	</p>

	<div class="input-field">
		<label>Slug</label>
		<input type="text" name="page_slug" required="" />
	</div>

	<p>
		<label>Content (English)</label>
		<textarea rows="16" cols="80%" name="page_body" style="resize:none;" id="textarea"></textarea>
	</p>

	<p>
		<label>Content (Indonesian)</label>
		<textarea rows="16" cols="80%" name="page_body_id" style="resize:none;" id="textarea"></textarea>
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

</form>
<?php endif;?>

</div>
</div>
<script>
	CKEDITOR.replace( 'page_body' );
	CKEDITOR.replace( 'page_body_id' );
</script>
