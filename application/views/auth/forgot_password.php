<h1>Forgot Password</h1>
<p>Please enter your email address so we can send you an email to reset your password.</p>

<div id="infoMessage"><?= $message;?></div>

<?= form_open("auth/forgot_password");?>

      <p>Email Address:<br />
      <?= form_input($email);?>
      </p>
      
      <p><?= form_submit('submit', 'Submit');?></p>
      
<?= form_close();?>