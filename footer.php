<?php
/**
 * The template for displaying the footer
 * @package actapptpl
 * @since 1.0.0
 */


$themeIsFull = get_theme_mod('actappstd_full_content');
$themeFrameClasses = 'full-container-wide';
if( $themeIsFull !== true ){
	$themeFrameClasses = 'full-container container';
}


?>


			
		</div><!-- #primary -->		
		</div><!-- content -->	
		</div><!-- container -->	
	


<div class="page-footer noprint">
  <div class="<?php echo($themeFrameClasses); ?>">
<!-- Footer Start -->
<?php if ( is_active_sidebar( 'sidebar-f' ) ) {?>
	<?php dynamic_sidebar( 'sidebar-f' ); ?>
<?php }?>
<!-- Footer End -->
  </div>
</div>

	
<?php wp_footer(); ?>

</div><!-- #page -->
</body>
</html>


