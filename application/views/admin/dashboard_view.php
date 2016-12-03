<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-header jumbotron">
 			<div id="user-area">
 			<?php
echo '<img src="//www.gravatar.com/avatar/'.$_SESSION['gravatar'].'?s=200" class="icon"/>';
?>
 			<div class="user-area">
	 			<h2 class="name" style="margin-bottom:15px">Welcome, <?php echo $user->first_name ?><?php echo $user->last_name ?></h2>
	 			<p><a href="profile" class="button">Update Your Profile</a>
	 			<a href="contacts" class="button">Check Emails</a>
	 			<a href="questions" class="button">Check Questions</a></p>
	 		</div>
	 	</div>
 		</div>
<div id="content">
 	<div class="row">
	  	<div class="col-lg-6 grid">
		        <h3>Update Site Information</h3>
	  		<div class="caption">
	  			<?php if( $site_data != '' ): foreach($site_data as $site): ?>
		     <?php echo form_open('admin/dashboard');?>
			
			<?php if(validation_errors()){echo validation_errors('<p class="error">','</p>');} ?>
            <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
			
			<p><label>Site Title</label><br>
			<input type="text" name="title"  style="display:block;width:100%"/ value="<?php echo $site->title ?>"></p>
			
			<p><label>Site Keywords</label><br>
			<input type="text" name="keywords" style="display:block;width:100%" value="<?php echo $site->keywords ?>"/></p>

			<p><label>Site Description</label><br>
			<textarea rows="36" cols="52%" name="description" style="resize:none;height:200px" id="textarea"><?php echo $site->description ?></textarea></p>
			
			<br />	
			
			<input class="button" type="submit" value="Submit"/>
			<input class="button" type="reset" value="Reset"/>	
			
			</form>
		<?php endforeach;endif; ?>
		    </div>
	    </div>
	  	<div class="col-lg-6 grid">
		    <h3>Latest Updates</h3>
	  		<ul class="caption">
		    <?php if( $updates != '' ): foreach($updates as $update): ?>
		    <li><b><?php echo $update->date ?>:</b> <?php echo $update->status ?></li>
		     <?php endforeach;endif; ?>
		    </ul>
	    </div>
	  	<div class="col-lg-6 grid">
		        <h3>My Twitter</h3>
	  		<div class="caption">
		        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
		        <p><a href="#" class="btn btn-primary" role="button">Add to Cart</a></p>
		    </div>
	    </div>
	  	<div class="col-lg-12">
		        <h3>User Statistics</h3>
	  		<div class="caption">
		        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
		        <p><a href="#" class="btn btn-primary" role="button">Add to Cart</a></p>
		    </div>
	    </div>
	  	<div class="col-lg-12">
		        <h3>Referals</h3>
	  		<div class="caption">
		        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
		        <p><a href="#" class="btn btn-primary" role="button">Add to Cart</a></p>
		    </div>
	    </div>
  	</div>