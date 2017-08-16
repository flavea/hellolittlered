
<div id="content">

    <div id="blog">

        <?php if( $posts ): 
        foreach($posts as $story): ?>
        <article class="post">
            <header>
                <div class="title">
                    <h2><span><?php echo $story->title ?></span></h2>
                </div>
            </header>
            <div class="block"><b>Type</b>: <?php echo $story->type ?></div>
            <div class="block"><b>Genre</b>: <?php echo $story->genre ?></div>
            <div class="block"><b>Rating</b>: <?php echo $story->rating ?></div>

            <?php 
            if($story->fandom!=NULL):
                echo '<div class="block"><b>Fandom</b>: '.$story->fandom.'</div>';
            endif;
            if($story->pairs!=NULL):
                echo '<div class="block"><b>Pairs</b>: '.$story->pairs.'</div>';
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
        </article>

        <?php 
        endforeach; 
        endif;  ?>



        <ul class="actions pagination">
            <?php echo $paginglinks; ?>
        </ul>

    </div>

    <?php $this->load->view('blog/sidebar');?>
</div>

</div>