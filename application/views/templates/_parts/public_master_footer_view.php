</div>

<div id="theme-changer">
	<div class="flipswitch" style="margin-bottom: 60px">
		<input type="checkbox" name="flipswitch" class="flipswitch-cb" id="fs">
		<label class="flipswitch-label" for="fs">
			<div class="flipswitch-inner"></div>
			<div class="flipswitch-switch"></div>
		</label>
	</div>

	<div id="lang-changer">
		<div class="flipswitch">
			<input type="checkbox" name="flipswitch" class="flipswitch-cb" id="fs2">
			<label class="flipswitch-label" for="fs2">
				<div class="flipswitch-inner"></div>
				<div class="flipswitch-switch"></div>
			</label>
		</div>
	</div>
</div>

<div class="popup" id="searchres">
	<div id="popup">
		<div id="popup-content">
			<a class="fa close fa-times" aria-hidden="true" data-target="searchres"></a>
			<h2></h2>

			<div id="search-loader" class="lds-css ng-scope">
				<div style="width:100%;height:100%" class="lds-disk">
					<div>
						<div></div>
						<div></div>
					</div>
				</div>
			</div>

			<div class="searchTemp" style="display: none">
				<b></b>
				<p>
					<ul></ul>
				</p>
			</div>

			<div id="search-result"></div>
		</div>
	</div>
</div>

<div class="popup" id="alert">
	<div id="popup">
		<div id="popup-content">
			<center>
				<h2></h2>
				<p></p>
				<a data-target="alert" class="button button-inverse">Okay</a>
			</center>
		</div>
	</div>
</div>

<div id="foot">
	<div id="friends" class="foot-container">
		<b>Affiliates</b>

	</div>
	<div class="foot-container pages">
		<b>Pages</b>
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
					<a href="" class="fa fa-codepen"></a>
					<a href="" class="fa fa-deviantart"></a>
					<a href="" class="fa fa-facebook"></a>
					<a href="" class="fa fa-flickr"></a>
					<a href="" class="fa fa-instagram"></a>
					<a href="" class="fa fa-linkedin"></a>
					<a href="" class="fa fa-soundcloud"></a>
					<a href="" class="fa fa-tumblr"></a>
					<a href="" class="fa fa-twitter"></a>
					<a href="" class="fa fa-youtube"></a>
					<a href="" class="fa fa-behance"></a>
					<a href="" class="fa fa-github"></a>
				</small>
			</div>
		</p>
	</div>
	<div class="foot-container">
		<b>Search</b>
		<form id="search" method="get">
			<input type="text" name="query" placeholder="Search" id="searchVal" />
			<input type="submit" id="btnSearch" class="button fa-search button-inverse">
		</form>
		<p>Input a keyword to search this website.</p>
	</div>
</div>
<footer>

	<center>
		© hellolittlered 2013-
		<?= date("Y"); ?>
	</center>
	</div>
</footer>
</main>

</body>
</html>