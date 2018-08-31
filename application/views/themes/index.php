<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript">
$LAB.script("http://static.tumblr.com/twte3d7/H8Glm663z/masonry.js").wait().script("<?= base_url('application/views/'.$file.'.js') ?>").wait(function(){
	$(window).load(function () {
		$('#theme').masonry({
			itemSelector : ".mini-theme",
		},
		function() { $('#theme').masonry({ appendedContent: $(this) }); }
		);
	});
  });
</script>
<div class="content-real">
	<div class="post featured">
		<div class="title">
			<h2>
				<span id="tou-title"></span>
			</h2>
		</div>

		<div id="tou"></div>

	</div>
	<div id="theme-categories" class="featured">
		<b>Themes Categories:</b>
		<a style="display:none" class="catTemp"></a>
	</div>
	<article class="mini-theme themeTemp" style="display: none">
		<a class="image">
			<img />
		</a>

		<h5>
			<a></a>
		</h5>
		<div class="theme-links">
			<a class="preview">preview</a>
			<a class="code">code</a>
		</div>
	</article>
	<div id="theme-loader" class="lds-css ng-scope">
		<div style="width:100%;height:100%" class="lds-disk">
			<div>
				<div></div>
				<div></div>
			</div>
		</div>
	</div>
	<div id="loadThemes">

	</div>
</div>