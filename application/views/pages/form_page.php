<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>

<div class="post">
	<div class="input-field">
	<label>Title</label>
		<input type="text" id="page_name" required />
	</div>

	<div class="input-field">
	<label>Title (Indonesian)</label>
		<input type="text" id="page_name_id" required />
	</div>

	<p>
		<label>Status</label>
		<div id="statuses">
		</div>
		<div class="statTemp" style="display: none">
			<input name="status" type="radio" class="status" />
			<label style="margin-right:1em" class="label"></label>
		</div>
	</p>

	<div class="input-field">
		<label>Slug</label>
		<input type="text" id="page_slug" required="" />
	</div>

	<p>
		<label>Content (English)</label>
		<textarea name="page_body" id="page_body"></textarea>
	</p>

	<p>
		<label>Content (Indonesian)</label>
		<textarea name="page_body_id" id="page_body_id"></textarea>
	</p>

	<div class="switch">
		<label>
			<input type="checkbox" id="tweet" value="1" />
			<span class="lever"></span>
			Tweet?
		</label>
	</div>

	<input class="button button-inverse" type="submit" value="Submit" id="btnSubmit"/>
	<input class="button button-inverse" type="reset" value="Reset" id="btnReset" />

</div>