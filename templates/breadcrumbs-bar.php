<div class="container-fluid <?php if(is_admin_bar_showing()) echo 'adminShown'; ?>" id="breadcrumbs-bar">
  <div class="col-xs-6 col-sm-8">
	<?php the_breadcrumb(); ?>
  </div>
  <div id="searchform" class="col-xs-6 col-sm-4 col-md-3 pull-right">
    <?php get_search_form(); ?>
  </div>
</div>
