<?php
/*
Common access points for action app template stuff call in other places
*/

/* package: pressinotheme */

class ActAppTpl {
	private static $instance;
	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new ActAppTpl();
		}
		return self::$instance;
	}

	
	public static function getHeaderMarkup($theText, $theSize = 'theme', $theColor = 'theme', $theIsPageHeader = false){
		$tmpRet = '';
		$tmpClasses = 'ui header';
		if( $theIsPageHeader ){
			$theSize = 'theme';
			$theColor = 'theme';
		}
		$tmpColor = $theColor;

		

		if( ($theSize) && $theSize != 'default' ){
			if( $theSize == 'theme'){
				$theSize = get_theme_mod( 'actappstd_header_size' );
			}
			$tmpClasses .= ' ' . $theSize;
		}
		if( $tmpColor == 'theme' || $tmpColor == 'default'){
			$tmpColorTheme = get_theme_mod( 'color_theme' );
			$tmpColorThemeHeader = get_theme_mod( 'actappstd_header_color' );
			if( $tmpColorThemeHeader == 'default' || $tmpColorThemeHeader == ''){
				$tmpColorThemeHeader = $tmpColorTheme;
			}
			$tmpColor = $tmpColorThemeHeader;
			
		}
		$tmpClasses .= ' '.$tmpColor;
		
		
		if( $theIsPageHeader ){
			$tmpUnderlined = get_theme_mod( 'actappstd_header_underlined' );
			if( $tmpUnderlined ){
				$tmpClasses .= ' dividing';
			}
		}

		$tmpRet .= '<div class="'.$tmpClasses.'">';
		$tmpRet .= $theText;
		$tmpRet .= '</div>';
		
		return $tmpRet;
	}

	public static function showContentHeader($thePageType = ''){
		$themeColor = get_theme_mod( 'color_theme' );
		// $themeSegmentUseColor = get_theme_mod( 'actappstd_segmented_theme_color' );
		$themeShowHeader = get_theme_mod( 'actappstd_show_header' );
		$tmpShowSegment = get_theme_mod( 'actappstd_segmented_content' );
		$themeContentPadding = get_theme_mod( 'actappstd_content_padding' );
		$themeSidebarSpacing = get_theme_mod( 'actappstd_sidebar_spacing' );
		$themeSidebarSize = get_theme_mod( 'actappstd_sidebar_size' );
		
		if( $themeSidebarSize == ''){
			$themeSidebarSize = '6';
		}

		$themeSidebarSizeNum = (int)$themeSidebarSize;
		$themeContentBodySize = 20 - $themeSidebarSizeNum;


		$tmpShowSidebar = true;
		// $themeContentBodySize = '7';
		// if( $themeSidebarSize == '1' ){
		// 	$themeContentBodySize = '9';
		// } else if( $themeSidebarSize == '2' ){
		// 	$themeContentBodySize = '8';
		// } else if( $themeSidebarSize == '4' ){
		// 	$themeContentBodySize = '6';
		// }
		
		
		
		if( $thePageType == 'full'  || $thePageType == 'blank' ){
			$tmpShowSidebar = false;
		}
		if( !($tmpShowSidebar)){
			$themeContentBodySizeMed = '12';
		}

		$tmpClassesSeg = $themeContentPadding;

		if( is_front_page() || $thePageType == 'blank' ){
			$themeShowHeader = false;
		}


		if( !$tmpShowSegment ){
			//--- Really use a segment but do not include the line, 
			//    this assures everything works the same, including site padding
			$tmpClassesSeg .= ' basic';
		// } else {
		// 	if( $themeSegmentUseColor ){
		// 		$tmpClassesSeg .= ' '. $themeColor;
		// 	}
		}
		
		$tmpSpacing = ' flo-flex-' . $themeContentBodySize;
		// $tmpClasses = ' col-md-'. $themeContentBodySizeMed.' '.$themeSidebarSpacing;
		$tmpClasses = 'flo-main' . $tmpSpacing;
		
		$tmpRet = '';
		$tmpRet .= '<div class="flo-wrap ' . $themeSidebarSpacing . '">'; 
		//actappsite-content-border 
		$tmpRet .= '  <div style="display: flex;" class="'.$tmpClasses.'">'; 

		//if( $tmpShowSegment ){
			$tmpRet .= '<div style="flex-grow: 1;" class="ui segment '.$tmpClassesSeg.'">'; 
		//}
		if($themeShowHeader ){
			$tmpRet .=  self::getHeaderMarkup(get_the_title(),'theme','theme',true);
			//$tmpRet .= '<div class="ui header large '.$themeColor.'">' . get_the_title() . '</div>'; 
		}

		echo($tmpRet);
		return true;
	}

	public static function showContenSidebar($thePageType = ''){
		$themeColor = get_theme_mod( 'color_theme' );
		// $themeSegmentUseColor = get_theme_mod( 'actappstd_segmented_theme_color' );

		$themeSegContent = get_theme_mod( 'actappstd_segmented_content' );
		$themeSegSidebar = get_theme_mod( 'actappstd_segmented_sidebar' );
		// $themeSegColor = get_theme_mod( 'actappstd_segmented_theme_color' );
		$themeSidebarSize = get_theme_mod( 'actappstd_sidebar_size' );

		if( $themeSidebarSize == '' ){
			$themeSidebarSize = '6';
		}

		$tmpShowSidebar = true;
		$themeContentPadding = get_theme_mod( 'actappstd_sidebar_padding' );
		$themeContentBodySizeMed = '9';
		$themeContentSidebarSizeMed = '3';
		if( $thePageType == 'full' || $thePageType == 'blank' ){
			$tmpShowSidebar = false;
		}

		$tmpSpacing = ' flo-flex-' . $themeSidebarSize;
		// $tmpClasses = ' col-md-'. $themeContentBodySizeMed.' '.$themeSidebarSpacing;
		$tmpClasses = 'flo-side-se' . $tmpSpacing;

		// $tmpClasses = ' col-md-'. $themeContentSidebarSizeMed;
		
		
		$tmpClassesSeg = $themeContentPadding;

		//if( $themeSegContent ){
			//--- End Segment that is always there
			echo('</div>'); 
		//}
		
		
		if( !$themeSegSidebar ){
			//--- Really use a segment but do not include the line, 
			//    this assures everything works the same, including site padding
			$tmpClassesSeg .= ' basic ';
		// } else {
		// 	if( $themeSegmentUseColor ){
		// 		$tmpClassesSeg .= ' '. $themeColor;
		// 	}
		}
		//--- End the content area section
		echo('</div>');
		
		//--- If we have a sidebar, add it here
		if($tmpShowSidebar){
			//actappsite-sidebar-border 
			echo( '<div style="display: flex;" class="'.$tmpClasses.'">');
			echo( '  <div style="flex-grow: 1;" class="ui segment '.$tmpClassesSeg.'">');
			get_sidebar(); 
			echo( '  </div>');
			echo('</div>');
		}
		
		return true;
	}


	public static function showContenFooter(){
		echo '</div>';
		return true;
	}

	public static function get_login_link(){
		$ret = '';
		if (!is_user_logged_in()) {
			$tmpHideLogin = get_theme_mod( 'actappstd_hide_login' );
			if( !($tmpHideLogin) ){
				$ret .= '<a class="ui item" href="' . wp_login_url($_SERVER["REQUEST_URI"]) . '"><i class="icon user"></i> Login</a>';
			}
		} else {
			$ret .= '<a class="ui item" href="' . wp_logout_url($_SERVER["REQUEST_URI"]) . '"><i class="icon user"></i> Logout</a>';
		}
		return $ret;
	}
	
	public static function get_mobile_nav_subs($key, $title, $tree, $parentkey = '', $parenttitle = ''){
		
		$ret = '<div appuse="cards" group="navtabs" item="menu-'.$key.'" class="hidden">
		<div class="ui inverted vertical menu top attached fluid">
		<a action="toggleNav" href="javascript:void(0)" class="item">
		<i class="close icon inverted"></i>
		Close
		</a>';

		//--- No title on the top
		$ret .= '<div class="ui header small center aligned black inverted pad8 mar0 mart5">' . $title . '</div>';
		// $ret .= '<div action="selectMe" group="navtabs" item="menu-'.$key.'" class="ui message basic mar0">
		// 	<i class="folder open outline icon "></i>
		// 	'.$title.'
		// </div>';

		$retsubs = '';
		$retmenus = '';
		foreach ( $tree as $treekey => $obj ) {
		
			$tmpTitle = $obj->title;			
			$tmpHasChildren = is_array($obj->children) && sizeof($obj->children) > 0;
			if( $tmpHasChildren ){
				$ret .= '<div action="selectMe" group="navtabs" item="menu-'.$treekey.'" class="ui dropdown item" tabindex="0">
				'.$tmpTitle .'<i class="dropdown icon"></i>
				</div>';
				$tmpChildMenu = self::get_mobile_nav_subs($treekey, $tmpTitle, $obj->children, $key, $title);

				$retmenus .= ''.$tmpChildMenu;
			} else {
				$tmpURL = $obj->url;
				$ret .= '<a href="'.$tmpURL.'" class="item">';
				$ret .= $tmpTitle;
				$ret .= '</a>';
			}
		}
		
		if( $parentkey == ''){
			$ret .= '<a action="selectMe" group="navtabs" item="menu-top" href="javascript:void(0)" class="item">
			<i class="left arrow icon inverted"></i>
			Main Menu
			</a>';
		} else {
			$tmpRetTitle = 'Go Back';
			if( $parenttitle ){
				$tmpRetTitle = $parenttitle;
			}
			$ret .= '<a action="selectMe" group="navtabs" item="menu-' . $parentkey . '" href="javascript:void(0)" class="item">
			<i class="left arrow icon inverted"></i>
			' . $tmpRetTitle . '
			</a>';
		}

		$ret .= '</div></div>';

		return $ret . $retmenus;
	}
	
	public static function get_mobile_nav($tree){
		$retsubs = '';
		$themeColors = ActAppThemeOptions::get_theme_colors();
		$themeColor = $themeColors['maincolor'];
		$inverted = '';
		if( $themeColor != "white"  ){
			$inverted = ' inverted ';
		}
	
		$ret = '<div appuse="cards" group="navtabs" item="menu-top">
		<div class="ui ' .$themeColor . ' ' .  $inverted . ' vertical menu top attached fluid">
		  <a action="toggleNav" href="javascript:void(0)" class="item">
			<i class="close icon inverted"></i>
			Close
		  </a>';

		  foreach ( $tree as $key => $obj ) {
			$tmpTitle = $obj->title;			
			$tmpHasChildren = is_array($obj->children) && sizeof($obj->children) > 0;
			if( $tmpHasChildren ){
				$ret .= '<div action="selectMe" group="navtabs" item="menu-'.$key.'" class="ui dropdown item" tabindex="0">
				'.$tmpTitle.'<i class="dropdown icon"></i>
			  </div>';
			  $retsubs .= ''.self::get_mobile_nav_subs($key, $tmpTitle, $obj->children);
			} else {
				$tmpURL = $obj->url;
				$ret .= '<a href="'.$tmpURL.'" class="item">';
				$ret .= $tmpTitle;
				$ret .= '</a>';
			}
		}
	

		// $ret .= '<a action="toggleNav" href="javascript:void(0)" class="item">
		// <i class="close icon inverted"></i>
		// Close Menu
		// </a>';

		$ret .= '</div></div>';
	
		
		return $ret.$retsubs;
	}

	
	public static function get_mobile_nav_for_loc($theLocationName){
		$menuname = self::get_menu_for_location( $theLocationName );
		$tree = self::get_menu_tree( $menuname );
		return self::get_mobile_nav($tree);
	}
	public static function get_menu_nav_for_loc($theLocationName){
		$menuname = self::get_menu_for_location( $theLocationName );
		$tree = self::get_menu_tree( $menuname );
		return self::get_menu_nav($tree);
	}
	public static function get_mobile_nav_for_menu($theMenuName){
		$tree = self::get_menu_tree( $theMenuName );
		return self::get_mobile_nav($tree);
	}
	public static function get_menu_nav_for_menu($theMenuName){
		$tree = self::get_menu_tree( $theMenuName );
		return self::get_menu_nav($tree);
	}
	public static function get_menu_nav($tree){
		$ret = '';
		foreach ( $tree as $key => $obj ) {
			$tmpTitle = $obj->title;			
			$tmpHasChildren = is_array($obj->children) && sizeof($obj->children) > 0;
			if( $tmpHasChildren ){
				$ret .= '<div appcomp="dropdown" class="ui dropdown item nomobile actappstd-nav-menu">';
				$ret .= $tmpTitle.'<i class="dropdown icon"></i>';
				$ret .= ' <div class="menu">';
				$ret .= ''.self::get_menu_nav($obj->children);
				$ret .= ' </div>';
				$ret .= '</div>';
			} else {
				$tmpURL = $obj->url;
				$ret .= '<a href="'.$tmpURL.'" class="item nomobile"><div class="actappstd-nav-menu">';
				$ret .= $tmpTitle;
				$ret .= '</div></a>';
			}
		}
		return $ret;
	}

	public static function get_menu_for_location( $theName ) {
		$locations = get_nav_menu_locations();
		$menu = wp_get_nav_menu_object( $locations[ $theName ] );	
		if( $menu != null ){
			return $menu->name;	
		}
		return false;		
	}

	public static function get_menu_tree( $theItemArrayOrName ) {
		if( is_string($theItemArrayOrName)){
			$nav_menu_items_array = wp_get_nav_menu_items( $theItemArrayOrName );
		} else {
			$nav_menu_items_array = $theItemArrayOrName;
		}

		// $nav_menu_items_array = $nav_menu_items_array_or_name;
		
		foreach ( $nav_menu_items_array as $key => $value ) {
			$value->children = array();
			$nav_menu_items_array[ $key ] = $value;
		}
		
		$nav_menu_levels = array();
		$index = 0;

		//--- ToDo: Revisit this
		$last_level_ids = array();

		if ( ! empty( $nav_menu_items_array ) ) do {
			if ( $index == 0 ) {
				foreach ( $nav_menu_items_array as $key => $obj ) {
					if ( $obj->menu_item_parent == 0 ) {						
						$nav_menu_levels[ $index ][] = $obj;
						unset( $nav_menu_items_array[ $key ] );
					}
				}
			} else {
				foreach ( $nav_menu_items_array as $key => $obj ) {
					if ( in_array( $obj->menu_item_parent, $last_level_ids ) ) {
						$nav_menu_levels[ $index ][] = $obj;
						unset( $nav_menu_items_array[ $key ] );
					}
				}
			}
			$last_level_ids = wp_list_pluck( $nav_menu_levels[ $index ], 'db_id' );
			$index++;
		} while ( ! empty( $nav_menu_items_array ) );
	
		$nav_menu_levels_reverse = array_reverse( $nav_menu_levels );
	
		$nav_menu_tree_build = array();
		$index = 0;
		if ( ! empty( $nav_menu_levels_reverse ) ) do {
			if ( count( $nav_menu_levels_reverse ) == 1 ) {
				$nav_menu_tree_build = $nav_menu_levels_reverse;
			}
			$current_level = array_shift( $nav_menu_levels_reverse );
			if ( isset( $nav_menu_levels_reverse[ $index ] ) ) {
				$next_level = $nav_menu_levels_reverse[ $index ];
				foreach ( $next_level as $nkey => $nval ) {
					foreach ( $current_level as $ckey => $cval ) {
						if ( $nval->db_id == $cval->menu_item_parent ) {
							$nval->children[] = $cval;
						}
					}
				}
			}
		} while ( ! empty( $nav_menu_levels_reverse ) );
	
		$nav_menu_object_tree = $nav_menu_tree_build[ 0 ];
		return $nav_menu_object_tree;
	}

	
	public static function showRecentPosts($theMax = 0, $thePage = 1){
		$tmpLatest = self::getRecentPosts($theMax,$thePage);
		$tmpPosts = $tmpLatest;		
		var_dump($tmpPosts);
	}

	public static function getRecentPosts($theMax = 0, $thePage = 1){

		
		// Query arguments.
		$query = array(
		);
	
		// Exclude current post
		$query['post__not_in'] = array(get_the_ID());
		//array("posts_per_page"=>"2","paged"=>"1")
		if( $theMax > 0){
			$query['posts_per_page'] = ''.$theMax;	
			$query['paged'] = ''.$thePage;	
		}
		
		//$query['posts_per_page'] = "2";

		// Perform the query.
		$posts = new WP_Query($query);
	
		return $posts;
	
}

	/**
	 * Initialize ... usually run in 'init' add_action
	 */
	public static function init() {
		//self::do_something_on_startup();
	}

}

add_action( 'init', array( 'ActAppTpl', 'init' ) );
