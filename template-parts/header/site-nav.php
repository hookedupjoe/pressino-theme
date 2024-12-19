<?php
/**
 * Displays the site navigation.
 *
 * @package pressinotheme
 * @since 1.0.0
 */

//echo '<script>window.test1=1</script>';
//ToDo: Check for menu override and use below
?>

<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
	<?php
	
	$menuname = ActAppTpl::get_menu_for_location( 'menu-1' );
	$tree = ActAppTpl::get_menu_tree( $menuname );
	$json = json_encode( $tree );
	$inverted = '';
	$themeColors = ActAppThemeOptions::get_theme_colors();
	$colorThemeSetting = $themeColors['maincolor'];
	if( $colorThemeSetting != "white"  ){
		$inverted = ' inverted ';
	}
	
	//--- ToDo
//$themeLayout = ActAppThemeOptions::get_theme_layout();
// $themeFrameClasses = '';
// $themeFrameClasses = 'full-container';

$themeIsFull = get_theme_mod('actappstd_full_content');
$themeFrameClasses = 'full-container-wide';
if( $themeIsFull !== true ){
	$themeFrameClasses = 'full-container';
}


	?>
	<div class="nav-area noprint">
	<nav class="<?php echo $themeFrameClasses ?>">
    <div class="ui <?php echo $inverted . ' ' . $colorThemeSetting ?> horizontal top menu">
	
	<?php
	
	$ret = '<div action="toggleNav" class="ui item mobileonly">
		<i class="sidebar icon inverted"></i>
		&nbsp;Menu
		</div>';

	$ret .= ActAppTpl::get_menu_nav_for_loc('menu-1');
	//demo-> $ret .= ActAppTpl::get_menu_nav_for_menu('app1');

	$ret .= '<div class="right menu inverted">'.ActAppTpl::get_login_link().'</div>';

	echo $ret;

	echo ('<script>ActionAppCore.navMenu = '.$json.'</script>');
 
  ?>
	</div>
  </nav>
  </div>
  	<?php endif; ?>
