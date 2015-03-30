<form role="search" method="get" class="search-form form-inline" action="<?php echo home_url('/'); ?>">
  <div class="input-group">
    <input type="search" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" class="search-field form-control" placeholder="<?php _e('Buscar en', 'roots'); ?> <?php bloginfo('name'); ?>">
    <label class="hide"><?php _e('Búsqueda para:', 'roots'); ?></label>
    <span class="input-group-btn">
      <button type="submit" class="search-submit btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
    </span>
  </div>
</form>

