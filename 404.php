<?php get_template_part('templates/page', 'header'); ?>

<div class="alert alert-info">
  <h3><?php _e('There\'s no such thing as your page here!', 'roots'); ?></h3>
</div>

<p><?php _e('Esto puede ser el resultado de:', 'roots'); ?></p>
<ul>
  <li><?php _e('una dirección mal escrita', 'roots'); ?></li>
  <li><?php _e('un vinculo desactualizado', 'roots'); ?></li>
  <li><?php _e('drogas, a veces', 'roots'); ?></li>
</ul>

<?php get_search_form(); ?>
