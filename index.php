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
