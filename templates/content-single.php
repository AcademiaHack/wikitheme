<?php while (have_posts()) : the_post(); ?>
  <?php setPostViews(get_the_ID()); ?>
  <article <?php post_class(); ?>>
    <header>
      <h2 class="entry-title"><strong><?php the_title(); ?></strong></h2>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>    
      <?php 
      if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
        ?>
        <div class="entry-thumbnail">
          <?php 
            the_post_thumbnail();
          ?>
        </div>
        <?php
      } 
      ?>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
