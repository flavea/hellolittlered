<div class="post">

	<div class="input-field">
		<label>Name</label>
		<input type="text" id="resource_name" />
	</div>

	
	<p>
		<label>Type</label>
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
		<label>Preview</label>
		<input type="text" id="resource_preview" />
	</div>

	<div class="input-field">
		<label>Download</label>
		<input type="text" id="resource_download" />
	</div>

	<input class="button button-inverse" type="submit" value="Submit" id="btnSubmit"/>
	<input class="button button-inverse" type="reset" value="Reset" id="btnReset"/>

</div>