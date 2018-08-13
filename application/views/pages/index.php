<div id="bg" class="content-real">
	<div id="blog">
		<article class="post featured">
			<?php if( isset($categories) && $categories ): ?>
			<p><ul>
				<?php foreach($categories as $cat):?>
				<li><a href="<?= base_url().'p/'.$cat->slug;?>"><?= $cat->page_title?></a></li>
			<?php endforeach; ?>
		</ul></p>

	<?php else: ?>
	<h3>No pages yet!</h3>
<?php endif;?>
</article>
</div>


<?php $this->load->view('blog/sidebar');?>
</div>