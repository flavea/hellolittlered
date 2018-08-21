
<script src="http://static.tumblr.com/twte3d7/H8Glm663z/masonry.js"></script>
<script type="text/javascript">
$(window).load(function () {
	$('#resource').masonry({
		itemSelector : ".mini-resource",
	},
	function() { $('#resource').masonry({ appendedContent: $(this) }); }
	);
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
		<b>Resource Categories:</b>
		<a style="display:none" class="catTemp"></a>
	</div>
	<article class="mini-theme resourceTemp" style="display: none">
		<img />
		<h5></h5>
		<div class="theme-links">
			<a class="download">download</a>
		</div>
	</article>
	<div id="resource-loader" class="lds-css ng-scope">
		<div style="width:100%;height:100%" class="lds-disk">
			<div>
				<div></div>
				<div></div>
			</div>
		</div>
	</div>
	<div id="loadresources">

	</div>
</div>

<script src="<?= base_url('application/views/resource/index.js') ?>"></script>