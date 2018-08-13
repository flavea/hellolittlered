<?php if( $posts ): ?>
	<?php foreach($posts as $post): ?>
		<div class="card-panel white">
			<?= form_open('contact/answer/'.$post->id);?>
			
			<input type="hidden" name="id" value="<?= $post->id ?>" readonly>

			<div class="input-field">
				<label>Name</label>
				<input type="text" name="name" value="<?= $post->name ?>">
			</div>

			<label>Question</label>
			<textarea rows="16" cols="100%" name="question" class="materialize-textarea"><?= $post->message ?></textarea>

			<label>Answer</label>
			<textarea rows="16" cols="100%" name="answer" class="materialize-textarea"><?= $post->answer ?></textarea>

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

	</div>


<?php endforeach; endif;?>

	<ul class="actions pagination">
		<?= $paginglinks; ?>
	</ul>