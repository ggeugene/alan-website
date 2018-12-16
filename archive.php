<?php
/**
 * Template to display posts list archive
 *
 * @package WordPress
 * @subpackage Ohmy
 * @since Ohmy 1.0
 */

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
                <?php echo __('Company', 'workrocks');?>
            </h2>
            <div class="custom-spacer"></div>
        </div>

		<div class="container">

			<div class="col-sm-12">
				<div class="row">
					<?php echo '<h2 class="blog-page-title">' . __('All news', 'workrocks') . '</h2>'; ?>

                    <?php if (have_posts() ) : ?>

                    <?php while ($wp_query->have_posts() ) : $wp_query->the_post(); ?>
							<?php $image = get_the_post_thumbnail_url();
								if(is_empty($image)) {
									$image = '/wp-content/themes/workrocks/img/image-placeholder.jpg';
								}
							?>


							<div class="post-item clearfix">
								<div class="col-sm-6">
									<a class="post-item-image-link" href="<?php the_permalink()?>">
										<div class="post-image-wrapper" style="background-image:url(<?php echo $image; ?>)"></div>
									</a>
								</div>
								<div class="col-sm-6">
									<div class="post-item-content">
										<div class="post-item-date"><span><?php the_date('d.m.Y'); ?> </span></div>
										<div class="post-item-title"><h3><?php the_title() ?></h3></div>
										<div class="post-item-excerpt"><?php the_excerpt(); ?></div>
										<div class="post-item-link custom-text-icon"><a href="<?php the_permalink(); ?>"><?php echo __('More','workrocks'); ?></a></div>
									</div>

								</div>
							</div>



                    <?php endwhile;
                    else : ?>

                    <?php get_template_part( 'no-results', 'index' ); ?>
                    <?php endif; ?>

				</div>
			</div>
		</div>
	</div>
</main>
<?php get_footer();
