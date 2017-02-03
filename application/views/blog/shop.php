
	<div id="theme" class="content-real">
	<?php if( $posts ): foreach($posts as $post): ?>
			<article class="mini-theme">
				<img src="<?php echo $post->image ?>" alt="" width="100%"/>

					<h3><?php echo $post->name ?></h3>
					<div class="theme-links">
						<a href="<?php echo $post->redbubble ?>">redbubble</a>
						<a href="<?php echo $post->tees ?>">tees</a>
					</div>

			</article>
				
			<?php endforeach; else: ?>
			<h2>No post yet!</h2>
			
			<?php endif;?>
					</div>
							<ul class="actions pagination">
								<?php echo $paginglinks; ?>
							</ul>
					</div>
