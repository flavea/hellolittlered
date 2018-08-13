<!DOCTYPE HTML>
<html>
    <head>
        <title><?= $title ?></title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="<?=base_url();?>main-assets/css/others.css" />
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <?php $item = $this->site_model->get_data(); 
        foreach($item as $header): ?>
        <meta name="keywords" content="<?= $header->keywords;?>">
        <meta name="description" content="<?= $header->description;?>">
        <?php endforeach;?>
        <meta name="author" content="Ilma Arifiany">
        <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed" rel="stylesheet">
    </head>
    <script>
    function goBack() {
        window.history.back();
    }
    </script>
    <body>
        <div id="message">
            <div id="mssg">
                <h1>Page not Found</h1>
                The page you're looking for appears to have been moved, deleted, or simply doesn't exist.

                <p><a onclick="goBack()" href="#">Go back to previous page</a>
                <a href="/">go to the homepage</a>

            </div>
            <div id="social">
                Get in touch:
                                <?php 
                                    $item = $this->look_model->get_socmeds(); 
                                    
                                    foreach($item as $socmed): ?>
                                        
                                        <?php if($socmed->facebook != '') { ?>
                                        <a href="<?= $socmed->facebook ?>" class="fa fa-facebook"></a>
                                        <?php } ?>
                                        <?php if($socmed->flickr != '') { ?>
                                        <a href="<?= $socmed->flickr ?>" class="fa fa-flickr"></a>
                                        <?php } ?>
                                        <?php if($socmed->instagram != '') { ?>
                                        <a href="<?= $socmed->instagram ?>" class="fa fa-instagram"></a>
                                        <?php } ?>
                                        <?php if($socmed->linkedin != '') { ?>
                                        <a href="<?= $socmed->linkedin ?>" class="fa fa-linkedin"></a>
                                        <?php } ?>
                                        <?php if($socmed->tumblr != '') { ?>
                                        <a href="<?= $socmed->tumblr ?>" class="fa fa-tumblr"></a>
                                        <?php } ?>
                                        <?php if($socmed->twitter != '') { ?>
                                        <a href="<?= $socmed->twitter ?>" class="fa fa-twitter"></a>
                                        <?php } ?>
                                        <?php if($socmed->youtube != '') { ?>
                                        <a href="<?= $socmed->youtube ?>" class="fa fa-youtube"></a>
                                        <?php } ?>
                                    <?php endforeach; ?>
            </div>
        </div>
    </body>
    </html>