<!DOCTYPE HTML>
<html>
    <head>
        <title>Hello Little Red</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="http://hellolittlered.org/main-assets/css/others.css" />
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <meta name="author" content="Ilma Arifiany">
        <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed" rel="stylesheet">
    </head>
    <body>
        <div id="message">
            <div id="mssg">
                <h1>Under Construction</h1>
                We are working on our new web site and will be on-line again soon.
            </div>
            
            <div id="social">
                Get in touch:
                                <?php 
                                    $item = $this->look_model->get_socmeds(); 
                                    
                                    foreach($item as $socmed): ?>
                                        
                                        <?php if($socmed->facebook != '') { ?>
                                        <a href="<?php echo $socmed->facebook ?>" class="fa fa-facebook"></a>
                                        <?php } ?>
                                        <?php if($socmed->flickr != '') { ?>
                                        <a href="<?php echo $socmed->flickr ?>" class="fa fa-flickr"></a>
                                        <?php } ?>
                                        <?php if($socmed->instagram != '') { ?>
                                        <a href="<?php echo $socmed->instagram ?>" class="fa fa-instagram"></a>
                                        <?php } ?>
                                        <?php if($socmed->linkedin != '') { ?>
                                        <a href="<?php echo $socmed->linkedin ?>" class="fa fa-linkedin"></a>
                                        <?php } ?>
                                        <?php if($socmed->tumblr != '') { ?>
                                        <a href="<?php echo $socmed->tumblr ?>" class="fa fa-tumblr"></a>
                                        <?php } ?>
                                        <?php if($socmed->twitter != '') { ?>
                                        <a href="<?php echo $socmed->twitter ?>" class="fa fa-twitter"></a>
                                        <?php } ?>
                                        <?php if($socmed->youtube != '') { ?>
                                        <a href="<?php echo $socmed->youtube ?>" class="fa fa-youtube"></a>
                                        <?php } ?>
                                    <?php endforeach; ?>
            </div>
            
        </div>
    </body>
    </html>