<div id="bg" class="content-real">
	<div id="blog">
		<article class="post featured">
			<header>
				<div class="title">
					<h2><span>Affiliates</span></h2>
				</div>
			</header>
			<p>Nice friends, very very nice friends. [<a href="friends/apply">Apply?</a>]</p>
			<?php if($posts): 
			    $i = 1;
			foreach($posts as $post): ?>
				<div class="affiliate">
				    <div class="number">0<?= $i; ?>.</div>
					<h3><a  href="<?= $post->website; ?>" target="_blank"><?= $post->name; ?></a></h3>
					<span><?= $post->website; ?></span>
					<!--<span><?= $post->description; ?></span>-->
				</div>
			<?php 
			$i++;
			endforeach;else:?>
			There is no affiliates yet.
		<?php endif; ?>
	</article>
</div>
<?php $this->load->view('blog/sidebar');?>
</div>
</div>