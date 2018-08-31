<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content-real">
	<div id="blog" style="float: none;margin: auto">
		<article class="post featured">
			<header>
				<div class="title">
					<h2>
						<span>Contact Through Email</span>
					</h2>
				</div>
			</header>

			<p>
				<label>Name</label>
				<input name="name" id="txtName" type="text" size="30" required />
			</p>

			<p>
				<label>Email</label>
				<input name="email" id="txtEmail" placeholder="Your Real Email" type="text" size="30" required />
			</p>

			<p>
				<label>Subject</label>
				<input name="subject" id="txtSubject" placeholder="Subject" type="text" size="30" required/>
			</p>

			<p>
				<label>Your Message</label>
				<textarea rows="6" cols="80%" name="message" id="txtMessage" style="resize:none;" id="textarea" required></textarea>
			</p>

			<p>
				<label>[Fill in The Blanks] To Beyond and _______</label>
				<input name="validate" type="text" size="30" id="txtValidate" required/>
			</p>


			<input class="button" type="submit" value="Submit" id="btnSubmit" />
			<input class="button" type="reset" value="Reset" id="btnReset" />

		</article>
	</div>
</div>
