<script>
	function delete_category($id) {
		var check = confirm('Are you sure you want to delete?');
		var id = $id;
		if (check == true) {
			window.location.href = "delete_category/".concat(id);
		}
		else {
			return false;
		}
	}
</script>

<div class="card-panel white">
	
	<?php if( $query  ): foreach($query as $post): ?>
		<h2 style="margin: .2em 0 0em 0" class="red-text text-darken-4">Change Header</h2>
		<?php echo form_open('admin/header');?>
		
		<input type="hidden" name="id"  value="<?php echo $post->id ?>" readonly/>
		
		<div class="input-field">
			<label>Image Link</label>
			<input type="text" name="link"  value="<?php echo $post->link ?>" />
		</div>

		
		
		<input class="waves-effect waves-light btn red darken-4" type="submit" value="Submit"/>
		<input class="waves-effect waves-light btn red darken-4" type="reset" value="Reset"/>	
		
	</form>
<?php endforeach; endif;?>

</div>