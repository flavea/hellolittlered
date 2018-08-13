	<center>
			<?php if( $albums ): foreach($albums as $post): ?>
			<section id="intro">
				<header>
					<h2><?= $post->album_name; ?></h2>
					<?= $post->album_story; ?>
				</header>
			</section>
			<?php endforeach; ?>
			<?php endif; ?>
			<?= $post->album_embed; ?>
			
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
    <?php foreach($albums as $albums ): ?>
        this.page.url = window.location.href;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = "<?= 'album'.$post->album_id;?>"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
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
	</center>
	