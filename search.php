<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Ohmy
 * @since Ohmy 1.0
 */



$blogPageId = get_option('page_for_posts', true) ;
$page_object = get_page( $blogPageId );




$position           = neko_get_sidebar_layout();
$neko_blog_layout   = get_theme_mod( 'blog_list_layout', 'default');
$total_featured_img = 4;
$main_container_class = 'container';
$blog_layout_class = ( !empty($neko_blog_layout) ) ? 'neko-blog-'.$neko_blog_layout : '' ;

get_header();

?>


<main id="page-content" role="main"  class="site-content <?php echo  esc_attr($blog_layout_class) ?>">
	<div id="primary" class="content-area">
        <div class="custom-title-container" style="background: url(/wp-content/themes/workrocks/img/alan-page_title_background.jpg); background-size: cover; background-position: center; ">

      <div class="container">
        <!-- <div class="header-pusher"></div> -->
      <h3><?php echo __('The standard of true taste', 'workrocks'); ?></h3>
      </div>
        </div>
        <div class="custom-page-separator-container"><div class="custom-page-separator"></div></div>

  <?php get_template_part( 'page', 'header'); ?>

		<div class="custom-page-content">
			<div class="custom-page-title">
			<h2>
				<?php echo __('Search', 'workrocks');
				?>
			</h2>
		<div class="custom-spacer"></div>
	  </div>
			<div class="container">
				<div class="col-sm-12">
					<div class="row">
					<?php get_search_form(); ?>

					<?php if (have_posts() ) : ?>

						<?php while ( have_posts() ) : the_post(); ?>
							<article class="search-result row search-result-item">
								<a href="<?php the_permalink(); ?>" class="search-result-item-wrap">
									<div class="col-md-6">
										<header class="entry-header">
											<h2 class="entry-title">
												<?php  the_title(); ?>
											</h2>
										</header>
										<div class="entry-summary">
											<?php the_excerpt(); ?>
										</div>
									</div>
									<div class="col-md-6" style="padding: 10px 0; text-align: center;">
										<?php the_post_thumbnail(); ?>
									</div>
								</a>
							</article>

							<?php endwhile; ?>

							<div class="neko-search-pagination">
							<?php
							the_posts_pagination( array(
								'prev_text'          => __( 'Previous page', 'ohmy' ),
								'next_text'          => __( 'Next page', 'ohmy' ),
								'screen_reader_text' => __( 'Search pagination', 'ohmy' )
								) );
							?>
							</div>

						<?php else : ?>

							<?php get_template_part( 'no-results', 'index' ); ?>

						<?php endif; ?>
			<!-- 		</div> -->
					</div>
				</div>
			</div>
		</div>
	</main>
	<?php get_footer(); ?>
