<div id="foot">
	<div class="foot-container">
		<b>Affiliates</b>
		<?php if($friends): foreach ($friends as $f): ?>
			<a href="<?= $f->website; ?>" target="_blank"><?= $f->name; ?></a>
		<?php endforeach; endif; ?>
		<a href="<?= base_url() ?>friends">All Affiliates</a>
		<a href="<?= base_url() ?>friends/apply">Apply?</a>
	</div>
	<div class="foot-container">
		<b>Pages</b>
		<?php if($pagess): foreach ($pagess as $f): ?>
			<a href="<?= base_url() ?>p/<?= $f->slug; ?>" target="_blank"><?= $f->page_title; ?></a>
		<?php endforeach; endif; ?>
	</div>
	<div class="foot-container">
		<b>Contact Me</b>
		<a href="<?= base_url() ?>contact">Email</a>
		<a href="<?= base_url() ?>contact/q">Quick Questions</a>
		<a href="<?= base_url() ?>commission">Hire Me?</a>
		<p>
			<br>
			<div class="icons">
				<small>
					<a href="http://vorfreudes.deviantart.com" class="fa fa-deviantart"></a>
					<a href="https://www.facebook.com/hellolittlered/?ref=bookmarks" class="fa fa-facebook"></a>
					<a href="https://www.flickr.com/photos/113411780@N03/" class="fa fa-flickr"></a>
					<a href="http://instagram.com/leurexquise" class="fa fa-instagram"></a>
					<a href="https://id.linkedin.com/in/ilma-arifiany-527a5981" class="fa fa-linkedin"></a>
					<a href="http://41days.org" class="fa fa-tumblr"></a>
					<a href="http://twitter.com/_hellolittlered" class="fa fa-twitter"></a>
					<a href="https://www.behance.net/iarifiany" class="fa fa-behance"></a>
					<a href="https://github.com/flavea" class="fa fa-github"></a>
				</small>
			</div>
		</p>
	</div>
	<div class="foot-container">
		<b>Search</b>
		<form id="search" method="get" action="<?= base_url().'search/' ?>">
			<input type="text" name="query" placeholder="Search" />
			<input type="submit" class="button fa-search">
		</form>
		<p>Input a keyword to search this website.</p>
	</div>
</div>
<footer>
	
	<center>
		© hellolittlered 2013-<?= date("Y"); ?>
	</center>
</div>
</footer>
</main>

<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js?skin=sunburst"></script>
</body>
</html>