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
	    $retval = implode(" ", $array)." ...";
	  }
	  return $retval;
	}
?>

<script>

$( "pagination li span a" ).addClass( "button big" );
</script>


	<?php if( $posts ): foreach($posts as $post): ?>
			<article class="post">
			<header>
				<div class="title">
					<h2><a href="<?php echo base_url().'post/'.$post->entry_id;?>"><?php echo ucwords($post->entry_name);?></a></h2>
					<p>A blog post</p>
				</div>
				<div class="meta">
					<span class="published"><?php echo $post->entry_date;?></span>
					<a href="/p/about" class="author"><?php $author = $this->ion_auth->user($post->author_id)->row(); echo ucfirst($author->first_name).' '.ucfirst($author->last_name);?></a>
				</div>
			</header>
			
				
            <?php 
            if ($post->entry_image != NULL) {
           	 	echo "<p><img src='".$post->entry_image."'></p>";
           	}

           	if($post->entry_video != NULL) {
            	echo $post->entry_video;
            }
            echo shorten_string($post->entry_body, 200);
?></p></span></pre>
				
			<footer>
				<ul class="actions">
					<li><a href="<?php echo base_url().'post/'.$post->entry_id;?>" class="button big">Continue Reading</a></li>
				</ul>
				<ul class="stats">
					<li>
						<?php $item = $this->blog_model->get_related_categories($post->entry_id); foreach($item as $category): ?><a href="<?php echo base_url()."category/".$category->slug;?>"><?php echo $category->category_name;?></a> <?php endforeach;?>
					</li>
						<li><a href="<?php echo base_url().'post/'.$post->entry_id;?>#disqus_thread" class="icon fa-comment" data-disqus-identifier="<?php echo 'news'.$post->entry_id;?>"></a></li>
									</ul>
								</footer>
							</article>
			<?php endforeach; else: ?>
			<h2>No post yet!</h2>
			
			<?php endif;?>

			
							<ul class="actions pagination">
								<?php echo $paginglinks; ?>
							</ul>

					</div>
	
	<?php $this->load->view('blog/sidebar');?>