<?php
if( !function_exists('ohmy_child_enqueue_styles') ){
 function ohmy_child_enqueue_styles() {
  wp_enqueue_style( 'ohmy-parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'ohmy_child_enqueue_styles', 15);
}
if( !function_exists('flexlider_enqueue_styles') ){
 function flexlider_enqueue_styles() {
  wp_enqueue_style( 'flexlider', get_stylesheet_directory_uri() . '/flexslider/flexslider.css' );
  wp_register_script('flexlider', get_stylesheet_directory_uri() . '/flexslider/jquery.flexslider-min.js', array(), '', true);
  wp_enqueue_script('flexlider');
}
add_action( 'wp_enqueue_scripts', 'flexlider_enqueue_styles', 20);
}
wp_register_script('customjs', get_stylesheet_directory_uri() . '/js/customjs.js', array(), '', true);
wp_enqueue_script('customjs');

add_action('after_setup_theme', function(){
	register_nav_menu('right_menu', 'Right Menu');
});

function product_custom_post_type() {
  $args['post-type-product'] = array(
		'labels' => array(
			'name' => __( 'Products', 'workrocks' ),
			'singular_name' => __( 'Product Item', 'workrocks' ),
			'all_items' => 'Products',
			'add_new' => __( 'Add New', 'workrocks' ),
			'add_new_item' => __( 'Add New Product Item', 'workrocks' ),
			'edit_item' => __( 'Edit Product', 'workrocks' ),
			'new_item' => __( 'New Product', 'workrocks' ),
			'view_item' => __( 'View Product', 'workrocks' ),
			'search_items' => __( 'Search Products', 'workrocks' ),
			'not_found' => __( 'No products found', 'workrocks' ),
			'not_found_in_trash' => __( 'No products found in Trash', 'workrocks' ),
			'parent_item_colon' => __( 'Parent Product:', 'workrocks' ),
			'menu_name' => __( 'Products', 'workrocks' ),
		),
		'hierarchical' => true,
        'description' => 'Add your Products',
        'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
		'taxonomies' => array('product_cats'),
		'menu_icon' =>  'dashicons-cart',
		'show_ui' => true,
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'query_var' => 'product',
		'menu_position' => 25,
        'rewrite' => array('slug' => 'product', 'with_front' => true)
		);

	register_post_type('product', $args['post-type-product']);

  $taxonomies = array();

  $taxonomies['taxonomy-product_cats'] = array(
    'labels' => array(
      'name' => __( 'Product Categories', 'workrocks' ),
      'singular_name' => __( 'Product Category', 'workrocks' ),
      'search_items' =>  __( 'Search Product Categories', 'workrocks' ),
      'all_items' => __( 'All Product Categories', 'workrocks' ),
      'parent_item' => __( 'Parent Product Category', 'workrocks' ),
      'parent_item_colon' => __( 'Parent Product Category:', 'workrocks' ),
      'edit_item' => __( 'Edit Product Category', 'workrocks' ),
      'update_item' => __( 'Update Product Category', 'workrocks' ),
      'add_new_item' => __( 'Add New Product Category', 'workrocks' ),
      'new_item_name' => __( 'New Product Category Name', 'workrocks' ),
      'choose_from_most_used'	=> __( 'Choose from the most used product categories', 'workrocks' )
    ),
    'hierarchical' => true,
    // 'orderby' => 'slug',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'catalog' )
  );

  $taxonomies['taxonomy-product_tags']  = array(
    'labels' => array(
      'name' => __( 'Product Tags', 'workrocks'),
      'singular_name' => __( 'Product Tags', 'workrocks'),
      'search_items' =>  __( 'Product Tags', 'workrocks'),
      'all_items' => __( 'All Product Tags', 'workrocks'),
      'parent_item' => __( 'Parent Product Tag', 'workrocks'),
      'parent_item_colon' => __( 'Parent Product Tag:', 'workrocks'),
      'edit_item' => __( 'Edit Product Tag', 'workrocks'),
      'update_item' => __( 'Update Product Tag', 'workrocks'),
      'add_new_item' => __( 'Add New Product Tag', 'workrocks'),
      'new_item_name' => __( 'New Product Tag', 'workrocks'),
      'choose_from_most_used'	=> __( 'Choose from the most used product tags', 'workrocks' )
      ),
    'hierarchical' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'product-tag' )
    );

  /* Register taxonomy: name, cpt, arguments */
  register_taxonomy('product_cats', array('product'), $taxonomies['taxonomy-product_cats']);
  register_taxonomy_for_object_type('product_cats', 'product');
  register_taxonomy('product_tags', array('product'), $taxonomies['taxonomy-product_tags']);
  register_taxonomy_for_object_type('product_tags', 'product');
}

add_action( 'init', 'product_custom_post_type' );

function workrocks_custom_post_types_admin_init() {
	if (!is_admin()){
		return;
	}

  global $termeni;

  $termeni = get_terms('product_cats', array('hide_empty' => false));
  global $catarray;
  $catarray = array();
  foreach ($termeni as $term) {
    $catarray[$term->term_id] = $term->name;
    if (function_exists('icl_register_string')) {
    icl_register_string('Product Category', 'Term '.$term->term_id.'', $term->name);
    }
  }

}

add_action('admin_init', 'workrocks_custom_post_types_admin_init', 9999);

function get_terms_by_tag($tag_slug) {

  $args = array(
    'orderby' => 'slug',
    'order' => 'ASC',
    'posts_per_page' => -1,
    'tax_query' => array(
      array(
        'taxonomy' => 'product_tags',
        'field' => 'slug',
        'terms' => $tag_slug
      )
    )
  );

  $unique_terms = array();

  $query = new WP_Query($args);

  if($query->have_posts()) {
    foreach( $query->posts as $post_id) {
      $terms = get_the_terms( $post_id, 'product_cats' );

      if (!empty($terms)) {
        foreach ($terms as $term) {
           if( empty( $unique_terms ) || !array_key_exists( $term->slug, $unique_terms ) ) {
             $unique_terms[$term->slug] = $term;
           }
        }
      }
    }
  wp_reset_postdata();
  }

  return $unique_terms;

}

function get_post_by_tag_and_category($tag_slug, $category_slug = null) {

  $string = '';

  $args = array(
    'posts_per_page' => -1,
    'paged' => 1,
    'meta_key' => 'number',
    'orderby' => 'meta_value',
    'order' => 'ASC',
    'tax_query' => array(
      array(
        'taxonomy' => 'product_tags',
        'field' => 'slug',
        'terms' => $tag_slug
      )
    )
  );
  if (!is_null($category_slug)) {
    $args['posts_per_page'] = 6;
    $args['tax_query']['relation'] = 'AND';
    array_push($args['tax_query'], array(
      'taxonomy' => 'product_cats',
      'field' => 'slug',
      'terms' => $category_slug
    ));

  }

  $query = new WP_Query($args);

  if($query->have_posts()) {
    $string .= '<ul class="product-list" data-tag="' . $tag_slug . '" data-cat="' . $category_slug . '" data-pages="' . $query->max_num_pages . '" data-page="' . $args['paged'] . '">';
    foreach($query->posts as $post) {
      $string .= '<li class="product-list-item"><a href="' . get_the_permalink($post->ID) . '">';
      $string .= '<img class="product-list-item-image" src="' . get_the_post_thumbnail_url($post->ID) . '"><div class="product-list-item-content">';
      if (!empty(get_field('product_type', $post->ID))) {
        $string .= '<div class="product-list-item-type"><span>' . get_field('product_type', $post->ID) . '</span></div>';
      }
      $string .= '<div class="product-list-item-title"><span>' . get_the_title( $post->ID) . '</span></div>';
      $string .= '</div></a></li>';
    }
    $string .= '</ul>';
    if ($query->max_num_pages > $args['paged']) {
        $string .= '<div class="loadmore-container"><div class="loadmore">Load More...</div></div>';
    }
  }
  return $string;

}

add_filter('query_vars', 'p_query');

function p_query($qvars) {
  $qvars[] = 'brand';
  return $qvars;
}

function get_navigation_by_tag_and_category($tag_slug, $category_slug) {
  $args = array(
    'orderby' => 'date',
    'order' => 'ASC',
    'posts_per_page' => -1,
    'tax_query' => array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'product_tags',
        'field' => 'slug',
        'terms' => $tag_slug
      ),
      array(
        'taxonomy' => 'product_cats',
        'field' => 'slug',
        'terms' => $category_slug
      )
    )
  );

  $post_id = get_queried_object()->ID;
  $ids = array();
  wp_reset_postdata();
  $query = new WP_Query($args);
  if($query->have_posts()) {
    foreach($query->posts as $thepost) {
      $ids[] = $thepost->ID;
    }
  }
  $index = array_search($post_id, $ids);
  $prev_post = $ids[$index-1];
  $next_post = $ids[$index+1];


  if(!empty($prev_post) || !empty($next_post)) {

    echo '<div class="custom-product-navigation">';

    if(!empty($prev_post)) :
        echo '<a class="prev-product" rel="prev" href="' . get_the_permalink($prev_post) . '" title="' . __('Previous product', 'workrocks') . ' ' . get_the_title($prev_post) . '">PREV</a>';
      endif;
    if(!empty($next_post)) :
        echo '<a class="next-product" rel="next" href="' . get_the_permalink($next_post) . '" title="' . __('Next product', 'workrocks') . ' ' . get_the_title($next_post) . '">NEXT</a>';
    endif;

    echo '</div>';
  }

}

