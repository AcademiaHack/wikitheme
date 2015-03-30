<?php
/**
 * Custom functions
 */

// Insertar Breadcrumb    
function the_breadcrumb() {
    /*global $post;
    echo '<ul id="breadcrumbs" class="breadcrumb">';
    if (!is_home()) {
        echo '<li><a href="'.get_option('home').'">'.get_bloginfo('name').'</a></li>';
        if (is_category() || is_single()) {
            if (is_single()) {
                $postCats=wp_get_post_categories( $post->ID );
                if(sizeof($postCats) > 0){
                    if($postCats[0] <> 1) {
                        echo '<li><a href="'.get_category_link($postCats[0]).'">'.get_the_category_by_ID($postCats[0]).'</a></li>';
                    }
                }
                echo "<li class='active'>".the_title().'</li>';
            }else{
                echo "<li class='active'>Categoria: \""; echo single_tag_title()."\"</li>";
            }
        } elseif (is_page()) {
            if($post->post_parent){
                $anc = get_post_ancestors( $post->ID );
                $title = get_the_title();
                foreach ( $anc as $ancestor ) {
                    $output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li>';
                }
                echo $output;
                echo '<span title="'.$title.'"> '.$title.'</span>';
            } else {
                if(!is_front_page()){
                    echo '<li class="active"> '.get_the_title().' </li>';                    
                }else{
                    echo '<li class="active"> Home </li>';                    
                }
            }
        }
        elseif (is_tag()) {echo "<li class='active'>Tag: \""; echo single_tag_title()."\"</li>";}
        elseif (is_day()) {echo "<li class='active'>Archivo para: "; echo the_time('F jS, Y'); echo'</li>';}
        elseif (is_month()) {echo"<li class='active'>Archivo para: "; echo the_time('F, Y'); echo'</li>';}
        elseif (is_year()) {echo"<li class='active'>Archivo para: "; echo the_time('Y'); echo'</li>';}
        elseif (is_author()) {echo"<li class='active'>Autor: \""; echo get_the_author()."\"</li>";}
        elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li class='active'>Archivos del Blog"; echo'</li>';}
        elseif (is_search()) {echo"<li class='active'>Búsqueda: \""; echo get_search_query()."\"</li>";}
    }    
    echo '</ul>';*/

    //NUEVO BREADCRUMB
    ?>
    <span id='breadcrumbs'>
        <?php if(is_single()){ 
            echo "<span><strong>En las categorías: </strong>"; the_category(' &bull; '); echo "</span>";
        }elseif(is_category()){ 
            echo "<span><strong>Categoria: </strong>"; echo single_tag_title(); echo "</span>";
        }elseif (is_tag()) {
            echo "<span><strong>Tag: </strong> \""; echo single_tag_title(); echo "\"</span>";
        } elseif (is_day()) {
            echo "<span>Archivo para: "; echo the_time('F jS, Y'); echo'</span>';
        } elseif (is_month()) {
            echo"<span>Archivo para: "; echo the_time('F, Y'); echo'</span>';
        } elseif (is_year()) {
            echo"<span>Archivo para: "; echo the_time('Y'); echo'</span>';
        } elseif (is_author()) {
            echo"<span>Autor: \""; echo get_the_author()."\"</span>";
        } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
            echo "<span>Archivos del Blog "; echo'</span>';
        } elseif (is_search()) {
            echo"<span>Búsqueda: \""; echo get_search_query()."\"</span>";
        }elseif (is_search()) {
            echo"<span>Búsqueda: \""; echo get_search_query()."\"</span>";
        } ?>
    </span>
    <?php
} 


////// Post Views:

function resetPostViews(){
    $posts = get_posts('numberposts=-1&post_type=post&post_status=any');
    foreach ($posts as $post) {
        delete_post_meta($post->ID, 'post_views_count');
        add_post_meta($post->ID, 'post_views_count', '0');
    }
}


function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count.'';
}

function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

///////////////////////

function get_category_image($cat_id)
{
    if($cat_id == 94){
        // Buenas Practicas
        echo "<i class='icon-wizardalt'></i>";
    }elseif($cat_id == 89){
        // Tecnologia
        echo "<i class='icon-laptop'></i>";
    }elseif ($cat_id == 99) {
        // Cultura
        echo "<i class='icon-world'></i>";
    }elseif ($cat_id == 101) {
        // Formacion
        echo "<i class='icon-student-school'></i>";
    }elseif ($cat_id == 106) {
        // Proyectos
        echo "<i class='icon-htmlfile'></i>";
    }elseif ($cat_id == 107) {
        // Finanzas
        echo "<i class='icon-stocks'></i>";
    }elseif ($cat_id == 42) {
        // Mercadeo
        echo "<i class='icon-thumbs-up'></i>";
    }elseif ($cat_id == 112) {
        // Negocios
        echo "<i class='icon-moneybag'></i>";
    }elseif ($cat_id == 21) {
        // Directiva
        echo "<i class='icon-tie-business'></i>";
    }elseif ($cat_id == 114) {
        // Miscelaneos
        echo "<i class='icon-emojigrin'></i>";
    }
}

function wp_get_cat_postcount($id) {
    $cat = get_category($id);
    $count = (int) $cat->count;
    $taxonomy = 'category';
    $args = array(
      'child_of' => $id,
    );
    $tax_terms = get_terms($taxonomy,$args);
    foreach ($tax_terms as $tax_term) {
        $count +=$tax_term->count;
    }
    return $count;
}

function submenu_maker(){
    $cat = $_POST['catid'];
    echo wp_list_categories('orderby=ID&hide_empty=0&title_li=&depth=1&child_of='.$cat.'');
    die();
}
add_action('wp_ajax_submenu_filler','submenu_maker');
add_action('wp_ajax_nopriv_submenu_filler','submenu_maker');

function roots_ajaxurl() {
?>
    <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
<?php
}
add_action('wp_head','roots_ajaxurl');

function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/img/wiki-logo.png);
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return '4GeeksWiki';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );
