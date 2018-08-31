<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="post">

	<div class="input-field">
		<label>English</label>
		<input type="text" id="menu_en" required />
	</div>

<div class="input-field">
    <label>Indonesian</label>
    <input type="text" id="menu_id" required />
</div>

<div class="input-field">
    <label>Link</label>
    <input type="text" id="link" required />
</div>

<div class="input-field">
    <label>Priority</label>
    <input type="text" id="priority" required />
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

	<div class="switch">
		<label>
			<input type="checkbox" class="admin" value="1" />
			<span class="lever"></span>
			Admin
		</label>
	</div>

	<input class="button button-inverse" type="submit" value="Submit" id="btnSubmit" />
	<input class="button button-inverse" type="reset" value="Reset" id="btnReset" />

	</form>
</div>

<table style="display: none">
	<tr class="tableTemp">
		<td class="pr"></td>
		<td class="name"></td>
		<td class="link"></td>
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
			<th width="20%">Priority</th>
			<th>Name</th>
			<th>Link</th>
			<th width="20%">Action</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>