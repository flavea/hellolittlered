<script>
	function delete_category($id) {
		var check = confirm('Are you sure you want to delete?');
		var id = $id;
		if (check == true) {
			window.location.href = "<?=base_url()?>resource/delete_resource_category/".concat(id);
		}
		else {
			return false;
		}
	}
</script>

<div class="post">
<?php if( $query != '' ): foreach($query as $post): ?>
		<?= form_open('resource/add-new-resource-type/'.$post->type_id);?>
		<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Update Category</h2>

		<input type="hidden" name="id" value="<?= $post->type_id ?>" >

		<div class="input-field">
			<label>Category Name</label>
			<input type="text" name="category_name" value="<?= $post->type_name ?>" required />
		</div>

		<div class="input-field">
			<label>Slug</label>
			<input type="text" name="category_slug" value="<?= $post->type_slug ?>" required />
		</div>

		<input class="button button-inverse" type="submit" value="Submit"/>
		<input class="button button-inverse" type="reset" value="Reset"/>	

	</form>


<?php endforeach; else:?>
	<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Add New Category</h2>
	<?= form_open('resource/add-new-resource-type');?>

	<div class="input-field">
		<label>Category Name</label>
		<input type="text" name="category_name" required />
	</div>

	<div class="input-field">
		<label>Slug</label>
		<input type="text" name="category_slug" required/>
	</div>
	
	<input class="button button-inverse" type="submit" value="Submit"/>
	<input class="button button-inverse" type="reset" value="Reset"/>	

</form>


<?php endif; ?>

</div>

<div class="post">

	<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Existing Categories</h2>
	<table id="table" class="stripe">
		<thead>
			<tr>
				<th>Category ID</th>
				<th>Category Name</th>
				<th>Category Slug</th>
				<th>Action</th>
			</tr>
		<thead><tbody>
		<tr>
			<?php if( isset($categories) && $categories): foreach($categories as $category): ?>
				<?php 
				echo '<td>'.$category->type_id.'</td>';
				echo '<td>'.$category->type_name.'</td>';
				echo '<td>'.$category->type_slug.'</td>';
				echo '<td>
					<a class="button button-inverse" href="'.base_url().'resource/add_new_resource_type/'.$category->type_id.'">edit</a>
				<button class="button button-inverse fa fa-trash" onclick="delete_category('.$category->type_id.')"></button>
			</td>';
			?>
		</tr>
	<?php endforeach; else:?>
	<td colspan="4">There is no category.</td>
<?php endif; ?>
</tbody></table>
</div>