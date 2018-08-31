<!DOCTYPE HTML>
<html>

<head>
    <title>
        <?= $title ?>
    </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="subject" content="Web Development">
    <meta name="url" content="https://hellolittlered.org/">
    <meta name="rating" content="General">
    <meta name="format-detection" content="telephone=no">

    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?= $title ?>" />
    <?php if($explanation) { ?>
    <meta property="og:description" content="<?= strip_tags($explanation) ?>" />
    <?php } ?>
    <?php if($image) { ?>
    <meta property="og:image" content="<?= $image ?>" />
    <?php } else { ?>
    <meta property="og:image" content="<?=base_url('assets/img/logo.jpg'); ?>">
    <?php } ?>

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@iarifiany">
    <meta name="twitter:creator" content="@iarifiany">
    <meta name="twitter:title" content="<?= $title ?>">
    <?php if($image) { ?>
    <meta name="twitter:image" content="<?= $image ?>">
    <?php } else { ?>
    <meta name="twitter:image" content="<?=base_url('assets/img/logo.jpg');?>">
    <?php } ?>


    <?php if($explanation) { ?>
    <meta name="twitter:description" content="<?= strip_tags($explanation); ?>">
    <?php } ?>

    <meta name="theme-color" content="#6d0000">
    <meta name="google-site-verification" content="R1AJmpriHPv9KnGMvbKBGg0lKXx7HRBbcNDeC9QUSZs" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/labjs/2.0.3/LAB.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
        crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro|Abril+Fatface|Roboto|Oswald|Poppins" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url('assets/css/base.css');?>" />
    <link rel="stylesheet" href="<?=base_url('assets/css/main.css');?>" />
    <link rel="icon" href="http://i.imgur.com/I6Udqo8.png" sizes="any" type="image/png">
    <?php $item = $this->site_model->get_data(); 
    foreach($item as $header): 
    if($keywords && $keywords != "") { ?>
    <meta name="keywords" content="<?= $keywords;?>">
    <?php } else {?>
    <meta name="keywords" content="<?= $header->keywords;?>">
    <?php } ?>
    <meta name="description" content="<?= $header->description;?>">
    <?php endforeach;?>
    <meta name="author" content="Ilma Arifiany">

</head>
<script>
    $LAB.script("https://code.jquery.com/jquery-3.1.1.min.js").wait().script("<?=base_url('assets/js/main.js');?>").script(
        "https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js?skin=sunburst").wait().script(
        "<?= base_url('application/views/'.$file.'.js') ?>").wait(function () {
        var exp = "";
        if (localStorage.getItem("lang") == "id") {
            exp = "<?= preg_replace( " / \r | \n / ", "
            ", str_replace("
            '", ' & apos;
            ', $explanation_id)); ?>";
            if (exp == "" || exp == null) exp = "<?= preg_replace( " / \r | \n / ", "
            ", str_replace("
            '", ' & apos;
            ', $explanation)); ?>";
        } else {
            exp = "<?= preg_replace( " / \r | \n / ", "
            ", str_replace("
            '", ' & apos;
            ', $explanation)); ?>";
            if (exp == "" || exp == null) exp = "<?= preg_replace( " / \r | \n / ", "
            ", str_replace("
            '", ' & apos;
            ', $explanation_id)); ?>";
        }

        document.querySelectorAll('#info h2 span').forEach(_element => _element.textContent =
            "<?= str_replace("
            ", "
            _ ", $current); ?>");
        document.querySelectorAll('#info p').forEach(_element2 => _element2.innerHTML = exp);
        $("pre, code").addClass("prettyprint");
    }).wait();
</script>

<body>

    <div class="popup" id="lang">
        <div id="popup">
            <div id="popup-content">
                <a class="fa close fa-times" aria-hidden="true" data-target="lang"></a>
                <h2>Switch Language</h2>
                <p>Website language will be changed. Please not that not all text will be translated, contents that are
                    only available in
                    one languange will be shown in that language.</p>
                <p>Bahasa akan diganti. Tidak semua teks akan terganti, konten yang hanya tersedia dalam satu bahasa
                    akan ditampilkan dalam
                    bahasa tersebut.</p>
                <center>
                    <a id="lang-yes" class="button button-inverse">Switch</a>
                    <a id="lang-no" class="button">Cancel</a>
                </center>
            </div>
        </div>
    </div>
    <a id="btt" class="fourth fade-in fadein">back to top</a>
    <div id="top" class="first fade-in topbottom"></div>
    <div id="bottom" class="third fade-in topbottom"></div>
    <div id="left" class="fourth right fade-in leftright"></div>
    <div id="right" class="second fade-in leftright"></div>

    <li class="menuTemp" style="display: none">
        <a>
            <span></span> <b></b>
        </a>
        <div>
        </div>
    </li>

    <div class="multimenu mmTemp" style="display: none">
        <a><span></span> <b></b></a>
        <div>
        </div>
    </div>

    <main class="fourth fade-in fadein">

        <div id="linkage">
            <ul id="main-menu">
            </ul>
        </div>

        <a id="mobile-menu" menu class="fa fa-bars" data-target="bigmenu"></a>

        <div id="bigmenu">
            <div id="uppermenu">
                <a class="fa close fa-times" aria-hidden="true" data-target="bigmenu"></a>
                <h3>
                    <span class="not">hello!</span>
                </h3>

                <div id="leftmenu">
                </div>
            </div>
            <div id="lowermenu">
                <h4>websites</h4>
                <?php 
                    $item = $this->look_model->get_websites(); 
                    foreach($item as $website): ?>
                <a href="<?= $website->link ?>">
                    <?= $website->name ?>
                </a>
                <?php endforeach;?>
            </div>
        </div>

        <div id="loader" class="lds-css ng-scope">
            <div style="width:100%;height:100%" class="lds-ripple">
                <div></div>
                <div></div>
            </div>

        </div>
        <div id="bg">
            <?php 
            if($current != null || $current != "") {
                if($current != "home") { ?>
            <div id="info">
                <h2>
                    <span class="not"></span>
                </h2>
                <br>
                <p></p>
                <span></span>
            </div>
            <?php } else { ?>
            <div id="description">
                <h1>Hello!</h1>
                <p></p>
                <div class="icons">
                    <a href="" class="fa fa-codepen"></a>
                    <a href="" class="fa fa-deviantart"></a>
                    <a href="" class="fa fa-facebook"></a>
                    <a href="" class="fa fa-flickr"></a>
                    <a href="" class="fa fa-instagram"></a>
                    <a href="" class="fa fa-linkedin"></a>
                    <a href="" class="fa fa-soundcloud"></a>
                    <a href="" class="fa fa-tumblr"></a>
                    <a href="" class="fa fa-twitter"></a>
                    <a href="" class="fa fa-youtube"></a>
                    <a href="" class="fa fa-behance"></a>
                    <a href="" class="fa fa-github"></a>
                </div>
            </div>
        </div>
        <?php }
        } ?>

        <div id="container">
