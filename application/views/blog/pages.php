
			<article class="post">
			<?php if( isset($categories) && $categories ): ?>
			<p><ul>
			<?php foreach($categories as $cat):?>
				<li><a href="<?php echo base_url().'p/'.$cat->slug;?>"><?php echo $cat->page_title?></a></li>
			<?php endforeach; ?>
			</ul></p>
				
			<?php else: ?>
			<h3>No pages yet!</h3>
			<?php endif;?>
			</article>
			</div>

		
	<?php $this->load->view('blog/sidebar');?>
	