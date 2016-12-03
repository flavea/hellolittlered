<article class="post">
			<header>
				<div class="title">
					<h2>Commission</h2>
				</div>
			</header>

			<p><strong>Rules<em>!</em></strong></p>
			<ul>
			<li>You will get a customized theme, I won’t publish the theme anywhere.</li>
			<li>Payment via paypal for countries other than Indonesia, payment can be via BCA if you are from Indonesia.</li>
			<li>Do not claim the theme as your own. If you do, I will ask you to take down the theme and I won’t refund you the payment.</li>
			<li>You have to give me a rough sketch/mock up of the theme you wanted, also please explain in details on how you want your theme to look.</li>
			<li>I won&#8217;t accept all offers, I will accept the offers that I know I can handle and within my skills.</li>
			</ul>
			<p><strong>Procedure<em>!</em></strong></p>
			<ul>
			<li>Fill the form below and after you submit it, you will receive an email from me.</li>
			<li>If your form is accepted, we will have a discussion about the theme and the price.</li>
			<li>After we reach an agreement, you have to pay first.</li>
			<li>After I receive the payment, I will send you a confirmation email and start to code the theme.</li>
			<li>The theme will be finished between 3-8 days, depends on how busy I am at that time.</li>
			<li>After the theme finished, I will send you the code through email.</li>
			<li>You can ask me for changes (max 10 changes) and report to me if there is an error.</li>
			</ul>
			
			<?php echo form_open('commission');?> 
			<?php if(validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
            <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
	
			<p><label>Your Name</label>
			<input type="text" name="name"  style="display:block;width:100%"/></p>

			<p><label>Your Email</label>
			<input type="text" name="email"  style="display:block;width:100%"/></p>
			
			<label>What you want</label>
				<?php if( isset($categories) && $categories): foreach($categories as $category): ?>
					<input type="checkbox" name="category[]" value="<?php echo $category->category_id;?>">
					<?php echo $category->category_name;?> (Base Price: USD <?php echo $category->base_price;?>)<br>
					<?php 
					if($category->description!=NULL) {
						echo $category->description.'<br>';
					}
					?>
				<?php endforeach; else:?>
				Please add your category first!
				<?php endif; ?>

			<p><label>Link to design/sketch if there is any</label>
			<input type="text" name="sketch" style="display:block;width:100%" /></p>

			<p><label>The blog/site you want to use it for</label>
			<input type="text" name="site"  style="display:block;width:100%" /></p>

			<p><label>Your message</label>
			<textarea rows="6" cols="80%" name="message" style="resize:none;" id="textarea"></textarea></p>
			
			
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			</form>	
				
			</article>
			

			
			
		</div>
	<!-- footer starts here -->	
	<?php $this->load->view('blog/sidebar');?>
	<!-- footer ends here -->
