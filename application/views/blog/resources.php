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
					<h3><?php echo $post->resource_name ?></h3>
					<div class="theme-links">
						<a href="<?php echo $post->resource_download ?>">download</a>
					</div>
				</header>
				
				<center><img src="<?php echo $post->resource_preview ?>" alt=""/></center>

			</article>
				
			<?php endforeach; else: ?>
			<h2>No resources yet!</h2>
			
			<?php endif;?>
					</div>
					</div>