function create_acf_flexslider() {
  $images = get_field('product_gallery');

  if( $images ): ?>
    <div id="slider" class="flexslider">
        <ul class="slides">
            <?php foreach( $images as $image ): ?>
                <li>
                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                    <p><?php echo $image['caption']; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php
  else :
    echo '<p class="error-message" style="text-align:center; color: #ff3333;">' . __('Product images are not set', 'workrocks');
  endif;
}

// Hide Default description field from product_tags taxonomy
add_action( 'product_tags_add_form', function( $taxonomy )
{
    ?><style>.term-description-wrap{display:none;}</style><?php
}, 10, 2 );
add_action( "product_tags_edit_form", function( $tag, $taxonomy )
{
    ?><style>.term-description-wrap{display:none;}</style><?php
}, 10, 2 );


// add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
// add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');


function workrocks_products_load_more_scripts() {

	global $wp_query;

	// register our main script but do not enqueue it yet
	wp_register_script( 'product_loadmore', get_stylesheet_directory_uri() . '/js/product-loadmore.js', array('jquery') );

	// now the most interesting part
	// we have to pass parameters to js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'product_loadmore', 'workrocks_products_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
	) );

 	wp_enqueue_script( 'product_loadmore' );

}
add_action( 'wp_enqueue_scripts', 'workrocks_products_load_more_scripts' );

