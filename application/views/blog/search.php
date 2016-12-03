
			
			<header>
			<article class="post">
			
			<?php if( isset($posts) && $posts ): ?>
			<p><ul>
			<?php foreach($posts as $post):?>
				<li><a href="<?php echo base_url().'post/'.$post->entry_id;?>"><?php echo $post->entry_name?></a></li>
			<?php endforeach; ?>
			</ul></p>
				
			<?php else: ?>
			<h3>Not Found</h3>
			<?php endif;?>
			</article>
			</div>

		
	<?php $this->load->view('blog/sidebar');?>
	