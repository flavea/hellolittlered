<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo $title ?></title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="<?=base_url();?>main-assets/css/main.css" />
        <link rel="icon" href="<?=base_url();?>img/logo.jpg" sizes="any" type="image/jpg">
        <?php $item = $this->site_model->get_data(); 
        foreach($item as $header): ?>
        <meta name="keywords" content="<?php echo $header->keywords;?>">
        <meta name="description" content="<?php echo $header->description;?>">
        <?php endforeach;?>
        <meta name="author" content="Ilma Arifiany">
    </head>
    <script type="text/javascript" src="http://hellolittlered.org/assets/js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
	tinymce.init({
	    selector: "#textarea",
	    height:200,
	plugins: [
	    "advlist autolink lists link image charmap print preview anchor",
	    "searchreplace visualblocks code fullscreen",
	    "insertdatetime media table contextmenu paste "
	],
	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter      alignright alignjustify | bullist numlist outdent indent | link image"
	});
	</script>
    <script id="dsq-count-scr" src="//hellolittlered.disqus.com/count.js" async></script>
    <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-44755840-1', 'auto');
	  ga('send', 'pageview');
	
	</script>
    <body>

        <!-- Wrapper -->
        <?php if ($pagetitle != ''): ?>

        <article class="header">
        <section >
                <?php 
                $item = $this->look_model->get_headers(); 
                foreach($item as $header): ?>
                <img src="<?php echo $header->link;?>">
                <?php endforeach;?>
        </section>
        <section class="post" style="padding-top:40px">
        <h2><center><?php echo $pagetitle; ?></center></h2>
        </section>
        </article>

        <?php endif; ?>
        <div id="wrapper">

                <!-- Header -->
                    <header id="header">
                        <h1><a href="<?=base_url()?>">Hello Little Red</a></h1>
                        <nav class="links">
                            <ul>
                                <li><a href="<?=base_url()?>p/about">About</a></li>
                                <li><a href="<?=base_url()?>blog">Blog</a></li>
                                <li><a href="<?=base_url()?>writing">Writing</a></li>
                                <li>
                                    <div class="dropdown">
                                      <a class="dropbtn" >Themes</a>
                                      <div class="dropdown-content">
                                        <?php 
                                        $item = $this->site_model->get_themes_categories(); 
                                        foreach($item as $category): ?>
                                        <a href="<?=base_url()?>themes/<?php echo $category->slug;?>"><?php echo $category->category_name;?></a>
                                        <?php endforeach;?>
                                      </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown">
                                      <a class="dropbtn" >Resources</a>
                                      <div class="dropdown-content">
                                        <?php 
                                        $item = $this->site_model->get_resources_types(); 
                                        foreach($item as $category): ?>
                                        <a href="<?=base_url()?>resource/<?php echo $category->type_slug;?>"><?php echo $category->type_name;?></a>
                                        <?php endforeach;?>
                                      </div>
                                    </div>
                                </li>
                                <li><a href="<?=base_url()?>album">Photos</a></li>
                                <li>
                                    <div class="dropdown">
                                      <a class="dropbtn">Shop</a>
                                      <div class="dropdown-content">
                                        <a href="<?=base_url()?>shop">Phone Cases, ETC</a>
                                        <a href="<?=base_url()?>commission">Commissions</a>
                                      </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown">
                                      <a class="dropbtn" >Contact</a>
                                      <div class="dropdown-content">
                                        <a href="<?=base_url()?>contact">Email Me</a>
                                        <a href="<?=base_url()?>contact/q">Ask Questions</a>
                                      </div>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <nav class="main">
                            <ul>
                                <li class="search">
                                    <a class="fa-search" href="#search">Search</a>
                                    <form id="search" method="get" action="<?php echo base_url().'search/' ?>">
                                        <input type="text" name="query" placeholder="Search" />
                                    </form>
                                </li>
                                <li class="menu">
                                    <a class="fa-bars" href="#menu">Menu</a>
                                </li>
                            </ul>
                        </nav>
                    </header>

                <!-- Menu -->
                    <section id="menu">

                        <!-- Search -->
                            <section>
                                <form class="search" method="get" action="#">
                                    <input type="text" name="query" placeholder="Search" />
                                </form>
                            </section>

                        <!-- Links -->
                            <section>
                                <ul class="links">
                                    <li><h3><a href="<?=base_url()?>page/about">About</a></h3></li>
                                    <li><h3><a href="<?=base_url()?>blog">Blog</a></h3></li>
                                    <li><h3><a href="<?=base_url()?>writing">Writing</a></h3></li>
                                    <li><h3><a href="<?=base_url()?>themes">Themes</a></h3></li>
                                    <li><h3><a href="<?=base_url()?>resource">Resources</a></h3></li>
                                    <li><h3><a href="<?=base_url()?>album">Photos</a></h3></li>
                                    <li><h3><a href="<?=base_url()?>shop">Buy Phone Cases, ETC</a></h3></li>
                                    <li><h3><a href="<?=base_url()?>commission">Commissions</a></h3></li>
                                    <li><h3><a href="<?=base_url()?>contact">Email Me</a></h3></li>
                                    <li><h3><a href="<?=base_url()?>contact/q">Ask Questions</a></h3></li>
                                </ul>
                            </section>

                    </section>

                <!-- Main -->
                    
                    <div id="main">