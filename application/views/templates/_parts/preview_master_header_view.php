<style>
#preview_header {
	background:#ffffff;
	padding:2%;
	width:96%;
	border-top:1px solid #f2f2f2;
	font-family:Consolas;
	position:fixed;
	bottom:0;
	left:0;
	z-index:9999999999999999999999999999999999999999999999999999999990000000000000000999999999999999999999999999999999999999999999999999;
}

#preview_header:after {
	display: table;
	clear:both;
	content:"";
}

#preview_header a {
	background:#f2f2f2;
	display:inline-block;
	margin-left:5px;
	padding:3px 10px;
	color:#999;
	text-decoration: none;
}
</style>
<?php if( $query ): foreach($query as $post): ?>
<div id="preview_header">
	<div style="float:left">
		<b><?php echo $post->theme_name; ?></b>
	</div>
	<div style="float:right">
		<a href="<?php echo $post->theme_code; ?>">Code</a>
		<a href="<?=base_url();?>theme/<?php echo $post->theme_id ?>">Back to Theme Post</a>
	</div>
</div>
<?php endforeach; ?>
<?php endif;?>