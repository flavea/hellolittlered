<script>
function delete_writing($id) {
	var check = confirm('Are you sure you want to delete?');
	var id = $id;
	if (check == true) {
		window.location.href = "<?=base_url()?>writing/delete_story/".concat(id);
	}
	else {
		return false;
	}
}
</script>

<div class="card-panel white">
	<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Add New Story</h2>
	<?php if( $query != '' ): foreach($query as $post): ?>
	<?= form_open('writing/writing/'.$post->id);?>
	
	<div class="input-field">
		<label>Title</label>
		<input type="text" name="title"value="<?= $post->title ?>" required/></div>
		
		<div class="input-field">
			<select name="type">
				<option value="Original" <?php if($post->type == 'Original') echo 'selected'; ?>>Original Fiction</option>
				<option value="Fanfiction" <?php if($post->type == 'Fanfiction') echo 'selected'; ?>>Fanfiction</option>
			</select>
			<label>Type</label>
		</div>
		
		<div class="input-field">
			<select name="genre[]" multiple>
				<option value='Adventure' <?php if($post->genre == 'Adventure') echo 'selected'; ?>>Adventure</option>
				<option value='Angst' <?php if($post->genre == 'Angst') echo 'selected'; ?>>Angst</option>
				<option value='Crime' <?php if($post->genre == 'Crime') echo 'selected'; ?>>Crime</option>
				<option value='Drama' <?php if($post->genre == 'Drama') echo 'selected'; ?>>Drama</option>
				<option value='Family' <?php if($post->genre == 'Family') echo 'selected'; ?>>Family</option>
				<option value='Fantasy' <?php if($post->genre == 'Fantasy') echo 'selected'; ?>>Fantasy</option>
				<option value='Friendship' <?php if($post->genre == 'Friendship') echo 'selected'; ?>>Friendship</option>
				<option value='General' <?php if($post->genre == 'General') echo 'selected'; ?>>General</option>
				<option value='Horror' <?php if($post->genre == 'Horror') echo 'selected'; ?>>Horror</option>
				<option value='Humor' <?php if($post->genre == 'Humor') echo 'selected'; ?>>Humor</option>
				<option value='Hurt/Comfort' <?php if($post->genre == 'Hurt/Comfort') echo 'selected'; ?>>Hurt/Comfort</option>
				<option value='Mystery' <?php if($post->genre == 'Mystery') echo 'selected'; ?>>Mystery</option>
				<option value='Parody' <?php if($post->genre == 'Parody') echo 'selected'; ?>>Parody</option>
				<option value='Poetry' <?php if($post->genre == 'Poetry') echo 'selected'; ?>>Poetry</option>
				<option value='Romance' <?php if($post->genre == 'Romance') echo 'selected'; ?>>Romance</option>
				<option value='Sci-Fi' <?php if($post->genre == 'Sci-Fi') echo 'selected'; ?>>Sci-Fi</option>
				<option value='Spiritual' <?php if($post->genre == 'Spiritual') echo 'selected'; ?>>Spiritual</option>
				<option value='Supernatural' <?php if($post->genre == 'Supernatural') echo 'selected'; ?>>Supernatural</option>
				<option value='Suspense' <?php if($post->genre == 'Suspense') echo 'selected'; ?>>Suspense</option>
				<option value='Tragedy' <?php if($post->genre == 'Tragedy') echo 'selected'; ?>>Tragedy</option>
				<option value='Western' <?php if($post->genre == 'Western') echo 'selected'; ?>>Western</option>
			</select>
			<label>Genre</label>
		</div>
		
		<div class="input-field">
			<select name="rating">
				<option value='K -> T' <?php if($post->rating == 'K -> T') echo 'selected'; ?>>Rated K -> T</option>
				<option value='K -> K+' <?php if($post->rating == 'K -> K+') echo 'selected'; ?>>Rated K -> K+</option>
				<option value='K' <?php if($post->rating == 'K') echo 'selected'; ?>>Rated K</option>
				<option value='K+' <?php if($post->rating == 'K+') echo 'selected'; ?>>Rated K+</option>
				<option value='T' <?php if($post->rating == 'T') echo 'selected'; ?>>Rated T</option>
				<option value='M' <?php if($post->rating == 'M') echo 'selected'; ?>>Rated M</option>
			</SELECT>
			<label>Genre</label>
		</div>
		
		<div class="input-field">
			<label>Fandom</label>
			<input type="text" name="fandom" value="<?= $post->fandom ?>" />
		</div>
		
		<div class="input-field">
			<label>Pairs</label>
			<input type="text" name="pairs" value="<?= $post->pairs ?>" />
		</div>
		
		<div class="input-field">
			<label>Summary</label>
			<input type="text" name="summary" value="<?= $post->summary ?>" />
		</div>
		
		<div class="input-field">
			<label>Link 1</label>
			<input type="url" name="link1" value="<?= $post->read1 ?>" />
		</div>
		
		<div class="input-field">
			<label>Link 2</label>
			<input type="url" name="link2" value="<?= $post->read2 ?>" />
		</div>
		
		<div class="input-field">
			<label>Link 3</label>
			<input type="url" name="link3" value="<?= $post->read3 ?>" />
		</div>

		<p>
			<label>Status</label><br>

			<?php if( isset($statuses) && $statuses): foreach($statuses as $status): ?>
			<input name="status" type="radio" id="status-<?= $status->id;?>" value="<?= $status->id;?>" <?php if($post->status == $status->id) echo 'checked';?>/>
			<label for="status-<?= $status->id;?>" style="margin-right:1em"><?= $status->name;?></label>
		<?php endforeach;endif; ?>
	</p>
	
	<div class="input-field">
		<label>Language</label>
		<input type="text" name="language" value="<?= $post->language ?>" />
	</div>

	<div class="switch">
		<label>
			<input type="checkbox" name="tweet" value="1"  />
			<span class="lever"></span>
			Tweet?
		</label>
	</div>
	
	
	<input class="waves-effect waves-light btn red darken-4" type="submit" value="Submit"/>
	<input class="waves-effect waves-light btn red darken-4" type="reset" value="Reset"/>	
	
