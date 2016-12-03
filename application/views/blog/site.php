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
		<?php if($post->object_type == 'news'): 
			$item = $this->site_model->get_post($post->object_id); 
				foreach($item as $news): ?>
					<article class="post">
					<header>
						<div class="title">
							<h2><a href="<?php echo base_url().'post/'.$news->entry_id;?>"><?php echo ucwords($news->entry_name);?></a></h2>
							<p>A blog post</p>
						</div>
						<div class="meta">
							<span class="published"><?php echo $news->entry_date;?></span>
							<a href="/p/about" class="author"><?php $author = $this->ion_auth->user($news->author_id)->row(); echo ucfirst($author->first_name).' '.ucfirst($author->last_name);?></a>
						</div>
					</header>
			
				
		            <?php 
			            if ($news->entry_image != NULL) {
			           	 	echo "<p><img src='".$news->entry_image."'></p>";
			           	}

			           	if($news->entry_video != NULL) {
			            	echo $news->entry_video;
			            }
			            echo shorten_string($news->entry_body, 200);
					?>
				
					<footer>
						<ul class="actions">
							<li><a href="<?php echo base_url().'post/'.$news->entry_id;?>" class="button big">Continue Reading</a></li>
						</ul>
						<ul class="stats">
							<li>
						<?php $item = $this->blog_model->get_related_categories($news->entry_id); foreach($item as $category): ?><a href="<?php echo base_url()."category/".$category->slug;?>"><?php echo $category->category_name;?></a> <?php endforeach;?>
							</li>
							<li><a href="<?php echo base_url().'post/'.$news->entry_id;?>#disqus_thread" class="icon fa-comment" data-disqus-identifier="<?php echo 'news'.$news->entry_id;?>"></a></li>
											</ul>
										</footer>
									</article>
					<?php 
				endforeach;
				endif;  ?>
			<?php if($post->object_type == 'album'): 
			$item = $this->site_model->get_album($post->object_id); 
				foreach($item as $album): ?>
					<article class="post">
				
		            <img src="<?php echo $album->album_cover ;?>" class="image featured">

					<div class="footer">
						<div class="title">
							<h2><a href="<?php echo base_url().'album/'.$album->album_id;?>"><?php echo ucwords($album->album_name);?></a></h2>
							<p> A photo album <?php 
					            if ($album->album_location != NULL) {
					           	 	echo 'taken in '.$album->album_location. " and";
					           	}

					           	if($album->album_date != NULL) {
					            	echo " taken on ".$album->album_date;
					            }
							?></p>
						</div>
					</div>
				
					</article>
					<?php 
				endforeach; 
				endif;  ?>

			<?php if($post->object_type == 'writing'): 
			$item = $this->site_model->get_story($post->object_id); 
				foreach($item as $story): 
					if(!$this->ion_auth->logged_in()):
						if ($story->hide != 1):?>
							<article class="post">
							<header>
								<div class="title">
									<h2><?php echo $story->title ?></h2>
								</div>
							</header>
							<div class="read-links">
								<div class="block" style="padding:0">
						            <div class="three"><b>Type</b>: <?php echo $story->type ?></div>
						            <div class="three"><b>Genre</b>: <?php echo $story->genre ?></div>
						            <div class="three"><b>Rating</b>: <?php echo $story->rating ?></div>
						        </div>
						        
					            <?php 
					            if($story->fandom!=NULL):
						            echo '<div class="block" style="padding:0"><div class="three" style="width:45%"><b>Fandom</b>: '.$story->fandom.'</div>';
						        endif;
					            if($story->pairs!=NULL):
						            echo '<div class="three" style="width:45%"><b>Pairs</b>: '.$story->pairs.'</div></div>';
						        endif;
						        ?>
						        <div class="block"><b>Language</b>: <?php echo $story->language ?></div>
					            <div class="block" style="border-bottom:0px"><b>Summary</b>:<br> <?php echo $story->summary ?></div>

					            
					            <?php 
					            if($story->read1!=NULL):
						            echo '<a class="readstory" target="_blank" href="'.$story->read1.'">Read</a>';
						        endif;
					            if($story->read2!=NULL):
						            echo '<a class="readstory" target="_blank" href="'.$story->read2.'">Alternate Link</a>';
						        endif;
					            if($story->read3!=NULL):
						            echo '<a class="readstory" target="_blank" href="'.$story->read3.'">Alternate Link</a>';
						        endif;
						        ?>
					    </div>
							</article>
						<?php
							endif;
							else:
						?>
							<article class="post">
							<header>
								<div class="title">
									<h2><?php echo $story->title ?></h2>
								</div>
							</header>
							<div class="read-links">
								<div class="block" style="padding:0">
						            <div class="three"><b>Type</b>: <?php echo $story->type ?></div>
						            <div class="three"><b>Genre</b>: <?php echo $story->genre ?></div>
						            <div class="three"><b>Rating</b>: <?php echo $story->rating ?></div>
						        </div>
						        
					            <?php 
					            if($story->fandom!=NULL):
						            echo '<div class="block" style="padding:0"><div class="three" style="width:45%"><b>Fandom</b>: '.$story->fandom.'</div>';
						        endif;
					            if($story->pairs!=NULL):
						            echo '<div class="three" style="width:45%"><b>Pairs</b>: '.$story->pairs.'</div></div>';
						        endif;
						        ?>
						        <div class="block"><b>Language</b>: <?php echo $story->language ?></div>
					            <div class="block" style="border-bottom:0px"><b>Summary</b>:<br> <?php echo $story->summary ?></div>

					            
					            <?php 
					            if($story->read1!=NULL):
						            echo '<a class="readstory" target="_blank" href="'.$story->read1.'">Read</a>';
						        endif;
					            if($story->read2!=NULL):
						            echo '<a class="readstory" target="_blank" href="'.$story->read2.'">Alternate Link</a>';
						        endif;
					            if($story->read3!=NULL):
						            echo '<a class="readstory" target="_blank" href="'.$story->read3.'">Alternate Link</a>';
						        endif;
						        ?>
					    </div>
						
							</article>

						<?php 
					endif;
				endforeach; 
				endif;  ?>
			
			<?php if($post->object_type == 'resource'): 
			$item = $this->site_model->get_resource($post->object_id); 
				foreach($item as $resource): ?>
					<article class="post">
				
		            <center><img src="<?php echo $resource->resource_preview ;?>"></center>

					<header class="footer">
						<div class="title">
							<h2><a href="<?php echo base_url().'resource/'.$resource->resource_id;?>"><?php echo ucwords($resource->resource_name);?></a></h2>
							<p> A Graphic Resource</p>
						</div>

						<div class="meta">
							<ul class="actions">
								<li><a href="<?php echo $resource->resource_download ?>" class="button big">Download</a></li>
							</ul>
						</div>
					</header>
				
					</article>
					<?php 
				endforeach;  
				endif; ?>
			<?php if($post->object_type == 'theme'): 
			$item = $this->site_model->get_theme($post->object_id); 
				foreach($item as $theme): ?>
					<article class="post">
				
		            <img src="<?php echo $theme->theme_image ;?>" class="image featured">

					<header class="footer">
						<div class="title">
							<h2><a href="<?php echo base_url().'theme/'.$theme->theme_id;?>"><?php echo ucwords($theme->theme_name);?></a></h2>
							<p>a <?php $cat = $this->site_model->get_related_categories($post->object_id); foreach($cat as $category): ?><a href="<?php echo base_url().$category->slug;?>"><?php echo $category->category_name;?></a> <?php endforeach;?> theme. Click on the title to see the detail.</p>
						</div>
						<div class="meta">
							<span class="published"><?php echo $theme->theme_date;?></span>
							<a href="/p/about" class="author"><?php $author = $this->ion_auth->user($theme->author_id)->row(); echo ucfirst($author->first_name).' '.ucfirst($author->last_name);?></a>

						</div>
					</header>
				
					</article>
					<?php 
				endforeach; 
				endif;  ?>
			<?php if($post->object_type == 'store'): 
			$item = $this->site_model->get_design($post->object_id); 
				foreach($item as $store): ?>
					<article class="post">
				
		            <center><img src="<?php echo $store->image ;?>"></center>

					<header class="footer">
						<div class="title">
							<h2><?php echo ucwords($store->name);?></h2>
							<p>A design for phone cases, books, etc.</p>
						</div>

						<div class="meta">
							<ul class="actions">
								<li style="display:block;margin-bottom:2px"><a href="<?php echo $store->redbubble ?>" class="button big">Redbubble.com</a></li>
								<li style="display:block"><a href="<?php echo $store->tees ?>" class="button big">Tees.co.id</a></li>
							</ul>
						</div>
					</header>
				
					</article>
					<?php 
				endforeach; ?>
			<?php endif; 
		endforeach;
		endif; ?>

					</div>
	
	<?php $this->load->view('blog/sidebar');?>