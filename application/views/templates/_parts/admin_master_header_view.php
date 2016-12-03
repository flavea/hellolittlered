<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $page_title;?></title>
    <meta name="description" value="<?php echo $page_description;?>" />
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="<?=base_url();?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/form-elements.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/style.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/style2.css">
    <?php echo $before_closing_head;?>
</head>
<body>
    <?php
        if($this->ion_auth->logged_in()) {
    ?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?=base_url();?>admin/dashboard">Hello Little Red</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blogs<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=base_url();?>admin/add_new_entry">Add New Post</a></li>
            <li><a href="<?=base_url();?>admin/manage_posts">Manage Posts</a></li>
            <li><a href="<?=base_url();?>admin/add_new_category">Manage Categories</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=base_url();?>admin/add_new_page">Add New Page</a></li>
            <li><a href="<?=base_url();?>admin/manage_pages">Manage Pages</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Themes<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=base_url();?>admin/add_new_theme">Add New Theme</a></li>
            <li><a href="<?=base_url();?>admin/manage_themes">Manage Themes</a></li>
            <li><a href="<?=base_url();?>admin/add_new_theme_category">Manage Themes Category</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Resources<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=base_url();?>admin/add_new_resource">Add New Resource</a></li>
            <li><a href="<?=base_url();?>admin/manage_resources">Manage Resources</a></li>
            <li><a href="<?=base_url();?>admin/add_new_resource_type">Manage Resources Type</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Site<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=base_url();?>admin/socmeds">Social Medias</a></li>
            <li><a href="<?=base_url();?>admin/sidebar">Sidebar Boxes</a></li>
            <li><a href="<?=base_url();?>admin/header">Header Images</a></li>
            <li><a href="<?=base_url();?>admin/website">Websites</a></li>
          </ul>
        </li>
        <li><a href="<?=base_url();?>admin/add_new_photo_album">Photos</a></li>
        <li><a href="<?=base_url();?>admin/design">Designs</a></li>
        <li><a href="<?=base_url();?>admin/writing">Writing</a></li>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contacts<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=base_url();?>admin/commissions">Commissions</a></li>
            <li><a href="<?=base_url();?>admin/contacts">Emails</a></li>
            <li><a href="<?=base_url();?>admin/questions">Questions</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello, <?php echo $user->first_name ?><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=base_url();?>admin/profile">Edit Profile</a></li>
            <li><a href="<?php echo site_url('admin/logout');?>">Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?php
}?>