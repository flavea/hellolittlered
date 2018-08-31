<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="clearfix" style="height: 5em">
<h2 style="margin: .2em 0 0em 0" class="red-text text-darken-4 left">History</h2>
<a class="button button-inverse-large right red white-text" href="<?= base_url() ?>admin/empty_history">Delete All History</a>
</div>
<div class="post">

<?php if( $categories != '' ): foreach($categories as $update): ?>
        <p><label><?= $update->date ?></label> <br>
          <?= $update->status ?></p>
          <hr>
        <?php endforeach;else: ?>
		<h2>No status yet!</h2>
	<?php endif;?>

	<ul class="actions pagination">
		<?= $paginglinks; ?>
	</ul>

</div>
