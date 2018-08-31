<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content-real">
	<div id="blog" style="float: none;margin: auto">
		<article class="post">
			<div class="caption">
				<div class="title">
					<h2></h2>
				</div>
				<div class="meta"></div>
				<center>
					<div id="img"></div>
				</center>
				<br><br>
				<div id="entry_body"></div>

				<p class="categories">
					<b>Categories: </b>
				</p>
			</div>
		</article>
		<article class="post featured onpage">
			<div id="disqus_thread"></div>
			<script>
				let url = window.location.href;
				let slug = url.split("/").pop();
				var disqus_config = function () {
					this.page.url = window.location.href;
					this.page.identifier = 'news' + slug;
				};

				(function () { // DON'T EDIT BELOW THIS LINE
					var d = document,
						s = d.createElement('script');

					s.src = '//hellolittlered.disqus.com/embed.js';

					s.setAttribute('data-timestamp', +new Date());
					(d.head || d.body).appendChild(s);
				})();
			</script>
			<noscript>Please enable JavaScript to view the
				<a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a>
			</noscript>
		</article>
	</div>
</div>
