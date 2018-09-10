<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<div class="post">

	<div class="input-field">
		<label>Title</label>
		<input type="text" id="entry_name"/>
	</div>

	<div class="input-field">
		<label>Title (Indonesian)</label>
		<input type="text" id="entry_name_id"/>
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
		<label>Image</label>
		<input type="text" id="entry_image" />
	</div>

	<div class="input-field">
		<label>Video</label>
		<input type="text" id="entry_video" />
	</div>

	<p>
		<label>Content (English)</label>
		<textarea name="entry_body" id="entry_body"></textarea>
	</p>

	<p>
		<label>Content (Indonesian)</label>
		<textarea name="entry_body_id" id="entry_body_id"></textarea>
	</p>

	<div class="input-field">
		<label>Tags</label>
		<input type="text" id="entry_tags" />
	</div>

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

