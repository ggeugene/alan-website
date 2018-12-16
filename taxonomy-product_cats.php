<?php
/**
 * The Template for displaying Product Category.
 *
 * @package WordPress
 * @subpackage Ohmy
 * @since Ohmy 1.0
 */


$position         =  neko_get_sidebar_layout();
$neko_blog_layout = get_theme_mod( 'blog_list_layout', 'default');
$header_display   = get_post_meta($post->ID, 'neko_page_header_display', true);

$queried_object = get_queried_object();
$brand = get_query_var('brand');

get_header();


/** Complementary options **/

?>
<main id="content" class="site-content">
	<div id="primary" class="content-area">
    <div class="custom-title-container">
      <div class="container">
        <!-- <div class="header-pusher"></div> -->
      <h3><?php echo __('The standard of true taste', 'workrocks'); ?></h3>
      </div>
    </div>
    <div class="custom-page-separator-container"><div class="custom-page-separator"></div></div>
    <div class="custom-page-content">
			<div class="custom-page-title">
				<?php if (!empty($brand) && strpos($brand, 'alan') == 0):?>
        <?php echo '<h2 class="tag-title">' . __('Products of TM', 'workrocks') . ' ' . __('Alan', 'workrocks') . '</h2>'; ?>
				<?php endif;
					echo '<h2 class="category-title">' . $queried_object->name . '</h2>';
					?>
        <div class="custom-spacer"></div>
      </div>
  		<div class="container">

  			<div class="col-sm-12">
  				<div class="row">

            <?php
						$strings = array();
						$flag = false;
						switch(ICL_LANGUAGE_CODE) {
							case 'uk':
								$alan = 'alan';
								$fitness = 'fitness';
								$muscle = 'spets-tsekh';
								break;
							case 'ru':
								$alan = 'alan-ru';
								$fitness = 'fitness-ru';
								$muscle = 'spets-tsekh-ru';
								break;
							case 'en':
								$alan = 'alan-en';
								$fitness = 'fitness-en';
								$muscle = 'spets-tsekh-en';
								break;
							default:
								$alan = 'alan';
								$fitness = 'fitness';
								$muscle = 'spets-tsekh';
								break;
						}
						if (!empty($brand) && strpos($brand, 'alan') == 0) {
							$flag = true;
							$strings[__('Alan','workrocks')] = get_post_by_tag_and_category($alan, $queried_object->slug);
						} else {
							$strings[__('Alan','workrocks')] = get_post_by_tag_and_category($alan, $queried_object->slug);
							$strings[__('Fitness','workrocks')] = get_post_by_tag_and_category($fitness, $queried_object->slug);
							$strings[__('Spets Tsekh','workrocks')] = get_post_by_tag_and_category($muscle, $queried_object->slug);
						}
						if(!empty($strings)) {
							foreach ($strings as $stringKey => $string) {
								if (!empty($string)) {
									if ($flag != true) {
										echo '<h2 class="category-title">' . __('Products of TM', 'workrocks') . ' ' . $stringKey . '</h2>';
										// echo ICL_LANGUAGE_CODE;
									}

									echo $string;
									// echo '<div class="loadmore-container"><div class="loadmore">Load More...</div></div>';
								}
							}
						}

            ?>

  				</div>
  			</div>
  		</div>
  </div>
	</div>
</main>
<?php get_footer(); ?>
