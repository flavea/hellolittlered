
<h2>Comments</h2>
<?php if($comments): foreach($comments as $row):?>
<div class="comment">
    <div class="comment-meta">
    	<strong>
			<?php echo ucwords($row->comment_name);?></strong> says on <?php echo mdate("%h:%i %a, %d.%m.%Y",mysql_to_unix($row->comment_date));?>
    </div>
    <div><?php echo $row->comment_body;?></div>
</div>
<?php endforeach; else: ?>
<h3>No comment yet!</h3>
<?php endif;?>
<h2>Leave a Comment</h2>