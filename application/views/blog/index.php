<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
#info {
	margin: 9%;
}
</style>

<div id="content">

	<article class="post postTemp" style="display: none">
		<div id="img"></div>
		<div class="caption">
			<div class="title">
				<h2>
					<a></a>
				</h2>
			</div>
			<div class="meta"></div>

			<div class="entry_body"></div>
			<p>
				<a class="button">Read More</a>
			</p>
		</div>
	</article>
	<div id="blog">
		<div id="posts-loader" class="lds-css ng-scope">
			<div style="width:100%;height:100%" class="lds-disk">
				<div>
					<div></div>
					<div></div>
				</div>
			</div>
		</div>

		<div id="entries"></div>
	</div>
	<?php $this->load->view('blog/sidebar');?>
</div>

<ul class="actions pagination">
</ul>
