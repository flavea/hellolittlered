<div class="post">

	<div class="input-field">
		<label>Name</label>
		<input type="text" id="name" required />
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
		<label>Content</label>
		<textarea rows="8" cols="100%" name="content" id="textarea"></textarea>
	</div>

	<input class="button button-inverse" type="submit" value="Submit" id="btnSubmit" />
	<input class="button button-inverse" type="reset" value="Reset" id="btnReset" />

	</form>
</div>

<table style="display: none">
	<tr class="tableTemp">
		<td class="name"></td>
		<td class="action">
			<center>
				<button class="button button-inverse fa fa-edit"></button>
				<button class="button button-inverse fa fa-trash"></button>
			</center>
		</td>
	</tr>
</table>

<div id="load" class="lds-css ng-scope">
	<div style="width:100%;height:100%" class="lds-disk">
		<div>
			<div></div>
			<div></div>
		</div>
	</div>
</div>

<table id="table"=class="stripe">
	<thead>
		<tr>
			<th>Sidebar Name</th>
			<th width="20%">Action</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>