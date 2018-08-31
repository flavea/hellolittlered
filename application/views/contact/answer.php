<?php if( $posts ): ?>
	<?php foreach($posts as $post): ?>
		<div class="post">
			<?= form_open('contact/answer/'.$post->id);?>
			
			<input type="hidden" name="id" value="<?= $post->id ?>" readonly>

			<div class="input-field">
				<label>Name</label>
				<input type="text" name="name" value="<?= $post->name ?>" readonly>
			</div>

			<label>Question</label>
			<textarea rows="16" cols="100%" name="question"  readonly><?= $post->message ?></textarea>

			<label>Answer</label>
			<textarea rows="16" cols="100%" name="answer" ><?= $post->answer ?></textarea>

			<div class="switch">
				<label>
					<input type="checkbox" id="tweet" value="1"  />
					<span class="lever"></span>
					Tweet?
				</label>
			</div>

			<input class="button button-inverse" type="submit" value="Submit"/>
			<input class="button button-inverse" type="reset" value="Reset"/>	

		</form>

	</div>
<?php endforeach; endif;?>