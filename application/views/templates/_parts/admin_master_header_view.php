<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo $page_title;?></title>
  <meta name="description" value="<?php echo $page_description;?>" />
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
  <link rel="stylesheet" href="<?=base_url();?>assets/css/style.css">
  <link rel="icon" href="http://i.imgur.com/I6Udqo8.png" sizes="any" type="image/png">
  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.1.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>

  <?php echo $before_closing_head;?>
</head>
<script>
  $(document).ready(function() {
    $(".dropdown-button").dropdown();
    $('.collapsible').collapsible();
    $('.sub-collapsible').collapsible();
    $('select').material_select();
    $(".notif").sideNav({
      menuWidth: 300,
      edge: 'right',
      closeOnClick: true,
      draggable: true
    }
    );

    $('.button-collapse').sideNav({
      menuWidth: 300,
      edge: 'left', // Choose the horizontal origin
      draggable: true
    }
    );

    <?php if(validation_errors()){ ?>
      Materialize.toast('<?php echo validation_errors(); ?>', 4000);
      <?php } ?>
      <?php if($this->session->flashdata('message')){ ?>
        Materialize.toast('<?php echo $this->session->flashdata('message'); ?>', 4000);
        <?php } ?>
      });
    </script>
    <body>
      <?php
      if($this->ion_auth->logged_in()) {
        ?>
      </div>
      <ul id="nav-mobile" class="side-nav fixed grey darken-3">
        <li><div class="userView">
          <div class="background">
            <img src="http://i.imgur.com/gtvDjAX.jpg" width="100%">
          </div>
          <?php
          echo '<img src="//www.gravatar.com/avatar/'.$_SESSION['gravatar'].'?s=200" class="circle"/>';
          ?></a>

          <ul id="profile-dropdown" class="dropdown-content">
            <li><a href="<?=base_url();?>admin/profile">Edit Profile</a></li>
            <li><a href="<?php echo site_url('admin/logout');?>">Log Out</a></li>
          </ul>
          <a class="dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><span class="white-text name"><?php echo $user->first_name ?><?php echo $user->last_name ?><i class="material-icons right">arrow_drop_down</i></span></a>
          <span class="white-text email"><?php echo $user->email ?></span>
        </div></li>
        <ul class="collapsible" data-collapsible="accordion">
          <li>
            <div class="collapsible-header waves-effect waves-teal white-text"><i class="material-icons">view_list</i>Blog</div>
            <div class="collapsible-body">
              <ul class="submenu">
                <li><a href="<?=base_url();?>admin/add_new_entry">Add New Post</a></li>
                <li><a href="<?=base_url();?>admin/manage_posts">Manage Posts</a></li>
                <li><a href="<?=base_url();?>admin/add_new_category">Manage Categories</a></li>
              </ul>
            </div>
          </li>
          <li>
            <div class="collapsible-header waves-effect waves-teal white-text"><i class="material-icons">pages</i>Pages</div>
            <div class="collapsible-body">
              <ul class="submenu">
                <li><a href="<?=base_url();?>admin/add_new_page">Add New Page</a></li>
                <li><a href="<?=base_url();?>admin/manage_pages">Manage Pages</a></li>
              </ul>
            </div>
          </li>
          <li>

          <div class="collapsible-header waves-effect waves-teal white-text"><i class="material-icons">code</i>Codes</div>
            <div class="collapsible-body">
              <ul class="sub-collapsible" data-collapsible="accordion">

                <li><a href="<?=base_url();?>admin/projects">Projects</a></li>

                <li><a href="<?=base_url();?>admin/lab">Lab</a></li>
              </ul>
            </div>
          </li>
          <li>
            <div class="collapsible-header waves-effect waves-teal white-text"><i class="material-icons">perm_media</i>Themes</div>
            <div class="collapsible-body">
              <ul class="sub-collapsible" data-collapsible="accordion">
                <li><a href="<?=base_url();?>admin/add_new_theme">Add New Theme</a></li>
                <li>
                  <div class="collapsible-header waves-effect waves-teal"><i class="material-icons">view_list</i>Manage Themes</div>
                  <div class="collapsible-body">
                    <ul>
                      <?php if( $theme_categories != '' ): foreach($theme_categories as $cat): ?>

                        <li><a class="teal-text text-lighten-2" href="<?=base_url();?>admin/manage_themes/<?php echo $cat->slug; ?>"><?php echo $cat->category_name;?></a></li>
                      <?php endforeach;endif; ?>
                    </ul>
                  </div>
                </li>
                <li><a href="<?=base_url();?>admin/add_new_theme_category">Manage Themes Category</a></li>
              </ul>
            </div>
          </li>
          <li>
            <div class="collapsible-header waves-effect waves-teal white-text"><i class="material-icons">brush</i>Resources</div>
            <div class="collapsible-body">
              <ul class="submenu">
                <li><a href="<?=base_url();?>admin/add_new_resource">Add New Resource</a></li>
                <li><a href="<?=base_url();?>admin/manage_resources">Manage Resources</a></li>
                <li><a href="<?=base_url();?>admin/add_new_resource_type">Manage Resources Type</a></li>
              </ul>
            </div>
          </li>
          <li>
            <div class="collapsible-header waves-effect waves-teal white-text"><i class="material-icons">http</i>Website</div>
            <div class="collapsible-body">
              <ul class="submenu">
                <li><a href="<?=base_url();?>admin/socmeds">Social Medias</a></li>
                <li><a href="<?=base_url();?>admin/sidebar">Sidebar Boxes</a></li>
                <li><a href="<?=base_url();?>admin/website">Websites</a></li>
                <li class="hide-on-large-only"><a href="<?=base_url();?>admin/friends">Friends</a></li>
                <li class="hide-on-large-only"><a href="<?=base_url();?>admin/history">History</a></li>
              </ul>
            </div>
          </li>
          <li>
            <div class="collapsible-header waves-effect waves-teal white-text"><i class="material-icons">grade</i>Hobbies</div>
            <div class="collapsible-body">
              <ul class="submenu">
                <li><a href="<?=base_url();?>admin/design">Designs</a></li>
                <li><a href="<?=base_url();?>admin/writing">Writing</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </ul>

      <div class="navbar-fixed">
        <nav class="red accent-4">
          <div class="nav-wrapper">
            <ul class="left">
              <li><a href="#" data-activates="nav-mobile" class="button-collapse top-nav full hide-on-large-only"><i class="material-icons">menu</i></a></li>
              <li class="hide-on-med-and-down"><a href="<?=base_url();?>" class="brand-logo">Hello Little Red</a></li>
            </ul>

            <ul class="right">
              <li><a href="<?=base_url();?>/admin/dashboard" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Back to Dashboard"><i class="material-icons mouse">mouse</i></a></li>


              <li class="hide-on-med-and-down"><a href="<?=base_url();?>admin/friends" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Friends"><i class="material-icons">contacts</i>
                <?php if($friends_count != 0) { ?>
                <span class="new badge red"><?php echo $friends_count; ?></span>
                <?php } ?>
              </a></li>

              <li><a href="<?=base_url();?>admin/commissions" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Commissions"><i class="material-icons">add_shopping_cart</i>
                <?php if($commissions_count != 0) { ?>
                <span class="new badge red"><?php echo $commissions_count; ?></span>
                <?php } ?>
              </a></li>

              <li><a href="<?=base_url();?>admin/questions" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Questions"><i class="material-icons question_answer">question_answer</i>
                <?php if($q_count != 0) { ?>
                <span class="new badge red"><?php echo $q_count; ?></span>
                <?php } ?>
              </a></li>

              <li><a href="<?=base_url();?>admin/contacts" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Emails"><i class="material-icons mail_outline">mail_outline</i>
                <?php if($emails_count != 0) { ?>
                <span class="new badge red"><?php echo $emails_count; ?></span>
                <?php } ?>
              </a></li>

              <li class="hide-on-med-and-down"><a class="notif tooltipped" data-position="left" data-delay="50" data-tooltip="Notifications" data-activates="slide-out"><i class="material-icons notifications">notifications</i></a></li>
            </ul>
          </div>
        </nav>
      </div>

      <ul id="slide-out" class="side-nav">
        <div class="caption">

          <a href="<?= site_url('admin/history') ?>" class="waves-effect waves-light btn-large">Latest Updates</a>
          <?php if( $updates != '' ): foreach($updates as $update): ?>
            <p><label><?php echo $update->date ?></label> <br>
              <?php echo $update->status ?></p>
            <?php endforeach;endif; ?>
          </div>
        </ul>

        <?php
      }?>

      <div class="fixed-action-btn">
        <a class="btn-floating btn-large red">
          <i class="large material-icons">add</i>
        </a>
        <ul>
          <li><a class="btn-floating blue lighten-4" href="#tweet"><i class="material-icons">mode_edit</i></a></li>
          <li><a class="btn-floating pink lighten-2" href="<?=base_url();?>admin/add_new_entry"><i class="material-icons">view_list</i></a></li>
          <li><a class="btn-floating yellow darken-1" href="<?=base_url();?>admin/add_new_page"><i class="material-icons">pages</i></a></li>
          <li><a class="btn-floating green" href="<?=base_url();?>admin/add_new_theme"><i class="material-icons">perm_media</i></a></li>
          <li><a class="btn-floating blue" href="<?=base_url();?>admin/add_new_resource"><i class="material-icons">brush</i></a></li>
        </ul>
      </div>

      <main class="grey darken-4">

        <div id="tweet">
          <div class="card-panel white">
            <?php echo form_open('admin/tweet'); ?>

            <div class="input-field">
              <input type="text" name="tweet" placeholder="Your Tweet" required />
            </div>

            <input class="waves-effect waves-light btn" type="submit" value="Send Tweet"/>
            <a href="#" class="waves-effect waves-light btn">Close</a>
          </form>
        </div>
      </div>