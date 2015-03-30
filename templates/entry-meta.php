<div class="byline author vcard">
	<div class="row">
		<div class="col-md-8 col-sm-4 col-xs-4 byline-item" title="<?php the_author(); ?>">
			<i class='icon-user'></i>
			<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn" data-toggle="tooltip">
				<?php echo get_the_author(); ?>
			</a>
		</div>
		<div class="col-md-2 col-sm-4 col-xs-4 byline-item">
			<i class='icon-notesdatealt'></i>
			<time class="published" datetime="<?php echo get_the_time('c'); ?>">
				<?php echo get_the_date('j/n/Y'); ?>
			</time> 
		</div>
		<div class="col-md-2 col-sm-4 col-xs-4 byline-item">
			<i class='icon-eye-view'></i>
			<?php echo getPostViews(get_the_ID()); ?> 
		</div>
	</div>
</div>