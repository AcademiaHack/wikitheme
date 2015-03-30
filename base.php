<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

  <!--[if lt IE 8]>
    <div class="alert alert-info">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
    </div>
  <![endif]-->

  <?php
    do_action('get_header');
    // Use Bootstrap's navbar if enabled in config.php
    if (current_theme_supports('bootstrap-top-navbar')) {
      get_template_part('templates/header-top-navbar');
    } else {
      get_template_part('templates/header');
    }
  ?>

  <div class="wrap" role="document">    
    <?php get_template_part('templates/breadcrumbs-bar'); ?>
    <!-- /.sidebar -->
    <?php include roots_sidebar_path(); ?>
          
    <!-- /.content -->
    <div class="content">
      <main class="main" role="main">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <?php 
                if (is_front_page())
                  get_template_part('front-page');    
                else 
                  include roots_template_path();
              ?>
            </div>
          </div>
        </div>
      </main>

      <?php 
        if (roots_display_sidebar()){ 
      ?>
      <div id="widget-bar" class="col-sm-2">
        <div id="widget-holder">
          <?php  
            //if(is_single()){
            //  comments_template('/templates/comments.php');
            //}else{
            dynamic_sidebar('sidebar-primary');
            //} 
          ?>
        </div>
      </div>

      <div class="modal fade" id="widget-bar-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div id="widget-bar">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <div id="widget-holder">
                <?php  
                  //if(is_single()){
                  //  comments_template('/templates/comments.php');
                  //}else{
                  dynamic_sidebar('sidebar-primary');
                  //} 
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php 
        }
      ?>
    </div> 
  </div>
  <?php get_template_part('templates/footer'); ?>

</body>
</html>
