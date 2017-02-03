<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script>

$('.content-real').masonry({
  itemSelector: '.photo'
});
</script>
<div class="content-real">
<center>
<h2><a href="http://flickr.com/photos/113411780@N03">Latest Photos on Flickr</a></h2>
	<div class="album flickr">
<?php  if($flickr) {
	foreach ($flickr as $single_photo) {
		$farm_id = $single_photo->farm;
		$server_id = $single_photo->server;
		$photo_id = $single_photo->id;
		$secret_id = $single_photo->secret;
		$size = 'm';
		 
		$title = $single_photo->title;
		 
		$photo_url = 'http://farm'.$farm_id.'.staticflickr.com/'.$server_id.'/'.$photo_id.'_'.$secret_id.'.'.'jpg';
		print "<div class='photo'><img title='".$title."' src='".$photo_url."' /></div>";
	}?>
			
<?php } ?>
</div>

<h2><a href="http://instagram.com/l.ifnt">Latest Photos on Instagram</a></h2>
<div class="album instagram">
<?php  if($instagram) {
	foreach ($instagram as $data) {
		$link = $data['link'];
        $id = $data['id'];
        $caption = $data['caption']['text'];
        $author = $data['caption']['from']['username'];
        $thumbnail = $data['images']['standard_resolution']['url'];
	?>
	
    <div class="photo">
        <a href="<?php echo $link ?>" target="_blank"><img src="<?= $thumbnail ?>" title="<?= htmlentities($caption) ?>" alt="<?= htmlentities($caption) ?>" /></a>
    </div>
<?php 
}
} ?>
<center>
</div>
</div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/masonry/4.1.1/masonry.pkgd.js'></script>
<script src='https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.js'></script>
<script>
var $grid = $('.album').masonry({
  itemSelector: '.photo',
  percentPosition: true
});

$grid.imagesLoaded().progress( function() {
  $grid.masonry();
});
</script>