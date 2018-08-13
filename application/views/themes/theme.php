<div id="bg" class="content-real">
	<div id="blog">
			<?php if( $query ): foreach($query as $post): ?>

			<article class="post featured">
			<header>
				<div class="title">
					<h2><span><?= ucwords($post->theme_name);?></span></h2>
				</div>
				<div class="meta">
					<time class="published" datetime="2015-11-01"><?= mdate('%n %M %Y %H:%i:%s',human_to_unix($post->theme_date));?></time>
					<a href="/p/about" class="author"><?php $author = $this->ion_auth->user($post->author_id)->row(); echo ucfirst($author->first_name).' '.ucfirst($author->last_name);?></a>
				</div>
			</header>
			<center>
				<p>
					<img src="<?= $post->theme_image; ?>" class="image">
				</p>
				</center>
			<center>
			<div class="theme-links">
				<a href="<?=base_url();?>theme/<?= $post->theme_id ?>/preview">Preview</a>
				<a href="<?= $post->theme_code; ?>">Code</a>
			</div><br><br>
			</center>
            <?= $post->theme_body; ?>

            <p><b>Type:</b> <?php $item = $this->themes_model->get_related_categories($post->theme_id); foreach($item as $category): ?><a href="<?= base_url().$category->slug;?>"><?= $category->category_name;?></a> <?php endforeach;?>
			
			</article>
			
			<article class="post featured">
			<div id="disqus_thread"></div>
			<script>
			    var disqus_config = function () {
			    <?php foreach($query as $post): ?>
			        this.page.url = window.location.href;  // Replace PAGE_URL with your page's canonical URL variable
			        this.page.identifier = "<?= 'theme'.$post->theme_id;?>"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
			    <?php endforeach; ?>
			    };
			    (function() {  // DON'T EDIT BELOW THIS LINE
			        var d = document, s = d.createElement('script');
			        
			        s.src = '//hellolittlered.disqus.com/embed.js';
			        
			        s.setAttribute('data-timestamp', +new Date());
			        (d.head || d.body).appendChild(s);
			    })();
			</script>
			<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
			<?php endforeach; ?>
			<?php endif;?>
			</article>
		</div>
		
	<?php $this->load->view('blog/sidebar');?>
</div>