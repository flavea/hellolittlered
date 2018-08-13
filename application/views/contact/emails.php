
<div class="clearfix" style="height: 5em">
<h2 style="margin: .2em 0 0em 0" class="teal-text text-lighten-2 left">Emails</h2>
<a class="waves-effect waves-light btn-large right red white-text" href="<?= base_url() ?>contact/email_mark">Mark All Emails As Read</a>
</div>


<?php if( $posts ): ?>
	<?php foreach($posts as $post): ?>
		<div class="card-panel white">
			<p><label>From</label><br> <?= $post->name; ?> (<?= $post->email; ?>)</p>
			<p><label>Message</label><br>
				<?= $post->message; ?></p>
				<?php if($post->status != 2) { ?>
				<a class="waves-effect waves-light btn" href="<?= base_url() ?>contact/email_mark/<?= $post->contact_id; ?>">Mark Read</a>
				<?php } ?>
			</div>
		<?php endforeach; else: ?>
		<h2>No post yet!</h2>
	<?php endif;?>

	<ul class="actions pagination">
		<?= $paginglinks; ?>
	</ul>

</div>