function workrocks_products_loadmore() {
    $args = array(
      'posts_per_page' => 6,
      // 'paged' => 1,
      'meta_key' => 'number',
      'orderby' => 'meta_value',
      'order' => 'ASC',
      'tax_query' => array(
        array(
          'taxonomy' => 'product_tags',
          'field' => 'slug',
          'terms' => $_POST['tag']
        )
      )
    );
    if (!empty($_POST['cat'])) {
      $args['tax_query']['relation'] = 'AND';
      array_push($args['tax_query'], array(
        'taxonomy' => 'product_cats',
        'field' => 'slug',
        'terms' => $_POST['cat']
      ));
    }
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';

  query_posts( $args );

  if( have_posts() ) :
    $string = '';

    while( have_posts() ): the_post();

    $string .= '<li class="product-list-item"><a href="' . get_the_permalink($post->ID) . '">';
    $string .= '<img class="product-list-item-image" src="' . get_the_post_thumbnail_url($post->ID) . '"><div class="product-list-item-content">';
    if (!empty(get_field('product_type', $post->ID))) {
      $string .= '<div class="product-list-item-type"><span>' . get_field('product_type', $post->ID) . '</span></div>';
    }
    $string .= '<div class="product-list-item-title"><span>' . get_the_title( $post->ID) . '</span></div>';
    $string .= '</div></a></li>';

    endwhile;
    echo $string;
  endif;
  wp_die();
}

add_action('wp_ajax_loadmore', 'workrocks_products_loadmore');
add_action('wp_ajax_nopriv_loadmore', 'workrocks_products_loadmore');

if(!function_exists('neko_excerpt_read_more_link')){

function neko_excerpt_read_more_link( $output ) {

	if ( is_search() ) {

		global $post;
		return $output . '' ;

	}else{

		return $output;

	}
}

add_filter( 'get_the_excerpt', 'neko_excerpt_read_more_link' );
}
