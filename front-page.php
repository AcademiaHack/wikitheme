
<?php get_template_part('templates/statistics'); ?>
<?php /*resetPostViews();*/ ?>
<div class="row">
	<div id="front-content">
		<?php 
			$categories = get_categories('orderby=slug&parent=0&hide_empty=0&exclude=1');
		  	foreach ($categories as $cat) {
		  		$args = array('numberposts' => '5',
		  					  'category' => $cat->cat_ID,
		  					  'post_status' => 'publish');
		  		$recent_posts = wp_get_recent_posts( $args );
		  		$cant_posts = sizeof($recent_posts);
		  		if($cant_posts>0){
		?>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
			<div class="cat-square">
				<div class="text-center">
					<a href="<?php echo esc_url(get_category_link($cat->cat_ID)); ?>">
						<span class="cat-logo"><?php get_category_image($cat->cat_ID); ?></span>
						<h2><?php echo $cat->name; ?></h2>
					</a> 
				</div>
				<div class="cat-post-list">
					<?php 
					    foreach ($recent_posts as $post) {
					?>
					<div class="row">
					  <div class="col-sm-10 col-md-10 col-xs-10">
					  	<div class="cat-post-title">
							<div class="cat-post-name" title="<?php echo $post["post_title"]; ?>">
								<a href="<?php echo get_permalink($post['ID']); ?>">
									<strong><?php echo $post["post_title"]; ?></strong>
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
				</div>
			</div>
			<div class="cat-count-square">
				<p class="text-center">
					<?php echo  "<b>".wp_get_cat_postcount($cat->cat_ID). "</b>"; ?><br>
					Post
				</p>
			</div>
		</div>
		<?php
			}else{

			}
		  }
		?>
	</div>	
</div>