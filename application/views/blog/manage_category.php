<div class="post">
	<div class="input-field">
		<label>Category Name</label>
		<input type="text" name="category_name" id="txtName" required />
	</div>

	<div class="input-field">
		<label>Slug</label>
		<input type="text" name="category_slug" id="txtSlug" required />
	</div>

	<input class="button button-inverse" type="submit" value="Add" id="btnSubmit" />
	<input class="button button-inverse" type="reset" value="Reset" id="btnReset" />

	</form>

</div>

<table style="display: none">
	<tr class="tableTemp">
		<td class="id"></td>
		<td class="name"></td>
		<td class="slug"></td>
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
			<th>ID</th>
			<th>Name</th>
			<th>Slug</th>
			<th width="20%">Action</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>