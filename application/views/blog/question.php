	<div id="bg" class="content-real">
		<div id="blog">
			<article class="post featured">
			<header>
				<div class="title">
					<h2>Ask A Questions</h2>
					<p>For simple and theme questions. Please note that all of the questions asked here will be published. Please check whether your questions have been answered or not.</p>
				</div>
			</header>
			
			<?php echo form_open('contact/q');?>

			<?php if(validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
            <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>		
	
			<p><label>Name</label>
			<input name="name" value="Your Name" type="text" size="30" /></p>
			
			<p><label>Your Question</label>
			<textarea rows="3" cols="80%" name="message" style="resize:none;" id="textarea"></textarea></p>
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			</form>	
				
			</article>

            <form id="search" method="get" action="<?php echo base_url().'contact/q/' ?>">
            <input type="text" style="display:inline-block;width:80%;background:#ffffff;vertical-align:top" name="query" placeholder="Search for answered questions" />
			<input type="submit" class="fa-search button" value="search"/>
            </form>
			
			<?php if( $posts ): ?>
			<?php foreach($posts as $post): ?>
				
				<article class="post featured">
				<header>
					<h4 class="title"><?php echo $post->message ?>
					</h4>
					<div class="meta">
						<time class="published"><?php echo mdate('%n %M %Y %H:%i:%s',human_to_unix($post->date));?></time>
						<span class="author">Asked by <?php echo $post->name;?></span>
					</div>
				</header>
				<p><?php echo $post->answer;?></p>
			</article>
			<?php endforeach; else: ?>
				<h2>No questions yet! Try to search <a href="http://41days.org/search/<?php echo $cari ?>">here</a> and <a href="http://41days.org/search/<?php echo $cari ?>">here</a> too!</h2>
			<?php endif;?>
			<div class="actions pagination">
								<?php echo $paginglinks; ?>
							</div>
			
		</div>
	<!-- footer starts here -->	
	<?php $this->load->view('blog/sidebar');?>
	<!-- footer ends here -->
</div>
</div>