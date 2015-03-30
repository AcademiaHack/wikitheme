<div class="row">
	<div class="stats">
		<span class="stats-info col-xs-6 col-sm-6 col-md-3">
			Estadísticas:
		</span>
		<span class="stats-info col-xs-6 col-sm-6 col-md-3">
			<?php echo wp_count_posts()->publish; ?> 
			<span class="hidden-md hidden-lg visible-xs-block visible-sm-block"><i class='icon-document'></i></span>
			<span class="hidden-xs hidden-sm visible-md-block visible-lg-block">Articulos</span>
		</span>
		<span class="stats-info col-xs-6 col-sm-6 col-md-3">
			<?php echo wp_count_terms('category', 'orderby=count&hide_empty=0' ); ?> 
			<span class="hidden-md hidden-lg visible-xs-block visible-sm-block"><i class='icon-folderalt'></i></span>
			<span class="hidden-xs hidden-sm visible-md-block visible-lg-block">Categorias</span>
		</span>
		<span class="stats-info col-xs-6 col-sm-6 col-md-3">
			<?php echo wp_count_comments()->approved; ?> 
			<span class="hidden-md hidden-lg visible-xs-block visible-sm-block"><i class='icon-commentroundtyping'></i></span>
			<span class="hidden-xs hidden-sm visible-md-block visible-lg-block">Comentarios</span>
		</span>
	</div>
</div>