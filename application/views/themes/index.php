
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

<div class="content-real">
	<div class="post featured">
		<div class="title"><h2><span>Term of Use</span></h2></div>
		<ol>
			<li>Do not remove the credit completely or make them invisible, you may replace it to a visible place.</li>
			<li>Do not steal the code or take parts of the codes and put them in your own theme, do not use them as base code too.</li>
			<li>Do not redistribute my themes unless you have my permission, please just redirect people to this page OR reblog my tumblr posts about the themes.</li>
			<li>Altering the code is allowed but keep the credit intact.</li>
			<li><em><strong>You may remove the credit only for base codes.</strong></em></li>
		</ol>

	</div>
	<div id="theme-categories" class="featured">
		<b>Themes Categories:</b> 
		<?php 
			foreach ($categories as $category ) {
				if($pagetitle && $pagetitle != null && $category->slug == $pagetitle) {
					echo '<a href="'.base_url().'themes/'.$category->slug.'" class="theme_current">'.$category->slug."</a>";
				} else {
					echo '<a href="'.base_url().'themes/'.$category->slug.'">'.$category->slug."</a>";
				}
			}
		 ?>

		<?php if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) { ?>
			<div style="float: right">
	            <a href="<?=base_url('themes/add_new_theme_category');?>">Manage Categories</a>
	            <a href="<?=base_url('themes/add_new_theme');?>">Add New</a>
	        </div>
		<?php } ?>
	</div>
	<?php if( $posts ): foreach($posts as $post): ?>
	<article class="mini-theme">
		<a href="<?=base_url();?>theme/<?= $post->theme_id ?>" class="image"><img src="<?= $post->theme_image ?>" alt="" /></a>

			<h5>
				<a href="<?=base_url();?>theme/<?= $post->theme_id ?>"><?= $post->theme_name ?></a>
			</h5>
			<div class="theme-links">
				<a href="<?=base_url();?>theme/<?= $post->theme_id ?>/preview">preview</a>
				<a href="<?= $post->theme_code ?>">code</a>
				<?php if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) { ?>
					<a href="<?=base_url('themes/update_theme/'.$post->theme_id)?>">Update</a>
				<?php } ?>
			</div>
	</article>

<?php endforeach; else: ?>
	<h2>No post yet!</h2>

<?php endif;?>
</div>
<div class="pagination">
	<center>
	<?= $paginglinks; ?>
	</center>
</div>

</div>
</div>
