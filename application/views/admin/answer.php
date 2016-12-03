
	<!-- content starts -->
	<div class="container" style="margin-top:60px;">
  	<div class="row">
			<?php if( $posts ): ?>
			<?php foreach($posts as $post): ?>
			<h2>Edit Entry</h2>
			<?php echo form_open('admin/answer/'.$post->id);?>

			<?php if(validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
            <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
			
			
			<p><label>ID</label><br>
			<input type="text" name="id" style="display:block;width:100%"/ value="<?php echo $post->id ?>" readonly></p>

			<p><label>Name</label><br>
			<input type="text" name="name" style="display:block;width:100%"/ value="<?php echo $post->name ?>" readonly></p>
			
			<p><label>Question</label><br>
			<textarea rows="16" cols="100%" name="question" style="height:100px" readonly><?php echo $post->message ?></textarea></p>
			
			<p><label>Answer</label><br>
			<textarea rows="16" cols="100%" name="answer" style="height:100px"><?php echo $post->answer ?></textarea></p>
			
			<br />	
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>
			<?php endforeach; endif;?>
			
	</div>
</div>