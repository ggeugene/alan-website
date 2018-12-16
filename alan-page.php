<?php
/**
 * Template Name: Alan Page
 *
 * @package WordPress
 * @subpackage Ohmy
 * @since Ohmy 1.0
 */


$position         =  neko_get_sidebar_layout();
$neko_blog_layout = get_theme_mod( 'blog_list_layout', 'default');
$header_display   = get_post_meta($post->ID, 'neko_page_header_display', true);

$parent_page = get_post( $post->post_parent );

get_header();


/** Complementary options **/

?>
<main id="content" class="site-content">
	<div id="primary" class="content-area">

		<div class="custom-title-container" style="background: url(/wp-content/themes/workrocks/img/alan-page_title_background.jpg); background-size: cover; background-position: center; ">

      <div class="container">
        <!-- <div class="header-pusher"></div> -->
      <h3><?php echo __('The standard of true taste', 'workrocks'); ?></h3>
      </div>
    </div>
    <div class="custom-page-separator-container"><div class="custom-page-separator"></div></div>
    <div class="custom-page-content">
			<div class="custom-page-title">
            <h2>
                <?php if (get_the_title() == 'Перші особи' || get_the_title() == 'Первые лица' || get_the_title() == 'First persons') {
						echo __('Company', 'workrocks');
					} else the_title();
                ?>
            </h2>
        <div class="custom-spacer"></div>
      </div>
		<div class="container">

			<div class="col-sm-12">
				<div class="row">

          <?php while ( have_posts() ) : the_post(); ?>

           <?php the_content(); ?>

           <?php endwhile; // end of the loop.

					 ?>
				 </div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>
