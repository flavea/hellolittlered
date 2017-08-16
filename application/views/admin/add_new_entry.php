<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>

<div class="card-panel white">

	<?php if( $query != ''): foreach($query as $post): ?>
		<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Edit Page</h2>
		<?php echo form_open('admin/update_page');?>

		<input type="hidden" name="page_id" value="<?php echo $post->page_id ?>"/>

		<div class="input-field">
			<label>Title</label>
			<input type="text" name="page_name" value="<?php echo $post->page_title ?>" required/>
		</div>
		<p>
			<label>Status</label><br>

			<?php if( isset($statuses) && $statuses): foreach($statuses as $status): ?>
				<input name="status" type="radio" id="status-<?php echo $status->id;?>" value="<?php echo $status->id;?>" <?php if($post->status == $status->id) echo 'checked';?>/>
				<label for="status-<?php echo $status->id;?>" style="margin-right:1em"><?php echo $status->name;?></label>
			<?php endforeach;endif; ?>
		</p>

		<div class="input-field">
			<label>Slug</label>
			<input type="text" name="page_slug"  value="<?php echo $post->slug ?>" required/>
		</div>

		<p>
			<label>Content</label>
			<textarea rows="16" cols="80%" name="page_body" style="resize:none;" id="textarea"><?php echo $post->page_body ?></textarea>
		</p>

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
<?php endforeach; else: ?>
	<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Add New Page</h2>
	<?php echo form_open('admin/add-new-page');?>

	<div class="input-field"><label>Title</label>
		<input type="text" name="page_name" required />
	</div>
	<p>
		<label>Status</label><br>

		<?php if( isset($statuses) && $statuses): foreach($statuses as $status): ?>
			<input name="status" type="radio" id="status-<?php echo $status->id;?>" value="<?php echo $status->id;?>" />
			<label for="status-<?php echo $status->id;?>" style="margin-right:1em"><?php echo $status->name;?></label>
		<?php endforeach;endif; ?>
	</p>

	<div class="input-field">
		<label>Slug</label>
		<input type="text" name="page_slug" required="" />
	</div>

	<p>
		<label>Content</label>
		<textarea rows="16" cols="80%" name="page_body" style="resize:none;" id="textarea"></textarea>
	</p>

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
</div>
<script>
	CKEDITOR.replace( 'page_body' );
</script>
