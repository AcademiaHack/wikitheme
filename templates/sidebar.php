<aside role="complementary">
	<div id="menus">
		<div id="main-menu" class="<?php if(is_admin_bar_showing()) echo 'adminBarPush'; ?> collapse navbar-collapse">
			<ul class="nav navbar-stacked">
				<?php wp_list_categories('orderby=slug&hide_empty=0&title_li=&depth=1&exclude=1'); ?>
			</ul>
		</div>
		<!-- <div id="main-menu">
			<ul class="nav navbar-stacked">
				
				<?php 
					$categories = get_categories('orderby=slug&parent=0&hide_empty=0&exclude=1');
				  	foreach ($categories as $cat) {
				?>
				<li class="cat-item-<?php echo $cat->cat_ID;?>" data-catid="<?php echo $cat->cat_ID;?>">
					<a href="<?php echo esc_url(get_category_link($cat->cat_ID)); ?>" title="Ver todos los posts en <?php echo $cat->name; ?>">
						<span class="sidebar-logo">
							<?php get_category_image($cat->cat_ID); ?>
						</span>
						<?php echo $cat->name; ?>
					</a>
				</li>
		
				<?php
				  }
				?><hr>
				<?php wp_list_categories('orderby=slug&hide_empty=0&title_li=&depth=1&exclude=1'); ?>
			</ul>
		</div> -->
		<!-- <div id="sub-menu">
		  <span class='subsidebar-logo'></span>
		  <ul class="nav navbar-stacked">
		  </ul>
		</div> -->
		<div id="sub-menu" class="<?php if(is_admin_bar_showing()) echo 'adminBarPush'; ?>">
		  	<?php 
				$categories = get_categories('orderby=ID&parent=0&hide_empty=0&exclude=1');
			  	foreach ($categories as $cat) {
			?>
			<div id="category-<?php echo $cat->cat_ID;?>" class="hidden">
				<span class='subsidebar-logo'><?php get_category_image($cat->cat_ID); ?></span>
				<h2><strong><?php echo $cat->name; ?></strong></h2>
				<br>
				<?php 
					$subcategories = get_categories('orderby=ID&parent='.$cat->cat_ID.'&hide_empty=0&exclude=1'); 
					if (count($subcategories)>0) {
				?>
				<ul class="nav navbar-stacked">
				  	<?php 
	 					foreach ($subcategories as $subcat) {
					?>
					<li class="cat-item-<?php echo $subcat->cat_ID;?>">
						<a href="<?php echo esc_url(get_category_link($subcat->cat_ID)); ?>" title="Ver todos los posts en <?php echo $subcat->name; ?>">
							<?php echo $subcat->name; ?>
						</a>
					</li>
					<?php 
						}
					?>
				</ul>
				<?php
				    }else{
				?>
					<ul class="nav navbar-stacked no-subcat"></ul>
				<?php
				    }
				?>
			</div>
			<?php
			  }
			?>
		</div>
	</div>
</aside>

