<?php
function shorten_string($string, $wordsreturned)
{
	$retval = $string;
	$string = preg_replace('/(?<=\S,)(?=\S)/', ' ', $string);
	$string = str_replace("\n", " ", $string);
	$array = explode(" ", $string);
	if (count($array)<=$wordsreturned)
	{
		$retval = $string;
	}
	else
	{
		array_splice($array, $wordsreturned);
		$retval = implode(" ", $array)."...";
	}
	return $retval;
}
?>

<script>

$( "pagination li span a" ).addClass( "button big" );
</script>

<div id="content">
	<div id="blog">
		<?php if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) { ?>
			<a href="<?=base_url('blog/add_new_entry');?>" class="button" style="margin-left: 1em">Add New Post</a>
			<a href="<?=base_url('blog/manage_posts');?>" class="button">Manage Posts</a>
			<a href="<?=base_url('blog/add_new_category');?>" class="button">Manage Categories</a>
		<?php } ?>
		<?php
		$i = 0;
		 if( $posts ): foreach($posts as $post): ?>
		<article class="post <?php if( $i == 0) { echo "featured"; } ?>">
			<?php
			if ($post->entry_image != NULL) {
				echo "<p><img src='".$post->entry_image."'></p>";
			}

			if($post->entry_video != NULL) {
				echo $post->entry_video;
			}
			?>
			<div class="caption">
				<div class="title">
					<h2><a href="<?= base_url().'post/'.$post->entry_id;?>"><?= ucwords($post->entry_name);?></a></h2>
				</div>
				<div class="meta">
					By <a href="/p/aboutme" class="author"><?php $author = $this->ion_auth->user($post->author_id)->row(); echo ucfirst($author->first_name).' '.ucfirst($author->last_name);?></a> on <?php
$date = date_create($post->entry_date);
echo date_format($date, 'F dS Y H:i');
?>
				</div>

			<?php 

			echo shorten_string($post->entry_body, 300);
			?>
			
			<p>
			<a href="<?= base_url().'post/'.$post->entry_id;?>" class="button">Read More</a>
			<a href="<?=base_url('blog/update_entry/'.$post->entry_id)?>" class="button">Update</a>
			</p>
		</div>
		
	</article>
<?php 
$i++;
endforeach; else: ?>
	<h2>No post yet!</h2>

<?php endif;?>


</div>
<?php $this->load->view('blog/sidebar');?>
</div>


<ul class="actions pagination">
<center>
	<?= $paginglinks; ?>
</center>
</ul>

</div>
