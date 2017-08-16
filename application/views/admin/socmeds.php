<script>
	function delete_category($id) {
		var check = confirm('Are you sure you want to delete?');
		var id = $id;
		if (check == true) {
			window.location.href = "<?=base_url()?>admin/delete_category/".concat(id);
		}
		else {
			return false;
		}
	}
</script>


<div class="card-panel white">
	
	<?php if( $query  ): foreach($query as $post): ?>
		<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Social Medias</h2>
		<?php echo form_open('admin/socmeds');?>

		<input type="hidden" name="id"  value="<?php echo $post->id ?>" readonly/>

		<div class="input-field">
			<label>Codepen</label>
			<input type="text" name="codepen"  value="<?php echo $post->codepen ?>" />
		</div>

		<div class="input-field">
			<label>Deviantart</label>
			<input type="text" name="deviantart"  value="<?php echo $post->deviantart ?>" />
		</div>

		<div class="input-field">
			<label>Facebook</label>
			<input type="text" name="facebook"  value="<?php echo $post->facebook ?>" />
		</div>

		<div class="input-field">
			<label>Flickr</label>
			<input type="text" name="flickr"  value="<?php echo $post->flickr ?>" />
		</div>

		<div class="input-field">
			<label>Instagram</label>
			<input type="text" name="instagram"  value="<?php echo $post->instagram ?>" />
		</div>

		<div class="input-field">
			<label>Linkedin</label>
			<input type="text" name="linkedin"  value="<?php echo $post->linkedin ?>" />
		</div>

		<div class="input-field">
			<label>Soundcloud</label>
			<input type="text" name="soundcloud"  value="<?php echo $post->soundcloud ?>" />
		</div>

		<div class="input-field">
			<label>Twitter</label>
			<input type="text" name="twitter"  value="<?php echo $post->twitter ?>" />
		</div>

		<div class="input-field">
			<label>Tumblr</label>
			<input type="text" name="tumblr"  value="<?php echo $post->tumblr ?>" />
		</div>

		<div class="input-field">
			<label>Youtube</label>
			<input type="text" name="youtube"  value="<?php echo $post->youtube ?>" />
		</div>

		<div class="input-field">
			<label>Behance</label>
			<input type="text" name="behance"  value="<?php echo $post->behance ?>" />
		</div>

		<div class="input-field">
			<label>Github</label>
			<input type="text" name="github"  value="<?php echo $post->github ?>" />
		</div>
		
		
		<input class="waves-effect waves-light btn red darken-4" type="submit" value="Submit"/>
		<input class="waves-effect waves-light btn red darken-4" type="reset" value="Reset"/>	
		
	</form>
<?php endforeach; endif;?>

</div>