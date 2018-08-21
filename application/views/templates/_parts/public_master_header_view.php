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
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
        crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro|Abril+Fatface|Roboto|Oswald|Poppins" rel="stylesheet">
    <script src="<?=base_url('assets/js/main.js');?>"></script>
    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js?skin=sunburst"></script>
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
    $(document).ready(function () {
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

        $('#info h2 span').text("<?= $current; ?>");
        $('#info p').html(exp);
    });
</script>

<body>

    <div class="popup" id="lang">
        <div id="popup">
            <div id="popup-content">
                <a class="fa close fa-times" aria-hidden="true" data-target="lang"></a>
                <h2>Switch Language</h2>
                <p>Website language will be changed. Please not that not all text will be translated, contents that are only available in
                    one languange will be shown in that language.</p>
                <p>Bahasa akan diganti. Tidak semua teks akan terganti, konten yang hanya tersedia dalam satu bahasa akan ditampilkan dalam
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
    <main class="fourth fade-in fadein">

        <div id="linkage">
            <ul id="main-menu">
                <li>
                    <a href="<?=base_url()?>">
                        <span>01</span> Home</a>
                </li>
                <li>
                    <a data-target="about">
                        <span>02</span> About</a>
                    <div id="about">
                        <article class="menu-pages"></article>
                        <?php if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) { ?>
                        <a href="<?=base_url('pages/add_new_page');?>">Add New Page</a>
                        <a href="<?=base_url('pages/manage_pages');?>">Manage Pages</a>
                        <?php } ?>
                    </div>
                </li>
                <li>
                    <a href="<?=base_url('blog')?>">
                        <span>03</span> Blog</a>
                </li>
                <li>
                    <a data-target="codes">
                        <span>04</span> Codes</a>
                    <div id="codes">
                        <a href="<?=base_url('projects')?>">
                            <span>a.</span> Projects</a>
                        <a href="<?=base_url('lab')?>">
                            <span>b.</span> Lab</a>

                        <article class="menu-codes"></article>

                        <?php if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) { ?>
                        <a href="<?=base_url('projects/projects');?>">Manage Projects</a>
                        <a href="<?=base_url('lab/lab');?>">Manage Lab</a>
                        <a href="<?=base_url('themes/add_new_theme');?>">Add New Theme</a>
                        <a href="<?=base_url('themes/add_new_theme_category');?>">Manage Themes Category</a>
                        <?php } ?>
                    </div>
                </li>
                <li>
                    <a data-target="resources">
                        <span>05</span> Resources</a>
                    <div id="resources">
                        <a href="<?=base_url('resource/psd')?>">
                            <span>a.</span> PSD</a>
                        <a href="<?=base_url('resource/textures')?>">
                            <span>b.</span> Textures</a>
                        <?php if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) { ?>
                        <a href="<?=base_url('resource/add_new_resource');?>">Add New Resource</a>
                        <a href="<?=base_url('resource/manage_resources');?>">Manage Resources</a>
                        <a href="<?=base_url('resource/add_new_resource_type');?>">Manage Resources Type</a>
                        <?php } ?>
                    </div>
                </li>
                <li>
                    <a data-target="hobbies">
                        <span>06</span> Hobbies</a>
                    <div id="hobbies">
                        <a href="<?=base_url('album')?>">
                            <span>a.</span> Photography</a>
                        <a href="https://fictions.hellolittlered.org">
                            <span>b.</span> Writing</a>
                        <a href="<?=base_url('graphics')?>">
                            <span>c.</span> Graphics</a>
                        <?php if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) { ?>
                        <a href="<?=base_url('graphics/design');?>">Manage Designs</a>
                        <?php } ?>
                    </div>
                </li>
                <li>
                    <a href="<?=base_url('shop')?>">
                        <span>08</span> Shop</a>
                </li>
                <li>
                    <a data-target="contact">
                        <span>09</span> Contact</a>
                    <div id="contact">
                        <a href="<?=base_url('contact')?>">
                            <span>a.</span> Email</a>
                        <a href="<?=base_url('friends')?>">
                            <span>b.</span> Affiliates</a>
                        <a href="<?=base_url('commission')?>">
                            <span>c.</span> Commission</a>
                        <?php if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) { ?>
                        <a href="<?=base_url('admin/commissions');?>">Manage Commissions (
                            <?= $commissions_count; ?>)</a>
                        <a href="<?=base_url('admin/questions');?>">Manage Questions (
                            <?= $q_count; ?>)</a>
                        <a href="<?=base_url('admin/contacts');?>">Manage Emails (
                            <?= $emails_count; ?>)</a>
                        <?php } ?>
                    </div>
                </li>
                <?php if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) { ?>
                <li>
                    <a data-target="mng">
                        <span>10</span> Management</a>
                    <div id="mng">
                        <a href="<?=base_url('admin/socmeds');?>">Social Medias</a>
                        <a href="<?=base_url('admin/sidebar');?>">Sidebar Boxes</a>
                        <a href="<?=base_url('admin/website');?>">Websites</a>
                        <a href="<?=base_url('admin/friends');?>">Friends (
                            <?= $friends_count; ?>)</a>
                        <a href="<?=base_url('admin/history');?>">History</a>
                        <a href="<?=base_url('admin/profile');?>">Edit Profile</a>
                        <a href="<?=base_url('admin/logout');?>">Log Out</a>
                    </div>
                </li>
                <?php } ?>
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
                    <a href="<?=base_url()?>">
                        <span>01.</span> Home</a>
                    <div class="multimenu">
                        <a>
                            <span>02.</span> About</a>
                        <div class="menu-pages">
                        </div>
                    </div>
                    <a href="<?=base_url('blog')?>">
                        <span>03.</span> Blog</a>

                    <div class="multimenu">
                        <a>
                            <span>04.</span> Codes</a>
                        <div class="menu-codes">
                            <a href="<?=base_url('projects')?>">
                                <span>a.</span> Projects</a>
                            <a href="<?=base_url('lab')?>">
                                <span>b.</span> Lab</a>
                        </div>
                    </div>
                    <div class="multimenu">
                        <a>
                            <span>05.</span> Resources</a>
                        <div>
                            <a href="<?=base_url('resource/psd')?>">
                                <span>a.</span> PSD</a>
                            <a href="<?=base_url('resource/textures')?>">
                                <span>b.</span> Textures</a>
                        </div>
                    </div>
                    <div class="multimenu">
                        <a>
                            <span>06.</span> Hobbies</a>
                        <div>
                            <a href="<?=base_url('album')?>">
                                <span>a.</span> Photography</a>
                            <a href="<?=base_url('writing')?>">
                                <span>b.</span> Writing</a>
                            <a href="<?=base_url('graphics')?>">
                                <span>c.</span> Graphics</a>
                        </div>

                    </div>
                    <!--<a data-target="shop"><span>07.</span> Shop</a>-->
                    <div class="multimenu">
                        <a data-target="contact">
                            <span>07.</span> Contact</a>
                        <div>
                            <a href="<?=base_url('contact')?>">
                                <span>a.</span> Email</a>
                            <a href="<?=base_url('friends')?>">
                                <span>b.</span> Affiliates</a>
                            <a href="<?=base_url('commission')?>">
                                <span>c.</span> Commission</a>
                        </div>
                    </div>
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
