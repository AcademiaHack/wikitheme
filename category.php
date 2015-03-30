<?php
  $cat = get_queried_object();
  $catid = $cat->cat_ID;
  if($cat->parent == 0){

    $args = array('numberposts' => '7',
                  'category' => $catid,
                  'post_status' => 'publish');
    $recent_posts = wp_get_recent_posts( $args );
    $cant_posts_cat = sizeof($recent_posts);
    $subcategories = get_categories('orderby=ID&parent='.$catid.'&hide_empty=1&exclude=1');
    $cant_subcats = sizeof($subcategories);
    
    if(wp_get_cat_postcount($catid)>0){
?>
<!-- MAIN - CUADROTE -->
<div class="row">
  <div class="<?php if($cant_subcats > 0) echo 'col-xs-12 col-sm-12 col-md-5 col-lg-5'; else echo 'col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2'; ?>">
    <div class="cat-main-square">
      <div id="cat-main-title" class="text-center">
        <a href="<?php echo esc_url(get_category_link($cat->cat_ID)); ?>">
          <span class="cat-main-logo"><?php get_category_image($cat->cat_ID); ?></span>
          <h1><?php echo $cat->name; ?></h1>
        </a> 
      </div>
      <div class="cat-main-post-list">
        <?php 
            foreach ($recent_posts as $post) {
        ?>
        <div class="row">
          <div class="col-sm-10 col-md-10 col-xs-10">
            <div id="cat-main-post-title">
              <h4 class="cat-post-name" title="<?php echo $post["post_title"]; ?>">
                <a href="<?php echo get_permalink($post['ID']); ?>">
                  <strong><?php echo $post["post_title"]; ?></strong>
                </a>
              </h4>
              <?php get_template_part('templates/catpost-entry-meta'); ?>
            </div>
          </div>
          <div class="comment-badge pull-right">
            <i class='icon-comment'></i>
            <div class="comment-count"><?php echo wp_count_comments($post['ID'])->approved; ?></div>
          </div>  
        </div>
        <?php 
            }
        ?>
        </ul>
      </div>
      <div class="cat-main-count-square">
        <p class="text-center">
          <?php echo  "<b>".wp_get_cat_postcount($catid). "</b>"; ?><br>
          Post
        </p>
      </div>
    </div>
  </div>

<!-- MINI - CUADRITOS -->
  
  <?php 
    if($cant_subcats>0){
  ?>  
  <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
    <?php 
      // echo "<pre><h4>"; var_dump($cat); echo "</h4></pre>";
      foreach ($subcategories as $subcat) {
     ?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
      <div class="subcat-square">
        <div class="subcat-title text-center">
          <a href="<?php echo esc_url(get_category_link($subcat->cat_ID)); ?>">
            <h4><?php echo $subcat->name; ?></h4>
          </a> 
        </div>
        <div class="subcat-post-list">
          <?php 
              $args = array('numberposts' => '5',
                            'category' => $subcat->cat_ID,
                            'post_status' => 'publish');
              $subcat_recent_posts = wp_get_recent_posts( $args );
        
              foreach ($subcat_recent_posts as $subcat_post) {
          ?>
          <div class="row">
            <div class="col-sm-10 col-md-10 col-xs-10">
              <div class="subcat-post-title">
                <div class="subcat-post-name" title="<?php echo $subcat_post["post_title"]; ?>">
                  <a href="<?php echo get_permalink($subcat_post['ID']); ?>">
                    <strong><?php echo $subcat_post["post_title"]; ?></strong>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-sm-2 col-md-2 col-xs-2 comment-badge">
              <i class='icon-comment'></i>
              <div class="comment-count"><?php echo wp_count_comments($post['ID'])->approved; ?></div>
            </div> 
          </div>
          <?php 
              }
          ?>
        </5div>
        <div class="subcat-count-square">
          <p class="text-center">
            <?php echo  "<b>".wp_get_cat_postcount($subcat->cat_ID). "</b>"; ?><br>
            Post
          </p>
        </div>
      </div>
    </div>

  </div>
    <?php 
        }
    ?>
  <?php 
    }else{

    }
   ?>
</div>
<?php 
    }else{
?>
  <div class="row">
    <div class="<? if($cant_subcats > 0) echo 'col-xs-12 col-sm-12 col-md-5 col-lg-5'; else echo 'col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2'; ?>">
      <div class="cat-main-square">
        <div id="cat-main-title" class="text-center">
          <a href="<?php echo esc_url(get_category_link($cat->cat_ID)); ?>">
            <span class="cat-main-logo"><?php get_category_image($cat->cat_ID); ?></span>
            <h1><?php echo $cat->name; ?></h1>
          </a> 
        </div>
        <div class="alert alert-info">
          <h3><?php _e('Disculpe, no se encontró ningun resultado.', 'roots'); ?></h3>
        </div>
      </div>
    </div>

<?php
    }
  }else{
?>
  <?php get_template_part('templates/page', 'header'); ?>

  <?php if (!have_posts()) : ?>
    <div class="alert alert-info">
      <?php _e('Disculpe, no se encontró ningun resultado.', 'roots'); ?>
    </div>
  <?php endif; ?>

  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/content', get_post_format()); ?>
  <?php endwhile; ?>

  <?php if ($wp_query->max_num_pages > 1) : ?>
    <nav class="post-nav">
      <ul class="pager">
        <li class="previous"><?php next_posts_link(__('&larr; Entradas anteriores', 'roots')); ?></li>
        <li class="next"><?php previous_posts_link(__('Nuevas entradas &rarr;', 'roots')); ?></li>
      </ul>
    </nav>
  <?php endif; ?>
<?php 
  }
?>




