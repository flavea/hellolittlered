<?php if( $posts ): ?>
	<?php foreach($posts as $post): ?>
		<div class="card-panel white">
			<?php echo form_open('admin/answer/'.$post->id);?>
			
			<input type="hidden" name="id" value="<?php echo $post->id ?>" readonly>

			<div class="input-field">
				<label>Name</label>
				<input type="text" name="name" value="<?php echo $post->name ?>" readonly>
			</div>

			<label>Question</label>
			<textarea rows="16" cols="100%" name="question" class="materialize-textarea" readonly><?php echo $post->message ?></textarea>

			<label>Answer</label>
			<textarea rows="16" cols="100%" name="answer" class="materialize-textarea"><?php echo $post->answer ?></textarea>

			<div class="switch">
				<label>
					<input type="checkbox" name="tweet" value="1"  />
					<span class="lever"></span>
					Tweet?
				</label>
			</div>

			<input class="waves-effect waves-light btn red darken-4 red darken-4" type="submit" value="Submit"/>
			<input class="waves-effect waves-light btn red darken-4 red darken-4" type="reset" value="Reset"/>	

		</form>

	</div>
<?php endforeach; endif;?>