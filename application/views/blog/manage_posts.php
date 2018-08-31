<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<table style="display: none">
	<tr class="tableTemp">
		<td class="id"></td>
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
			<th width="10%">ID</th>
			<th width="75%">Name</th>
			<th width="15%">Action</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>


<ul class="actions pagination">
</ul>