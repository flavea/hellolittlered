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
	
	<?php if($this->ion_auth->logged_in()): ?>
	<b>Total Stories:</b> <?php echo $total.'<br><br>'; endif ?>
	<?php if( $posts ): 
				foreach($posts as $story): 
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
			

					</div>
	
	<?php $this->load->view('blog/sidebar');?>