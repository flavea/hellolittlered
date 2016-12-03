			<?php if( $query ): foreach($query as $post): ?>
			
			<article class="post">
			<header>
				<div class="title">
					<h2><a href="<?php echo base_url().'post/'.$post->entry_id;?>"><?php echo ucwords($post->entry_name);?></a></h2>
					<p>A blog post</p>
				</div>
				<div class="meta">
					<time class="published" datetime="2015-11-01"><?php echo mdate('%n %M %Y %H:%i:%s',human_to_unix($post->entry_date));?></time>
					<a href="#" class="author"><?php $author = $this->ion_auth->user($post->author_id)->row(); echo ucfirst($author->username);?></a>
				</div>
			</header>
			
				
            <?php 
            if ($post->entry_image != NULL) {
           	 	echo "<p><img src='".$post->entry_image."'></p>";
           	}

           	if($post->entry_video != NULL) {
            	echo $post->entry_video;
            }
            echo $post->entry_body;
?>
				
			<footer>
				
				<ul class="stats">
					<li>
						<?php $item = $this->blog_model->get_related_categories($post->entry_id); foreach($item as $category): ?><a href="<?php echo base_url().$category->slug;?>"><?php echo $category->category_name;?></a> <?php endforeach;?>
					</li>
					<li><a href="<?php echo base_url().'post/'.$post->entry_id;?>#disqus_thread" class="icon fa-comment" data-disqus-identifier="<?php echo 'news'.$post->entry_id;?>"></a></li>
									</ul>
								</footer>
							</article>
			<?php endforeach; ?>
			<?php endif;?>
			
			<div id="disqus_thread"></div>
<script>
    /**
     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
     */
    
    var disqus_config = function () {
    <?php foreach($query as $post): ?>
        this.page.url = window.location.href;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = "<?php echo 'news'.$post->entry_id;?>"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
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
			
		</div>
	<!-- footer starts here -->	
	<?php $this->load->view('blog/sidebar');?>
	<!-- footer ends here -->
