<div id="bg" class="content-real">
	<div id="blog">
			<article class="post featured">
			<h2><?php echo $explanation; ?></h2>
			<?php if(!$blogs_res && !$themes_res && !$page_res && !$projects_res && !$writings_res): echo '<h3><center>Sorry, there is no result for this query</center></h3>';endif;?>
			<?php if( isset($blogs_res) && $blogs_res ): ?>
			<b>Results from Blog Posts:</b>
			<p><ul>
			<?php foreach($blogs_res as $post):?>
				<li><a href="<?php echo base_url().'post/'.$post->entry_id;?>"><?php echo $post->entry_name?></a></li>
			<?php endforeach; ?>
			</ul></p>
			<?php endif;?>
			<?php if( isset($themes_res) && $themes_res ): ?>
			<b>Results from Themes:</b>
			<p><ul>
			<?php foreach($themes_res as $post):?>
				<li><a href="<?php echo base_url().'theme/'.$post->theme_id;?>"><?php echo $post->theme_name?></a></li>
			<?php endforeach; ?>
			</ul></p>
			<?php endif;?>
			<?php if( isset($page_res) && $page_res ): ?>
			<b>Results from Pages:</b>
			<p><ul>
			<?php foreach($page_res as $post):?>
				<li><a href="<?php echo base_url().'theme/'.$post->page_id;?>"><?php echo $post->page_title?></a></li>
			<?php endforeach; ?>
			</ul></p>
			<?php endif;?>
			<?php if( isset($writings_res) && $writings_res ): ?>
			<b>Results from Writings:</b>
			<p><ul>
			<?php foreach($writings_res as $post):?>
				<li><a href="<?php echo base_url().'theme/'.$post->id;?>"><?php echo $post->title?></a></li>
			<?php endforeach; ?>
			</ul></p>
			<?php endif;?>
			<?php if( isset($projects_res) && $projects_res ): ?>
			<b>Results from Projects:</b>
			<p><ul>
			<?php foreach($projects_res as $post):?>
				<li><a href="<?php echo base_url().'theme/'.$post->id;?>"><?php echo $post->name?></a></li>
			<?php endforeach; ?>
			</ul></p>
			<?php endif;?>
			</article>
		</div>

		
	<?php $this->load->view('blog/sidebar');?>
	</div>