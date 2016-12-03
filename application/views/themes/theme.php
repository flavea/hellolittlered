<?php $this->load->view('blog/header');?>

			
			<?php if( $query ): foreach($query as $post): ?>

			<article class="post">
			<header>
				<div class="title">
					<h2><a href="<?php echo base_url().'post/'.$post->page_id;?>"><?php echo ucwords($post->theme_name);?></a></h2>
					<p>A blog post</p>
				</div>
				<div class="meta">
					<time class="published" datetime="2015-11-01"><?php echo mdate('%n %M %Y %H:%i:%s',human_to_unix($post->page_date));?></time>
					<a href="#" class="author"><?php $author = $this->ion_auth->user($post->author_id)->row(); echo ucfirst($author->username);?></a>
				</div>
			</header>
            <?php echo $post->page_body;
?>
			
							</article>
			<?php endforeach; ?>
			<?php endif;?>
			
		</div>
		

	<!-- footer starts here -->	
	<?php $this->load->view('blog/sidebar');?>
	<?php $this->load->view('blog/footer');?>