
<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo $title ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="subject" content="Web Development">
    <meta name="url" content="https://hellolittlered.org/">
    <meta name="rating" content="General">
    <meta name="format-detection" content="telephone=no">

    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php echo $title ?>" />
    <?php if($explanation) { ?>
    <meta property="og:description" content="<?php echo $explanation ?>" />
    <?php } ?>
    <?php if($image) { ?>
    <meta property="og:image" content="<?php echo $image ?>" />
    <?php } else { ?>
    <meta property="og:image" content="<?=base_url();?>main-assets/img/logo.jpg ?>">
    <?php } ?>


    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@_hellolittlered">
    <meta name="twitter:creator" content="@_hellolittlered">
    <meta name="twitter:title" content="<?php echo $title ?>">
    <?php if($image) { ?>
    <meta name="twitter:image" content="<?php echo $image ?>">
    <?php } else { ?>
    <meta name="twitter:image" content="<?=base_url();?>main-assets/img/logo.jpg ?>">
    <?php } ?>


    <?php if($explanation) { ?>
    <meta name="twitter:description" content="<?php echo $explanation; ?>">
    <?php } ?>

    <meta name="theme-color" content="#facac0">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.8-fix/jquery.nicescroll.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro|Abril+Fatface|Roboto|Oswald" rel="stylesheet">
    <script src="<?=base_url();?>main-assets/js/main.js"></script>
    <script src="<?=base_url();?>main-assets/js/shuffletext.jquery.min.js"></script>
    <script src="<?=base_url();?>main-assets/js/modernizer.min.js"></script>
    <link rel="stylesheet" href="<?=base_url();?>main-assets/css/foundation.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>main-assets/css/main.css" />
    <link rel="icon" href="<?=base_url();?>main-assets/img/logo.jpg" sizes="any" type="image/jpg">
    <?php $item = $this->site_model->get_data(); 
    foreach($item as $header): ?>
    <meta name="keywords" content="<?php echo $header->keywords;?>">
    <meta name="description" content="<?php echo $header->description;?>">
<?php endforeach;?>
<meta name="author" content="Ilma Arifiany">

</head>

<script>

$(document).ready(

    function() { 

        $('#info h2 span').ShuffleText([
            'Wait...',
            "Loading...",
            "Loaded!",
            "<?php echo $current; ?>"
            ],{loop: false, delay: 1600});
        $('#info p').ShuffleText([
            'Wait...',
            "Loading...",
            "Loaded!",
            "<?php echo $explanation; ?>"
            ],{loop: false, delay: 1600});


    }

    );
