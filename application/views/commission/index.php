<div id="bg" class="content-real">
	<div id="blog" style="float: none;margin: auto">
		<article class="post featured">
			<header>
				<div class="title">
					<h2>
						<span>Commission</span>
					</h2>
				</div>
			</header>

			<div id="comm"></div>

			<p>
				<label>Your Name</label>
				<input type="text" name="name" id="txtName" style="display:block;width:100%" required />
			</p>

			<p>
				<label>Your Email</label>
				<input type="text" name="email" id="txtEmail" style="display:block;width:100%" / required>
			</p>

			<label>What you want</label>
			<div id="list">
				<div class="chkTemp" style="display: none">
					<input type="checkbox" name="category[]" value="" class="chk">
					<span class="category"></span> (Base Price: USD
					<span class="base_price"></span>
					<br>
					<small></small>
				</div>
			</div>

			<p>
				<label>Link to design/sketch if there is any</label>
				<input type="text" name="sketch" id="txtSketch" style="display:block;width:100%" />
			</p>

			<p>
				<label>The blog/site you want to use it for</label>
				<input type="text" name="site" id="txtWWW" style="display:block;width:100%" />
			</p>

			<p>
				<label>Your message</label>
				<textarea rows="6" cols="80%" name="message"  id="txtMessage" style="resize:none;" id="textarea"></textarea>
			</p>

			<p>
				<label>[Fill in The Blanks] Bond. James ____</label>
				<input name="validate" type="text" size="30" id="txtValidation" required/>
			</p>

			<input class="button" type="submit" value="Submit" id="btnSubmit"/>
			<input class="button" type="reset" value="Reset"  id="btnReset"/>

		</article>
	</div>
</div>

<script src="<?= base_url('application/views/commission/index.js') ?>"></script>