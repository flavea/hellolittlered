<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="post">
	<div class="input-field">
		<label>Theme Name</label>
		<input type="text" id="theme_name" required />
	</div>

	<p>
		<label>Label</label>
		<div id="labels">
		</div>
		<div class="labTemp" style="display: none">
			<input class="checkbox" type="checkbox" name="entry_category[]">
			<label class="label" style="margin-right:1em"></label>
		</div>
	</p>

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
		<label>Image Preview</label>
		<input type="url" id="theme_image" required />
	</div>

	<div class="input-field">
		<label>Preview Code</label>
		<textarea id="theme_preview"></textarea></div>

	<div class="input-field">
		<label>Code Link</label>
		<input type="url" id="theme_code" />
	</div>

	<label>Descriptions/Features (English)</label>
	<textarea name="theme_body" id="theme_body"></textarea>

	<label>Descriptions/Features (Indonesian)</label>
	<textarea name="theme_body_id" id="theme_body_id"></textarea>

	<div class="switch">
		<label>
			<input type="checkbox" id="tweet" value="1" />
			<span class="lever"></span>
			Tweet?
		</label>
	</div>

	<input class="button button-inverse" type="submit" value="Submit" id="btnSubmit"/>
	<input class="button button-inverse" type="reset" value="Reset" id="btnReset"/>

</div>