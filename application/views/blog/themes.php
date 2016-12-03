
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
	<section class="post">
		<header>
			<div class="title"><h2>Term of Use</h2></div>
		</header>

        <ol>
                <li>Do not remove the credit completely or make them invisible, you may replace it to a visible place.</li>
                <li>Do not steal the code or take parts of the codes and put them in your own theme, do not use them as base code too.</li>
                <li>Do not redistribute my themes unless you have my permission, please just redirect people to this page OR reblog my tumblr posts about the themes.</li>
                <li>Altering the code is allowed but keep the credit intact.</li>
                <li><em><strong>You may remove the credit only for base codes.</strong></em></li>
                </ol>

	</section>
	<div id="theme">
	<?php if( $posts ): foreach($posts as $post): ?>
			<article class="mini-theme">
				<header>
					<h3><a href="<?=base_url();?>theme/<?php echo $post->theme_id ?>"><?php echo $post->theme_name ?></a></h3>
					<div class="theme-links">
						<a href="<?=base_url();?>theme/<?php echo $post->theme_id ?>/preview">preview</a>
						<a href="<?php echo $post->theme_code ?>">code</a>
					</div>
				</header>
				
				<a href="<?=base_url();?>theme/<?php echo $post->theme_id ?>" class="image"><img src="<?php echo $post->theme_image ?>" alt="" /></a>

			</article>
				
			<?php endforeach; else: ?>
			<h2>No post yet!</h2>
			
			<?php endif;?>
					</div>
							<ul class="actions pagination">
								<?php echo $paginglinks; ?>
							</ul>

					</div>
