<div class="clearfix" style="height: 5em">
<h2 style="margin: .2em 0 0em 0" class="red-text text-darken-4 left">History</h2>
<a class="waves-effect waves-light btn red darken-4-large right red white-text" href="<?= base_url() ?>admin/empty_history">Delete All History</a>
</div>
<div class="card-panel white">

<?php if( $categories != '' ): foreach($categories as $update): ?>
        <p><label><?php echo $update->date ?></label> <br>
          <?php echo $update->status ?></p>
          <hr>
        <?php endforeach;else: ?>
		<h2>No status yet!</h2>
	<?php endif;?>

	<ul class="actions pagination">
		<?php echo $paginglinks; ?>
	</ul>

</div>
