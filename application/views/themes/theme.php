<div id="bg" class="content-real">
	<div id="blog" style="float: none;margin: auto">
		<article class="post featured">
			<header>
				<div class="title">
					<h2>
						<span></span>
					</h2>
				</div>
				<div class="meta">
				</div>
			</header>
			<center>
				<p>
					<img class="image">
				</p>
			</center>
			<center>
				<div class="theme-links">
					<a class="preview">Preview</a>
					<a class="code">Code</a>
				</div>
				<br>
				<br>
			</center>
			<div id="theme_body"></div>

			<p class="types"><b>Type: </b></p>

		</article>

		<article class="post featured">
			<div id="disqus_thread"></div>
			<script>
				var disqus_config = function () {
					let url = window.location.href;
					let slug = url.split("/").pop();
					var disqus_config = function () {
						this.page.url = window.location.href;
						this.page.identifier = 'theme' + slug;
					};
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


<script src="<?= base_url('application/views/themes/theme.js') ?>"></script>