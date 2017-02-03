
<div id="content">

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
                <div class="block"><b>Type</b>: <?php echo $story->type ?></div>
                <div class="block"><b>Genre</b>: <?php echo $story->genre ?></div>
                <div class="block"><b>Rating</b>: <?php echo $story->rating ?></div>

                <?php 
                if($story->fandom!=NULL):
                    echo '<div class="block" style="width:45%"><b>Fandom</b>: '.$story->fandom.'</div>';
                endif;
                if($story->pairs!=NULL):
                    echo '<div class="block" style="width:45%"><b>Pairs</b>: '.$story->pairs.'</div>';
                endif;
                ?>
                <div class="block"><b>Language</b>: <?php echo $story->language ?></div>
                <div class="block" style="border-bottom:0px"><b>Summary</b>:<br> <?php echo $story->summary ?></div>


                <?php 
                if($story->read1!=NULL):
                    echo '<a class="button block" target="_blank" href="'.$story->read1.'">Read</a>';
                endif;
                if($story->read2!=NULL):
                    echo '<a class="button block" target="_blank" href="'.$story->read2.'">Alternate Link</a>';
                endif;
                if($story->read3!=NULL):
                    echo '<a class="button block" target="_blank" href="'.$story->read3.'">Alternate Link</a>';
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
            <div class="story">
                <div class="block"><b>Type</b>: <?php echo $story->type ?></div>
                <div class="block"><b>Genre</b>: <?php echo $story->genre ?></div>
                <div class="block"><b>Rating</b>: <?php echo $story->rating ?></div>
                <?php 
                if($story->fandom!=NULL):
                    echo '<div class="block" style="padding:0"><div class="three" style="width:45%"><b>Fandom</b>: '.$story->fandom.'</div>';
                endif;
                if($story->pairs!=NULL):
                    echo '<div class="block" style="width:45%"><b>Pairs</b>: '.$story->pairs.'</div></div>';
                endif;
                ?>
                <div class="block"><b>Language</b>: <?php echo $story->language ?></div>
                <div class="block" style="border-bottom:0px"><b>Summary</b>:<br> <?php echo $story->summary ?></div>

                <center>
                    <?php 
                    if($story->read1!=NULL):
                        echo '<a class="button block" target="_blank" href="'.$story->read1.'">Read</a>';
                    endif;
                    if($story->read2!=NULL):
                        echo '<a class="button block" target="_blank" href="'.$story->read2.'">Alternate Link</a>';
                    endif;
                    if($story->read3!=NULL):
                        echo '<a class="button block" target="_blank" href="'.$story->read3.'">Alternate Link</a>';
                    endif;
                    ?>
                </center>
            </div>
        </article>

        <?php 
        endif;
        endforeach; 
        endif;  ?>


</div>
</div>

</div>


<script src='https://cdnjs.cloudflare.com/ajax/libs/masonry/4.1.1/masonry.pkgd.js'></script>
<script src='https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.js'></script>
<script>
var $grid = $('#content').masonry({
  itemSelector: '.post',
  percentPosition: true
});

$grid.imagesLoaded().progress( function() {
  $grid.masonry();
});
</script>