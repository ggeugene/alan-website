<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Edena
 * @since Edena 1.0
 */


$footer_layout = get_theme_mod( 'footer_layout', 'full');
$footer_type   = get_theme_mod( 'footer_type', 'none');
$footer_width  = ( true == get_theme_mod( 'footer_width', false ) ) ? 'container-fluid' : 'container';
?>


<!-- footer -->
<footer id="main-footer-wrapper" class="neko-footer">
	<?php if( !empty($footer_type) && 'none' !== $footer_type ){  ?>
		<div  id="main-footer">
			<div class="<?php echo esc_attr($footer_width); ?>">
				<div class="row">
					<?php
						switch ($footer_layout){

							case 'full':
							echo
							'<div class="col-sm-12 nk-footer-centered">'.neko_get_dynamic_sidebar('footer-area-1').'</div>';
							break;

							case '3cols':
							echo
							'<div class="col-md-4">'.neko_get_dynamic_sidebar('footer-area-1').'</div>
							 <div class="col-md-4">'.neko_get_dynamic_sidebar('footer-area-2').'</div>
							 <div class="col-md-4">'.neko_get_dynamic_sidebar('footer-area-3').'</div>';
							break;


							case '4cols':
							echo
							'<div class="col-md-3 col-sm-6">'.neko_get_dynamic_sidebar('footer-area-1').'</div>
							 <div class="col-md-3 col-sm-6">'.neko_get_dynamic_sidebar('footer-area-2').'</div>
							 <div class="col-md-3 col-sm-6">'.neko_get_dynamic_sidebar('footer-area-3').'</div>
							 <div class="col-md-3 col-sm-6">'.neko_get_dynamic_sidebar('footer-area-4').'</div>';
							break;

							case '2tier1tier':
							echo
							'<div class="col-md-8">'.neko_get_dynamic_sidebar('footer-area-1').'</div>
							 <div class="col-md-4">'.neko_get_dynamic_sidebar('footer-area-2').'</div>';
							break;

							case '1tier2tier':
							echo
							'<div class="col-md-4">'.neko_get_dynamic_sidebar('footer-area-1').'</div>
							 <div class="col-md-8">'.neko_get_dynamic_sidebar('footer-area-2').'</div>';
							break;

							case '1demi1demi':
							echo
							'<div class="col-md-6 col-sm-6">'.neko_get_dynamic_sidebar('footer-area-1').'</div>
							 <div class="col-md-6 col-sm-6">'.neko_get_dynamic_sidebar('footer-area-2').'</div>';
							break;

							default:
							$col_content =
							'<div class="col-sm-12">'.neko_get_dynamic_sidebar('footer-area-1').'</div>';
							break;

						}

					 ?>
				</div>
			</div>

		</div>
    <div class="sub-footer">
		<div class="container">
			<div class="col-sm-6">
				<span>© 2018 <?php echo __('Alan. All rights reserved', 'workrocks') ?></span>
			</div>
			<div class="col-sm-6">
				<span><?php echo __('Developed by', 'workrocks') . ' <a href="https://workrocks.com/wp-development/" target="_blank">Workrocks</a>' ?></span>
			</div>
		</div>
	</div>
	<?php } ?>

 <?php if ( true == ( get_theme_mod('copyright', true) ) ){?>
	<div id="copyright">
		<div class="<?php echo esc_attr($footer_width); ?>">
			<div class="row">
				<div class="col-md-12 text-center">
					<p>
						<?php echo wp_kses_post( get_theme_mod( 'copyright_text', 'Copyright &copy; Little NEKO / All rights reserved.') );?></p>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>

</footer>
<!-- footer -->



</div>
<!-- #globalWrapper -->

<?php wp_footer(); ?>
</body>
</html>