</form>

<?php endforeach; else:?>
	<?= form_open('writing/writing');?>
	
	
	<div class="input-field"><label>Title</label>
		<input type="text" name="title" required /></div>
		
		<div class="input-field">
			<select name="type">
				<option value="Original">Original Fiction</option>
				<option value="Fanfiction">Fanfiction</option>
			</select>
			<label>Type</label>
		</div>
		
		<div class="input-field">
			<select name="genre[]" multiple>
				<option value='Adventure'>Adventure</option>
				<option value='Angst'>Angst</option>
				<option value='Crime'>Crime</option>
				<option value='Drama'>Drama</option>
				<option value='Family'>Family</option>
				<option value='Fantasy'>Fantasy</option>
				<option value='Friendship'>Friendship</option>
				<option value='General'>General</option>
				<option value='Horror'>Horror</option>
				<option value='Humor'>Humor</option>
				<option value='Hurt/Comfort'>Hurt/Comfort</option>
				<option value='Mystery'>Mystery</option>
				<option value='Parody'>Parody</option>
				<option value='Poetry'>Poetry</option>
				<option value='Romance'>Romance</option>
				<option value='Sci-Fi'>Sci-Fi</option>
				<option value='Spiritual'>Spiritual</option>
				<option value='Supernatural'>Supernatural</option>
				<option value='Suspense'>Suspense</option>
				<option value='Tragedy'>Tragedy</option>
				<option value='Western'>Western</option>
			</select>
			<label>Genre</label>
		</div>
		
		<div class="input-field">
			<select name="rating">
				<option value='K -> T' selected>Rated K -> T</option>
				<option value='K -> K+' >Rated K -> K+</option>
				<option value='K' >Rated K</option>
				<option value='K+' >Rated K+</option>
				<option value='T' >Rated T</option>
				<option value='M' >Rated M</option>
			</SELECT>
			<label>Genre</label>
		</div>
		
		<div class="input-field"><label>Fandom</label>
			<input type="text" name="fandom"/></div>
			
			<div class="input-field"><label>Pairs</label>
				<input type="text" name="pairs" /></div>
				
				<div class="input-field"><label>Summary</label>
					<input type="text" name="summary" /></div>
					
					<div class="input-field"><label>Link 1</label>
						<input type="url" name="link1"/></div>
						
						<div class="input-field"><label>Link 2</label>
							<input type="url" name="link2" /></div>
							
							<div class="input-field"><label>Link 3</label>
								<input type="text" name="link3" /></div>

								<p>
									<label>Status</label><br>

									<?php if( isset($statuses) && $statuses): foreach($statuses as $status): ?>
									<input name="status" type="radio" id="status-<?= $status->id;?>" value="<?= $status->id;?>" />
									<label for="status-<?= $status->id;?>" style="margin-right:1em"><?= $status->name;?></label>
								<?php endforeach;endif; ?>
							</p>
							
							<div class="input-field"><label>Language</label>
								<input type="text" name="language" /></div>

							<div class="switch">
								<label>
									<input type="checkbox" name="tweet" value="1"  />
									<span class="lever"></span>
									Tweet?
								</label>
							</div>
								
								<input class="waves-effect waves-light btn red darken-4" type="submit" value="Submit"/>
								<input class="waves-effect waves-light btn red darken-4" type="reset" value="Reset"/>	
								
							</form>

						<?php endif; ?>

					</div>
					<div class="card-panel white">
						<h2 style="margin: .2em 0 1em 0" class="red-text text-darken-4">Existing Stories</h2>
						<table class="highlight striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Title</th>
									<th>Type</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tr>
								<?php if( isset($categories) && $categories): foreach($categories as $category): ?>
								<?php 
								echo '<td>'.$category->id.'</td>';
								echo '<td>'.$category->title.'</td>';
								echo '<td>'.$category->type.'</td>';
								echo '<td>'.$category->name.'</td>';
								echo '<td>
								<a class="waves-effect waves-light btn red darken-4" href="'.base_url().'writing/writing/'.$category->id.'">update</a>
								<button class="waves-effect waves-light btn red darken-4" onclick="delete_writing('.$category->id.')">delete</button>
								</td>';
								?>
							</tr>
						<?php endforeach; else:?>
						<td colspan="5">There is no category.</td>
					<?php endif; ?>
				</table>

				

				<ul class="actions pagination">
					<?= $paginglinks; ?>
				</ul>

			</div>