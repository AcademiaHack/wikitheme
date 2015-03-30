<div class="byline author vcard">
	<div class="row">
		<div class="col-xs-6 byline-item" title="<?php echo get_userdata($post['post_author'])->display_name; ?>">
			<i class='icon-user'></i>
			<a href="<?php echo get_author_posts_url($post['post_author']); ?>" rel="author" class="fn">
				<?php echo get_userdata($post['post_author'])->display_name; ?>
			</a> 
		</div>
		<div class="col-xs-6 byline-item">
			<i class='icon-notesdatealt'></i>
			<time class="published" datetime="<?php echo get_post_time('c', false, $post["ID"]); ?>">
				<?php echo get_post_time('j/n/Y', false, $post["ID"]); ?>
			</time>
		</div>
	</div>
</div>
