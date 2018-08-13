<div id="bg" class="content-real">
	<div id="blog">
			
			<?php if( $query ): foreach($query as $post): ?>

			<article class="post featured">
			<header>
				<div class="title">
					<h2><span><?= ucwords($post->page_title);?></span></h2>
				</div>
			</header>
            <?= $post->page_body;
?>
			
							</article>
			<?php endforeach; ?>
			<?php endif;?>
			
		</div>
		

	<!-- footer starts here -->	
	<?php $this->load->view('blog/sidebar');?>
</div>