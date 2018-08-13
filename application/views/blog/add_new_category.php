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


	<?php if( $query != '' ): foreach($query as $post): ?>
	<?= form_open('blog/add-new-category/'.$post->category_id);?>
	<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Update Category</h2>

	<input type="hidden" name="id" value="<?= $post->category_id ?>" >

	<div class="input-field">
		<label>Category Name</label>
		<input type="text" name="category_name" value="<?= $post->category_name ?>" required />
	</div>

	<div class="input-field">
		<label>Slug</label>
		<input type="text" name="category_slug" value="<?= $post->slug ?>" required />
	</div>

	<input class="waves-effect waves-light btn red darken-4" type="submit" value="Submit"/>
	<input class="waves-effect waves-light btn red darken-4" type="reset" value="Reset"/>	

</form>
	<?php endforeach; else:?>

	<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Add New Category</h2>
	<?= form_open('blog/add-new-category');?>


	<div class="input-field">
		<label>Category Name</label>
		<input type="text" name="category_name" required />
	</div>

	<div class="input-field">
		<label>Slug</label>
		<input type="text" name="category_slug" required />
	</div>

	<input class="waves-effect waves-light btn red darken-4" type="submit" value="Submit"/>
	<input class="waves-effect waves-light btn red darken-4" type="reset" value="Reset"/>	

</form>

<?php endif; ?>
</div>
</div>

<div class="card-panel white">
	<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Existing Categories</h2>
	<table class="highlight striped">
		<thead>
			<tr>
				<th>Category ID</th>
				<th>Category Name</th>
				<th>Category Slug</th>
				<th>Action</th>
			</tr>
		</thead>
		<tr>
			<?php if( isset($categories) && $categories): foreach($categories as $category): ?>
				<?php 
				echo '<td>'.$category->category_id.'</td>';
				echo '<td>'.$category->category_name.'</td>';
				echo '<td>'.$category->slug.'</td>';
				echo '<td>
					<a class="waves-effect waves-light btn red darken-4" href="'.base_url().'admin/add_new_category/'.$category->category_id.'">edit</a>
				<button class="waves-effect waves-light btn red darken-4" onclick="delete_category('.$category->category_id.')">delete</button>
			</td>';
			?>
		</tr>
	<?php endforeach; else:?>
	<td colspan="4">There is no category.</td>
<?php endif; ?>
</table>
</div>