
	<div id="theme" class="content-real">
	<?php if( $posts ): foreach($posts as $post): ?>
			<article class="mini-theme">
				<img src="<?= $post->image ?>" alt="" width="100%"/>

					<h3><?= $post->name ?></h3>
					<div class="theme-links">
						<a href="<?= $post->redbubble ?>">redbubble</a>
						<a href="<?= $post->tees ?>">tees</a>
					</div>

			</article>
				
			<?php endforeach; else: ?>
			<h2>No post yet!</h2>
			
			<?php endif;?>
					</div>
							<ul class="actions pagination">
								<?= $paginglinks; ?>
							</ul>
					</div>
