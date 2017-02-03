<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
</div>
<footer>
    <div class="container">
        <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
    </div>
</footer>
<script src="<?php echo site_url('assets/js/bootstrap.min.js');?>"></script>
<?php echo $before_closing_body;?>
<script>
    $('.login-form').on('submit', function(e)
    {
            $.ajax({
                url: "<?php echo site_url('admin/login');?>",
                type: 'post',
                data: {ajax: 1, username: username, password: password},
                cache: false,
                success: function (json) {
                    alert('sampai');
                    var error_message = json.error;
                    var success = json.logged_in;
                    console.log(json);
                    if (typeof error_message !== "undefined") {
                        alert(error_message);
                    }
                    else if (typeof success !== "undefined" && success == "1") {
                        $(".login-message").html("You've been successfully logged in!");
                        $(".login-form").hide();
                    }
                }
            });
        e.preventDefault();
    });
</script>
<script src="<?=base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/js/jquery.backstretch.min.js"></script>
<script>

jQuery(document).ready(function() {
    
    /*
        Fullscreen background
    */
    $.backstretch("<?=base_url();?>assets/img/backgrounds/1.jpg");
    
    /*
        Form validation
    */
    $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function() {
        $(this).removeClass('input-error');
    });
    
    $('.login-form').on('submit', function(e) {
        
        $(this).find('input[type="text"], input[type="password"], textarea').each(function(){
            if( $(this).val() == "" ) {
                e.preventDefault();
                $(this).addClass('input-error');
            }
            else {
                $(this).removeClass('input-error');
            }
        });
        
    });
    
    
});
</script>
</body>
</html>