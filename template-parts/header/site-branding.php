<?php
/**
 * Displays header site branding
 *
 * @package pressinotheme
 * @since 1.0.0
 */


 $themeIsFull = get_theme_mod('actappstd_full_content');
 $themeFrameClasses = 'full-container-wide';
 if( $themeIsFull !== true ){
   $themeFrameClasses = 'full-container container';
 }

?>

<div class="site-branding-header">
  <div id="masthead" class="page-header">
    <div class="<?php echo($themeFrameClasses); ?>">

    <?php if ( is_active_sidebar( 'sidebar-h' ) ) {?>
      <?php dynamic_sidebar( 'sidebar-h' ); ?>
      <?php } else { ?>
      	<!-- ToDo: Make this a customize option, add images, etc (or create header widget?) -->
        <a href="<?php echo home_url( '/' ); ?>" title="<?php echo get_option( 'blogname' ); ?>" rel="home" class="logo">
        <h1 class="ui message basic large blue"><?php echo get_bloginfo( 'name' ); ?></h1>
              <!-- <img src="http://localhost/sae/wp-content/uploads/2020/11/SAE-Detroit.png" class="logo-height-constrain" width="250" height="80" alt="SAE Detroit Section Logo"> -->
        </a>
    <?php }?>

	  <div style="clear:both;"></div>
    </div>
  </div>  
</div>

