<?php
/**
 * The Template for displaying Single Product.
 *
 * @package WordPress
 * @subpackage Ohmy
 * @since Ohmy 1.0
 */


$position         =  neko_get_sidebar_layout();
$neko_blog_layout = get_theme_mod( 'blog_list_layout', 'default');
$header_display   = get_post_meta($post->ID, 'neko_page_header_display', true);

// $queried_object = get_queried_object();
$post_tags = get_the_terms($post->ID, 'product_tags');
$post_category = get_the_terms($post->ID, 'product_cats');

get_header();


/** Complementary options **/

?>
<main id="content" class="site-content">
	<div id="primary" class="content-area">

		 <div class="custom-title-container" style="<?php echo 'background: url(/wp-content/themes/workrocks/img/alan-page_title_background.jpg); background-size: cover; background-position: center; ">';
		?>

      <div class="container">
      <h3><?php echo __('The standard of true taste', 'workrocks'); ?></h3>
      </div>
    </div>
    <div class="custom-page-separator-container"><div class="custom-page-separator"></div></div>
    <div class="custom-page-content">
			<?php get_navigation_by_tag_and_category($post_tags[0]->slug, $post_category[0]->slug); ?>
			<div class="custom-page-title">
				<?php if (!empty($post_tags[0])) :?>
        <?php echo '<h2 class="tag-title"><a href="' . get_term_link($post_tags[0]->slug, 'product_tags') . '">' . __('Product of TM', 'workrocks') . ' ' . $post_tags[0]->name . '</a></h2>';?>

			<?php endif;
				if (!empty($post_category[0])) :
					echo '<h2 class="category-title"><a href="' . get_term_link($post_category[0]->slug, 'product_cats') . '">' . $post_category[0]->name . '</a></h2>';
					// var_dump($post_category[0]);
				endif;
					?>

      	</div>
		<div class="container">

			<div class="col-sm-12">
				<div class="row">
					<div class="single-product-content">
							<!-- <?php echo '<img src="' . get_the_post_thumbnail_url() . '">'; ?> -->
							<?php create_acf_flexslider(); ?>
						<div class="single-product-title-wrapper">
							<?php $string = '<div class="single-product-fields">';
								if (!empty(get_field('product_type', $post->ID))) {
				        	$string .= '<span class="product-type">' . get_field('product_type', $post->ID) . '</span>';
								}
								if (!empty(get_field('product_grade', $post->ID))) {
									$string .= ' ' . '<span class="product-grade">' . get_field('product_grade', $post->ID) . '</span>';
								}
								echo $string . '</div>';
								echo '<h2 class="single-product-title">' . get_the_title() . '</h2>';
								if (!empty(get_field('product_standart', $post->ID))) {
									echo '<h3 class="single-product-standart">' . get_field('product_standart', $post->ID) . '</h3>';
								}
				       ?>
						</div>
          <?php while ( have_posts() ) : the_post(); ?>

           <?php the_content(); ?>

           <?php endwhile;
					 ?>
				 </div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>
