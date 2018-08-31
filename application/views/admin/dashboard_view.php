<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script>
	(function (w, d, s, g, js, fs) {
		g = w.gapi || (w.gapi = {});
		g.analytics = {
			q: [],
			ready: function (f) {
				this.q.push(f);
			}
		};
		js = d.createElement(s);
		fs = d.getElementsByTagName(s)[0];
		js.src = 'https://apis.google.com/js/platform.js';
		fs.parentNode.insertBefore(js, fs);
		js.onload = function () {
			g.load('analytics');
		};
	}(window, document, 'script'));
</script>
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<article class="post">
	<h5 style="margin: .7em 0 1em 0" class="red-text text-darken-4">Update Site Information</h5>
	<div class="input-field">
		<label>Site Title</label>
		<input type="text" name="title" id="txttitle">
	</div>

	<div class="input-field">
		<label>Site Keywords</label>
		<textarea name="keywords" id="txtkeywords">
		</textarea>
	</div>

	<div class="input-field">
		<label>Site Description (English)</label>
		<textarea name="description" id="txtdescription">
		</textarea>
	</div>

	<div class="input-field">
		<label>Site Description (Indonesian)</label>
		<textarea name="description_id" id="txtdescription_id">
		</textarea>
	</div>

	<div class="input-field">
		<label>Term of Use (English)</label>
		<textarea name="tou" id="txttou">
		</textarea>
	</div>

	<div class="input-field">
		<label>Term of Use (Indonesian)</label>
		<textarea name="tou_id" id="txttou_id">
		</textarea>
	</div>

	<div class="input-field">
		<label>Commission Rules</label>
		<textarea name="comm" id="txtcomm">
		</textarea>
	</div>

	<div class="input-field">
		<label>Commission Rules (Indonesian)</label>
		<textarea name="comm_id" id="txtcomm_id">
		</textarea>
	</div>

	<div class="input-field">
		<label>Affiliates Rules (Indonesian)</label>
		<textarea name="aff" id="txtaff">
		</textarea>
	</div>

	<div class="input-field">
		<label>Affiliates Rules (Indonesian)</label>
		<textarea name="aff_id" id="txtaff_id">
		</textarea>
	</div>
	<br>
	<input type="submit" value="Submit" class="button button-inverse" name="Submit" id="btnSubmit"/>
	
	<div id="load" class="lds-css ng-scope">
		<div style="width:100%;height:100%" class="lds-disk">
			<div>
				<div></div>
				<div></div>
			</div>
		</div>
	</div>

	<br>
</article>

<article class="post">
	<script type="text/javascript" src="http://hellolittlered.disqus.com/combination_widget.js?num_items=3&hide_mods=0&color=white&default_tab=recent&excerpt_length=30"></script>

</article>
<article class="post">
	<div id="embed-api-auth-container"></div>
	<div id="chart-container"></div>
	<div id="view-selector-container"></div>
</article>