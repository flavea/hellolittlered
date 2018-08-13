<div id="bg" class="content-real">
	<div id="blog">
			<article class="post featured">
			<?php foreach($category as $row):?>
			<h2><a href="<?= base_url().'category/'.$row->slug;?>"><?= ucwords($row->category_name);?></a> (<?= count($query);?>)</h2>
			<?php endforeach;?>
			
			<?php if( isset($query) && $query ): ?>
			<p><ul>
			<?php foreach($query as $post):?>
				<li><a href="<?= base_url().'post/'.$post->entry_id;?>"><?= $post->entry_name?></a></li>
			<?php endforeach; ?>
			</ul></p>
				
			<?php else: ?>
			<h3>No post yet!</h3>
			<?php endif;?>
			</article>
		</div>

		
	<?php $this->load->view('blog/sidebar');?>
	</div>