<div class="post">
	<div class="input-field">
		<label>Design Name</label>
		<input type="text" id="name">
	</div>

	<div class="input-field">
		<label>Image</label>
		<input type="text" id="timage" />
	</div>

	<div class="input-field">
		<label>Redbubble</label>
		<input type="text" id="redbubble" />
	</div>

	<div class="input-field">
		<label>Tees</label>
		<input type="text" id="tees" />
	</div>

	<label>Status</label>
	<div id="statuses">
	</div>
	<div class="statTemp" style="display: none">
		<input name="status" type="radio" class="status" />
		<label style="margin-right:1em" class="label"></label>
	</div>

	<div class="switch">
		<label>
			<input type="checkbox" id="tweet" value="1" />
			<span class="lever"></span>
			Tweet?
		</label>
	</div>

	<p>
		<input class="button button-inverse" type="submit" value="Submit" id="btnSubmit" />
		<input class="button button-inverse" type="reset" value="Reset" id="btnReset" />
	</p>

</div>

<table style="display: none">
	<tr class="tableTemp">
		<td class="image"><img width="150"></td>
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

<table id="table" class="stripe">
	<thead>
		<tr>
			<th>Image</th>
			<th>Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>