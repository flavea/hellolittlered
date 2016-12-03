			<?php if( $query ): foreach($query as $post): ?>

			<article class="post">
			<header>
				<div class="title">
					<h2><?php echo ucwords($post->theme_name);?></h2>
					<p><?php $item = $this->themes_model->get_related_categories($post->theme_id); foreach($item as $category): ?><a href="<?php echo base_url().$category->slug;?>"><?php echo $category->category_name;?></a> <?php endforeach;?>
					</p>
				</div>
				<div class="meta">
					<time class="published" datetime="2015-11-01"><?php echo mdate('%n %M %Y %H:%i:%s',human_to_unix($post->theme_date));?></time>
					<a href="/p/about" class="author"><?php $author = $this->ion_auth->user($post->author_id)->row(); echo ucfirst($author->first_name).' '.ucfirst($author->last_name);?></a>
				</div>
			</header>
			<center><img src="<?php echo $post->theme_image; ?>" class="image featured"></center>
			<div class="theme-links">
				<a href="<?=base_url();?>theme/<?php echo $post->theme_id ?>/preview">Preview</a>
				<a href="<?php echo $post->theme_code; ?>">Code</a>
			</div><br><br>
            <?php echo $post->theme_body; ?>
			
			</article>
			
			<div id="disqus_thread"></div>
			<script>
			    /**
			     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
			     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
			     */
			    /*
			    var disqus_config = function () {
			        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
			        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
			    };
			    */var disqus_config = function () {
			    <?php foreach($query as $post): ?>
			        this.page.url = window.location.href;  // Replace PAGE_URL with your page's canonical URL variable
			        this.page.identifier = "<?php echo 'theme'.$post->theme_id;?>"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
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
			
		</div>
		

	<!-- footer starts here -->	
	<?php $this->load->view('blog/sidebar');?>