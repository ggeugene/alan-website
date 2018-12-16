<?php
/**
 * The Template for displaying Product Tag.
 *
 * @package WordPress
 * @subpackage Ohmy
 * @since Ohmy 1.0
 */


$position         =  neko_get_sidebar_layout();
$neko_blog_layout = get_theme_mod( 'blog_list_layout', 'default');
$header_display   = get_post_meta($post->ID, 'neko_page_header_display', true);

$queried_object = get_queried_object();

get_header();


/** Complementary options **/

?>
<main id="content" class="site-content">
	<div id="primary" class="content-area">
    <div class="custom-title-container">
      <div class="container">
      <h3><?php echo __('The standard of true taste', 'workrocks'); ?></h3>
      </div>
    </div>
    <div class="custom-page-separator-container"><div class="custom-page-separator"></div></div>
    <div class="custom-page-content">
      <div class="custom-page-title">
        <h2><?php echo __('Products of TM', 'workrocks') . ' ' . $queried_object->name ?></h2>
        <div class="custom-spacer"></div>
      </div>
  		<div class="container">

  			<div class="col-sm-12">
  				<div class="row">

            <?php
						if (strpos($queried_object->slug, 'alan') !== false) {
							$terms = get_terms_by_tag($queried_object->slug);
							ksort($terms);
							// echo '<pre>';
							// var_dump($terms);
	            if (!empty($terms)) {
	              echo '<ul class="product-tag-list">';
	              foreach($terms as $term) {
					  // var_dump($term);
	                echo '<li class="product-tag-list-item"><a href="' . add_query_arg('brand', $queried_object->slug ,get_term_link($term)) . '">';
	                echo '<div class="product-list-item-content"><h3>' . $term->name . '</h3><p class="product-list-item-description">' . $term->description . '</p></div>';
									echo '<div class="product-list-item-img-container"><img src="' . get_field('product_category_image', $term) . '"></div>';
	                echo '</a></li>';
	              }
	              echo '</ul>';
	            }
						} else {
							echo '<div class="tag-description">' . get_field('tag_description', $queried_object) . '</div>';
		  				 	echo get_post_by_tag_and_category($queried_object->slug);
						}

            ?>

  				</div>
  			</div>
  		</div>
  </div>
	</div>
</main>
<?php get_footer(); ?>
