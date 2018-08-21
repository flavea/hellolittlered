<div id="bg" class="content-real">
	<div id="blog" style="float: none;margin: auto">
		<article class="post featured">
			<header>
				<div class="title">
					<h2>
						<span>Rules</span>
					</h2>
				</div>
			</header>
			<div id="rules">
			</div>

			<br>
			<header>
				<div class="title">
					<h2>Banners</h2>
				</div>
			</header>

			<p>If you need some banners</p>
			<br>
			<table width="100%">
				<thead>
					<tr>
						<th>Image</th>
						<th>Size</th>
						<th>Code</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td width="100px" style="text-align: center;">
							<img src="http://i.imgur.com/QkFLRO8.jpg">
						</td>
						<td width="100px" style="text-align: center;">88 x 31</td>
						<td>
							<pre>&lt;a href="http://hellolittlered.org" title="Hello Little Red" target="_blank">&lt;img src="http://i.imgur.com/QkFLRO8.jpg" alt="Hello Little Red">&lt;/a></pre>
						</td>
					</tr>
					<tr>
						<td width="100px" style="text-align: center;">
							<img src="http://i.imgur.com/z09lngU.jpg">
						</td>
						<td width="100px" style="text-align: center;">100 x 50</td>
						<td>
							<pre>&lt;a href="http://hellolittlered.org" title="Hello Little Red" target="_blank">&lt;img src="http://i.imgur.com/z09lngU.jpg" alt="Hello Little Red">&lt;/a></pre>
						</td>
					</tr>
					<tr>
						<td width="100px" style="text-align: center;">
							<img src="http://i.imgur.com/JgvprNK.png">
						</td>
						<td width="100px" style="text-align: center;">100 x 100</td>
						<td>
							<pre>&lt;a href="http://hellolittlered.org" title="Hello Little Red" target="_blank">&lt;img src="http://i.imgur.com/JgvprNK.png" alt="Hello Little Red">&lt;/a></pre>
						</td>
					</tr>
				</tbody>
			</table>

			<br>
			<br>
			<header>
				<div class="title">
					<h2>
						<span>Apply</span>
					</h2>
				</div>
			</header>

			<div class="input-field">
				<label>Name</label>
				<input type="text" name="name" id="txtName" placeholder="Your Website Name" required>
			</div>

			<div class="input-field">
				<label>Website</label>
				<input type="url" name="website" id="txtWebsite" placeholder="Your Website Link" required>
			</div>

			<div class="input-field">
				<label>Description</label>
				<input type="text" name="description" id="txtDescription" placeholder="A description of your website. Not required!" />
			</div>

			<p>
				<input class="button" type="submit" value="Submit" id="btnSubmit" />
				<input class="button" type="reset" value="Reset" id="btnReset" />
			</p>

		</article>
	</div>
</div>

<script src="<?= base_url('application/views/friends/affiliates-form.js') ?>"></script>