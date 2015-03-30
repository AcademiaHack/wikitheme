<?php
  if (post_password_required()) {
    return;
  }

 if (have_comments()) : ?>
  <section id="comments">
    <h3><?php printf(_n('Un comentario en &ldquo;%2$s&rdquo;', '%1$s comentarios en &ldquo;%2$s&rdquo;', get_comments_number(), 'roots'), number_format_i18n(get_comments_number()), get_the_title()); ?></h3>
    <hr>
    <ol class="media-list">
      <?php wp_list_comments(array('walker' => new Roots_Walker_Comment)); ?>
    </ol>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
    <nav>
      <ul class="pager">
        <?php if (get_previous_comments_link()) : ?>
          <li class="previous"><?php previous_comments_link(__('&larr; Anteriores', 'roots')); ?></li>
        <?php endif; ?>
        <?php if (get_next_comments_link()) : ?>
          <li class="next"><?php next_comments_link(__('Nuevos &rarr;', 'roots')); ?></li>
        <?php endif; ?>
      </ul>
    </nav>
    <?php endif; ?>

    <?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
    <div class="alert alert-info">
      <?php _e('Los comentarios estan cerrados.', 'roots'); ?>
    </div>
    <?php endif; ?>
  </section><!-- /#comments -->
  <hr>
<?php endif; ?>

<?php if (!have_comments() && !comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
  <section id="comments">
    <div class="alert alert-info">
      <?php _e('Los comentarios estan Cerrados.', 'roots'); ?>
    </div>
  </section><!-- /#comments -->
  <hr>
<?php endif; ?>

<?php if (comments_open()) : ?>
  <section id="respond">
    <h3><?php comment_form_title(__('Deja un comentario', 'roots'), __('Deja un comentario a %s', 'roots')); ?></h3>
    <p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
    <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
      <p><?php printf(__('Debes estar <a href="%s">conectado</a> para comentar.', 'roots'), wp_login_url(get_permalink())); ?></p>
    <?php else : ?>
      <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
        <?php if (is_user_logged_in()) : ?>
          <p>
            <?php printf(__('Conectado como <a href="%s/wp-admin/profile.php">%s</a>.', 'roots'), get_option('siteurl'), $user_identity); ?>
            <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'roots'); ?>"><?php _e('Log out &raquo;', 'roots'); ?></a>
          </p>
        <?php else : ?>
          <div class="form-group">
            <input type="text" class="form-control" name="author" id="author" placeholder="<?php _e('Nombre', 'roots'); if ($req) _e(' *', 'roots'); ?>" value="<?php echo esc_attr($comment_author); ?>" size="22" <?php if ($req) echo 'aria-required="true"'; ?>>
          </div>
          <div class="form-group">
            <input type="email" class="form-control" name="email" id="email" placeholder="<?php _e('Email (no sera publicado)', 'roots'); if ($req) _e(' *', 'roots'); ?>" value="<?php echo esc_attr($comment_author_email); ?>" size="22" <?php if ($req) echo 'aria-required="true"'; ?>>
          </div>
          <!-- <div class="form-group">
            <label for="url"><?php _e('Página Web', 'roots'); ?></label>
            <input type="url" class="form-control" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22">
          </div> -->
        <?php endif; ?>
        <div class="form-group">
          <textarea name="comment" id="comment" class="form-control" placeholder="Aca va tu comentario" rows="5" aria-required="true"></textarea>
        </div>
        <input name="submit" class="btn btn-primary btn-block" type="submit" id="submit" value="<?php _e('Comentar!', 'roots'); ?>">
        <?php comment_id_fields(); ?>
        <?php do_action('comment_form', $post->ID); ?>
      </form>
    <?php endif; ?>
  </section><!-- /#respond -->
<?php endif; ?>
