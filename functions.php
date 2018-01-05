<?php
function habakiri_child_theme_setup(){
		class Habakiri extends Habakiri_Base_Functions{
		// wp_enqueue_scripts は親テーマで定義済みなので__construct()でフックさせる必要はありません
		public function wp_enqueue_scripts(){
			// Habakiri の wp_enqueue_scripts をまず実行する
			parent::wp_enqueue_scripts();
		}
	}
}
add_action('after_setup_theme','habakiri_child_theme_setup');


function is_mobile() {
    $useragents = array(
        'iPhone',          // iPhone
        'iPod',            // iPod touch
        '^(?=.*Android)(?=.*Mobile)', // 1.5+ Android
        'dream',           // Pre 1.5 Android
        'CUPCAKE',         // 1.5+ Android
        'blackberry9500',  // Storm
        'blackberry9530',  // Storm
        'blackberry9520',  // Storm v2
        'blackberry9550',  // Storm v2
        'blackberry9800',  // Torch
        'webOS',           // Palm Pre Experimental
        'incognito',       // Other iPhone browser
        'webmate'          // Other iPhone browser
    );
    $pattern = '/'.implode('|', $useragents).'/i';
    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}


function add_scripts() {
 if ( is_home() || is_front_page() ) {
	 wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/js/main.js', array( 'jquery' ), '20170505', true );
}
}
add_action('wp_print_scripts', 'add_scripts');


function my_habakiri_title_class_in_page_header( $class ) {
if ( is_home() || is_front_page() ) {
	$class = 'page-header__home';
} else {
	$class = 'page-header__page';
}
	return $class;
}
add_filter( 'habakiri_title_class_in_page_header', 'my_habakiri_title_class_in_page_header' );

function my_habakiri_copyright( $copyright ) {
	$copyright = '&copy;  All Rights Reserved.';
	return $copyright;
}
add_filter( 'habakiri_copyright', 'my_habakiri_copyright' );
?>