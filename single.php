<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Ohmy
 * @since Ohmy 1.0
 */

get_header();
$terms = get_the_category($post);
$category_name = $terms[0]->name;

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
                <?php echo $category_name; ?>
            </h2>
        <div class="custom-spacer"></div>
      </div>
		<div class="container">

			<div class="col-sm-12">
				<div class="row">

          <?php while ( have_posts() ) : the_post(); ?>
              <?php  the_title('<h2 class="single-post-title">', '</h2>'); ?>
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
