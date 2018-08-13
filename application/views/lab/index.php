<div class="content-real">
			<?php if($posts): foreach($posts as $post): ?>
				<div  class="post featured clearfix">
					<?php if($post->image != ""): ?>
						<img src="<?= $post->image; ?>" alt="<?= $post->name; ?>" style="float:left;width:250px;margin-right:1em">
					<?php endif; ?>

					<h4><span><?= $post->name; ?></span></h4>
					<p><?= $post->description; ?></p>
					<?php if($post->link != ""): ?>
						<a class="button" href="<?= $post->name; ?>" target="blank">Check It Out</a>
					<?php endif;
						if($post->code != ""): ?>
						<a class="button" href="<?= $post->code; ?>" target="blank">Source Code</a>
					<?php endif; ?>
				</div>
			<?php endforeach;else:?>
			There is no experiments yet.
		<?php endif; ?>
</div>