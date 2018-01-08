<?php
function habakiri_child_theme_setup(){
	class Habakiri extends Habakiri_Base_Functions{
		// wp_enqueue_scripts は親テーマで定義済みなので__construct()でフックさせる必要はありません
		public function wp_enqueue_scripts(){
			// Habakiri の wp_enqueue_scripts をまず実行する
			parent::wp_enqueue_scripts();
		}
		
		public function habakiri_theme_mods_defaults( $pre_defaults ) {
			$defaults = shotcode_atts(
				$pre_defaults,
				array(
					'logo'                             => '',
					'logo_text_color'                  => '#000',
					'header'                           => 'header--default',
					'header_fixed'                     => '',
					'footer_columns'                   => 'col-md-4',
					'blog_template'                    => 'right-sidebar',
					'search_template'                  => 'right-sidebar',
					'404_template'                     => 'right-sidebar',
					'is_displaying_thumbnail'          => 'true',
					'is_displaying_bread_crumb'        => 'true',
					'is_displaying_related_posts'      => 'true',
					'is_displaying_page_header'        => 'true',
					'is_displaying_page_header_lead'   => 'true',
					'link_color'                       => '#337ab7',
					'link_hover_color'                 => '#23527c',
					'gnav_bg_color'                    => '#fff',
					'gnav_link_color'                  => '#000',
					'gnav_link_hover_color'            => '#337ab7',
					'gnav_link_bg_color'               => '#fff',
					'gnav_link_bg_hover_color'         => '#fff',
					'gnav_sub_label_color'             => '#777',
					'gnav_sub_label_hover_color'       => '#777',
					'gnav_pulldown_link_color'         => '#777',
					'gnav_pulldown_link_hover_color'   => '#337ab7',
					'gnav_pulldown_bg_color'           => '#000',
					'gnav_pulldown_bg_hover_color'     => '#191919',
					'offcanvas_nav_fontsize'           => 12,
					'offcanvas_nav_direction'          => 'right',
					'hamburger_btn_text_color'         => '#000',
					'hamburger_btn_text_hover_color'   => '#000',
					'hamburger_btn_border_color'       => '#eee',
					'hamburger_btn_border_hover_color' => '#eee',
					'hamburger_btn_bg_color'           => '#fff',
					'hamburger_btn_bg_hover_color'     => '#f5f5f5',
					'header_bg_color'                  => '#fff',
					'footer_bg_color'                  => '#111113',
					'footer_text_color'                => '#555',
					'footer_link_color'                => '#777',
					'page_header_bg_color'             => '#222',
					'page_header_text_color'           => '#fff',
					'gnav_breakpoint'                  => 'md',
					'gnav_fontsize'                    => 12,
					'gnav_sub_label_fontsize'          => 10,
					'gnav_link_horizontal_padding'     => 15,
					'gnav_link_vertical_padding'       => 23,
					'slider_option_effect'             => 'horizontal',
					'slider_option_interval'           => 4000,
					'slider_option_speed'              => 500,
					'slider_option_overlay_color'      => '#000',
					'slider_option_overlay_opacity'    => '90',
					'slider_option_height'             => 0,
					'slider_option_target_1'           => false,
					'slider_option_target_2'           => false,
					'slider_option_target_3'           => false,
					'slider_option_target_4'           => false,
					'slider_option_target_5'           => false,
					'excerpt_length'                   => ( get_locale() == 'ja' ) ? 110 : 220,
				)
			);
			return $defaults;
		}
	}
}
add_action('after_setup_theme','habakiri_child_theme_setup');

if(!function_exists('is_mobile')):
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
