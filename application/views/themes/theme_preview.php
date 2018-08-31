<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( $query ): foreach($query as $post): ?>

<?= $post->theme_preview; ?>
<?php endforeach; ?>
<?php endif;?>