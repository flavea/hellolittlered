<style>
.header {
	display:none;
}

#wrapper {
	padding:0px;
	margin:0px;
}
</style>
<?php if( $albums ): foreach($albums as $post): ?>
			<article class="album" style="background:url(<?php echo $post->album_cover; ?>) bottom; ">
			<header id="album-info">
				<div class="title">
					<h2><a href="<?php echo base_url().'album/'.$post->album_id;?>"><?php echo ucwords($post->album_name);?></a></h2>
				</div>
				<?php echo $post->album_location; ?>
				<?php echo '<br>'.$post->album_date; ?>
			</header>
			</article>
<?php endforeach; endif; ?>
</div>
	
	<?php $this->load->view('blog/footer');?>
