<script type="text/javascript" src="http://static.tumblr.com/d0qlne1/DiAl6ekb7/jquery-1.4.2.min.js"></script>
<script src="http://static.tumblr.com/twte3d7/H8Glm663z/masonry.js"></script>
<script type="text/javascript">
$(window).load(function () {
$('#theme').masonry({
itemSelector : ".mini-theme",
},
function() { $('#theme').masonry({ appendedContent: $(this) }); }
);
});
</script>
	<div id="theme">
	<?php if( $posts ): foreach($posts as $post): ?>
			<article class="mini-theme">
				<header>
					<h3><?php echo $post->name ?></h3>
					<div class="theme-links">
						<a href="<?php echo $post->redbubble ?>">redbubble</a>
						<a href="<?php echo $post->tees ?>">tees</a>
					</div>
				</header>
				
				<img src="<?php echo $post->image ?>" alt="" width="100%"/>

			</article>
				
			<?php endforeach; else: ?>
			<h2>No post yet!</h2>
			
			<?php endif;?>
					</div>
							<ul class="actions pagination">
								<?php echo $paginglinks; ?>
							</ul>
					</div>