</script>
<body>

    <a id="btt" href="#" class="fourth fade-in fadein">back to top</a>
    <div id="top" class="first fade-in topbottom"></div>
    <div id="bottom" class="third fade-in topbottom"></div>
    <div id="left" class="fourth right fade-in leftright"></div>
    <div id="right" class="second fade-in leftright"></div>
    <main class="fourth fade-in fadein">

        <div id="linkage">
            <ul id="main-menu">
                <li><a href="<?=base_url()?>"><span>01</span> Home</a></li>
                <li><a data-target="about"><span>02</span> About</a>
                    <div id="about">
                        <a href="<?=base_url()?>p/aboutblog"><span>a.</span> About The Blog</a>
                        <a href="<?=base_url()?>p/aboutme"><span>b.</span> About The Owner</a>
                    </div>
                </li>
                <li><a href="<?=base_url()?>blog"><span>03</span> Blog</a></li>
                <li>
                    <a data-target="codes"><span>04</span> Codes</a>
                    <div id="codes">
                        <a href="<?=base_url()?>projects"><span>a.</span> Projects</a>
                        <a href="<?=base_url()?>themes/template"><span>b.</span> Templates</a>
                        <a href="<?=base_url()?>themes/tumblr"><span>c.</span> Tumblr Themes</a>
                        <a href="<?=base_url()?>themes/wordpress"><span>d.</span> Wordpress Themes</a>
                        <a href="<?=base_url()?>themes/zetaboards"><span>e.</span> Zetaboards Themes</a>
                        <a href="<?=base_url()?>themes/BaseCodes"><span>f.</span> Base Codes</a>
                    </div>
                </li>
                <li>
                    <a data-target="resources"><span>05</span> Resources</a>
                    <div id="resources">
                        <a href="<?=base_url()?>resource/psd"><span>a.</span> PSD</a>
                        <a href="<?=base_url()?>resource/textures"><span>b.</span> Textures</a>
                        <a href="<?=base_url()?>resource/fonts"><span>c.</span> Fonts</a>
                    </div>
                </li>
                <li><a data-target="hobbies"><span>06</span> Hobbies</a>
                    <div id="hobbies">
                        <a href="<?=base_url()?>album"><span>a.</span> Photography</a>
                        <a href="<?=base_url()?>writing"><span>b.</span> Writing</a>
                        <a href="<?=base_url()?>graphics"><span>c.</span> Graphics</a>
                    </div>
                </li>
                <li><a href="<?=base_url()?>shop"><span>07</span> Shop</a></li>
                <li><a data-target="contact"><span>08</span> Contact</a>
                    <div id="contact">
                        <a href="<?=base_url()?>contact"><span>a.</span> Email</a>
                        <a href="<?=base_url()?>contact/p"><span>b.</span> Simple Questions</a>
                        <a href="<?=base_url()?>commission"><span>c.</span> Commission</a>
                    </div>
                </li>
            </ul>
        </div>

        <a id="mobile-menu" menu class="fa fa-bars"></a>

        <div id="bigmenu">
            <div id="uppermenu">
                <a class="fa close fa-times" aria-hidden="true"></a>
                <h3><span>hello,</span> little red</h3>

                <div id="leftmenu">
                    <a href="<?=base_url()?>"><span>01.</span> Home</a>
                    <div class="multimenu">
                        <a><span>02.</span> About</a>
                        <div>
                            <a href="<?=base_url()?>p/aboutblog"><span>a.</span> About The Blog</a>
                            <a href="<?=base_url()?>p/aboutme"><span>b.</span> About The Owner</a>
                        </div>
                    </div>
                    <a href="<?=base_url()?>blog"><span>03.</span> Blog</a>

                    <div class="multimenu">
                        <a><span>04.</span> Codes</a>
                        <div>
                            <a href="<?=base_url()?>projects"><span>a.</span> Projects</a>
                            <a href="<?=base_url()?>themes/template"><span>b.</span> Templates</a>
                            <a href="<?=base_url()?>themes/tumblr"><span>c.</span> Tumblr Themes</a>
                            <a href="<?=base_url()?>themes/wordpress"><span>d.</span> Wordpress Themes</a>
                            <a href="<?=base_url()?>themes/zetaboards"><span>e.</span> Zetaboards Themes</a>
                            <a href="<?=base_url()?>themes/BaseCodes"><span>f.</span> Base Codes</a>
                        </div>
                    </div>
                    <div class="multimenu">
                        <a><span>05.</span> Resources</a>
                        <div>
                            <a href="<?=base_url()?>resource/psd"><span>a.</span> PSD</a>
                            <a href="<?=base_url()?>resource/textures"><span>b.</span> Textures</a>
                            <a href="<?=base_url()?>resource/fonts"><span>c.</span> Fonts</a>
                        </div>
                    </div>
                    <div class="multimenu">
                        <a><span>06.</span> Hobbies</a>
                        <div>
                            <a href="<?=base_url()?>album"><span>a.</span> Photography</a>
                            <a href="<?=base_url()?>writing"><span>b.</span> Writing</a>
                            <a href="<?=base_url()?>graphics"><span>c.</span> Graphics</a>
                        </div>

                    </div>
                    <a data-target="shop"><span>07.</span> Shop</a>
                    <div class="multimenu">
                        <a data-target="contact"><span>08.</span> Contact</a>
                        <div>
                            <a href="<?=base_url()?>contact"><span>a.</span> Email</a>
                            <a href="<?=base_url()?>contact/p"><span>b.</span> Simple Questions</a>
                            <a href="<?=base_url()?>commission"><span>c.</span> Commission</a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="lowermenu">
                <h4>websites</h4>
                <?php 
                $item = $this->look_model->get_websites(); 
                foreach($item as $website): ?>
                <a href="<?php echo $website->link ?>"><?php echo $website->name ?></a>
            <?php endforeach;?>
        </div>
    </div>


    <div id="bg">
        <?php 
        if($current != null || $current != "") {
            if($current != "home") { ?>
            <div id="info">
                <h2><span></span></h2><br>
                <p></p>
                <span></span>
            </div>
            <?php } else { ?>
            <div id="description">
                <?php 
                $item = $this->site_model->get_data(); 
                foreach($item as $header): ?>
                <h1>Hello,<br>Little Red</h1>
                <p><?php echo $header->description; 
                endforeach;?>
                <div class="icons">
                    <?php 
                    $item = $this->look_model->get_socmeds(); 

                    foreach($item as $socmed): ?>
                    <?php if($socmed->codepen != '') { ?>
                    <a href="<?php echo $socmed->codepen ?>" class="fa fa-codepen"></a>
                    <?php } ?>
                    <?php if($socmed->deviantart != '') { ?>
                    <a href="<?php echo $socmed->deviantart ?>" class="fa fa-deviantart"></a>
                    <?php } ?>
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
                    <?php if($socmed->soundcloud != '') { ?>
                    <a href="<?php echo $socmed->soundcloud ?>" class="fa fa-soundcloud"></a>
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
                    <?php if($socmed->behance != '') { ?>
                    <a href="<?php echo $socmed->behance ?>" class="fa fa-behance"></a>
                    <?php } ?>
                    <?php if($socmed->github != '') { ?>
                    <a href="<?php echo $socmed->github ?>" class="fa fa-github"></a>
                    <?php } ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php }
} ?>