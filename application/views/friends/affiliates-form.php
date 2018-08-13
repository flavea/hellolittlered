	<div id="bg" class="content-real">
		<div id="blog">
			<article class="post featured">
				<header>
					<div class="title">
						<h2><span>Rules</span></h2>
					</div>
				</header>
				<ul>
					<li>Your website shoud not have any offensive content.</li>
					<li>Your website must be updated at least once every 6 months.</li>
					<li>Your website must be in English or Indonesian.</li>
					<li>You have to put Hello Little Red in your affiliates list.</li>
				</ul>

				<br><br>

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
							<td width="100px" style="text-align: center;"><img src="http://i.imgur.com/QkFLRO8.jpg"></td>
							<td width="100px" style="text-align: center;">88 x 31</td>
							<td>
								<pre>&lt;a href="http://hellolittlered.org" title="Hello Little Red" target="_blank">&lt;img src="http://i.imgur.com/QkFLRO8.jpg" alt="Hello Little Red">&lt;/a></pre>
							</td>
						</tr>
						<tr>
							<td width="100px" style="text-align: center;"><img src="http://i.imgur.com/z09lngU.jpg"></td>
							<td width="100px" style="text-align: center;">100 x 50</td>
							<td>
								<pre>&lt;a href="http://hellolittlered.org" title="Hello Little Red" target="_blank">&lt;img src="http://i.imgur.com/z09lngU.jpg" alt="Hello Little Red">&lt;/a></pre>
							</td>
						</tr>
						<tr>
							<td width="100px" style="text-align: center;"><img src="http://i.imgur.com/JgvprNK.png"></td>
							<td width="100px" style="text-align: center;">100 x 100</td>
							<td>
								<pre>&lt;a href="http://hellolittlered.org" title="Hello Little Red" target="_blank">&lt;img src="http://i.imgur.com/JgvprNK.png" alt="Hello Little Red">&lt;/a></pre>
							</td>
						</tr>
					</tbody>
				</table>

				<br><br>
				<header>
					<div class="title">
						<h2><span>Apply</span></h2>
					</div>
				</header>

				<?= form_open('friends/apply');?>

				<?php if(validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
				<?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>

				<div class="input-field">
					<label>Name</label>
					<input type="text" name="name" placeholder="Your Website Name" required>
				</div>

				<div class="input-field">
					<label>Website</label>
					<input type="url" name="website" placeholder="Your Website Link" required>
				</div>

				<div class="input-field">
					<label>Description</label>
					<input type="text" name="description"  placeholder="A description of your website. Not required!"/>
				</div>
				
				<p>
					<input class="button" type="submit" value="Submit"/>
					<input class="button" type="reset" value="Reset"/>
				</p>	

			</form>
		</article>
	</div>
	<?php $this->load->view('blog/sidebar');?>
</div>
</div>