<?php 
/*
Plugin Name: Stock Toolkit
*/

#widgests
//-----------------

add_action( 'init', 'my_theme_custom_post' );
function my_theme_custom_post() {
    register_post_type( 'Testimonial',
        array(
            'labels' => array(
                'name' => __( 'Testimonials' ),
                'singular_name' => __( 'Testimonial' )
            ),
            'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
            'public' => false,
			'show_ui' => true,         // if wnat to change the icon add menu icon option
        )
    );
}


#shortcodes
//---------------

function post_list_shortcode($atts){
    extract( shortcode_atts( array(
        'count' => -1,   // if -1 then all post will come
        'type' => 'post' ,
        'color' => '#D54E21', 
        'icon' => '' 
    ), $atts) );
     
    $q = new WP_Query(
			array('posts_per_page' => $count,
				'post_type' => 'page',
				'post_type' => $type
				)
			);      
         
    $list = '<ul>';
    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
        $custom_field = get_post_meta($idd, 'custom_field', true);
        $post_content = get_the_content();
      //  $list .= '<li><a style="'.$color.'" href="'.get_permalink().'">'.get_the_title().'</a></li>'; 
        
		$list .= '<li><a style="color:'.$color.'" href="'.get_permalink().'">';
			
			if(!empty($icon)){
				$list .='<i class="'.$icon.'"></i>';
				
			}
			
		$list.=''.get_the_title().'</a></li>'; 
		
    endwhile;
    $list.= '</ul>';
    wp_reset_query();
    return $list;
}
add_shortcode('post_list', 'post_list_shortcode');  
	
#vc_ADDons
//-----------------------	
	
	function stock_vc_postlist_addon(){
		vc_map( array(
			  "name" => __( "Post list", "my-text-domain" ),
			  "base" => "post_list",              // which shortcode do i want to integrate
			 // "class" => "",
			  "category" => __( "Stock", "my-text-domain"),
			 // 'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),  // if we dont want css in admin
			 // 'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
			  "params" => array(
				 array(
					"type" => "dropdown",
					//"holder" => "div",
					//"class" => "",
					"heading" => __( "Post type", "my-text-domain" ),
					"param_name" => "type",                               // attributes name
					"std" => "post",                               // attributes name
					"value" => array(                               // if dropdown then it will change
							"Page" => "page",
							"Post" => "post",
					),   // default value  // std dile def asbe
					"description" => __( "Type post here", "my-text-domain" )
				 ),
				 array(
					"type" => "textfield",
					"heading" => __( "Post count", "my-text-domain" ),
					"param_name" => "count",
					"value" => __( "-1", "my-text-domain" ),  					
					"description" => __( "how many item do you want to show. -1 for unlimited ", "my-text-domain" ),
					"dependency" => array(
						"element"=> "type",
						"value"=> "post"       // if post then value -1 will appear
					)
				 ),
				 array(
					"type" => "colorpicker",
					"heading" => __( "Link color", "my-text-domain" ),
					"param_name" => "color",
					"value" => __( "#D54E21", "my-text-domain" ),  					     // default value shold be in shordcode also
					"description" => __( "Choose your color", "my-text-domain" )
				 ),
				 array(
					"type" => "vc_link",
					"heading" => __( "Link color", "my-text-domain" ),
					"param_name" => "color",
					"description" => __( "Choose your color", "my-text-domain" )
				 ),
				 array(
					"type" => "iconpicker",
					"heading" => __( "Icon", "my-text-domain" ),
					"param_name" => "icon",
					//"value" => __( "fa fa-link", "my-text-domain" ),  					     // default value shold be in shordcode also
					"description" => __( "Choose your icon very carefully ", "my-text-domain" )
				 )
			  )
		   )
		 );
		
	}
	add_action('vc_before_init','stock_vc_postlist_addon');

	
	
# stock-toolkit.php (sturctured)
//--------------------------------------
/*
Plugin Name: Stock Toolkit
*/

// Exit if accessed directly
if( ! defined('ABSPATH')){
	exit;
}

//define
define('STOCK_ACC_URL',WP_PLUGIN_URL.'/'.plugin_basename(dirname(__FILE__)).'/');
define('STOCK_ACC_PATH',plugin_dir_path(__FILE__));

add_action( 'init', 'my_theme_custom_post' );
function my_theme_custom_post() {
    register_post_type( 'Testimonial',
        array(
            'labels' => array(
                'name' => __( 'Testimonials' ),
                'singular_name' => __( 'Testimonial' )
            ),
            'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
            'public' => false,
			'show_ui' => true, 
        )
    );
}


//Print Shortcodes in widgets
add_filter('widget_text','do_shortcode');

// Loading VC addons
//require_once(STOCK_ACC_PATH.'vc-addons/bc-blocks-load.php');

// Theme sortcodes
//require_once(STOCK_ACC_PATH.'theme-shortcodes/slides-shortcode.php');

// Shortcodes depended on vc
include_once(ABSPATH.'wp-admin/includes/plugin.php');
if(is_plugin_active('js_composer/js_composer.php')){
	//	require_once(STOCK_ACC_PATH. 'theme-shortcodes/staff-shortcode.php');
	
}


//Registering stock toolkit filesize

function stock_toollit_files(){
	
	wp_enqueue_style('owl-carousel', plugin_dir_url(__FILE__).'assets/css/owl.carousel.css');
	wp_enqueue_scripts('owl-carousel', plugin_dir_url(__FILE__).'assets/js/owl.carousel.min.js',array('jquery'),'232323', true);
	
}

add_action('wp_enqueue_scripts','stock_toollit_files');





# vc-blocks-load.php
//---------------------
<?php

if(!defined('ABSPATH')) die(-1);

// class started

class stockVCExtendAddonsClass{
	
	function __construct(){
		// we safely integrate with Vc with this hook
		add_action('init',array($this,'stockIntegrateWithVC'));
	}
	
	public function stockIntegrateWithVC(){
		
		// check if visula composer is not installed	
		if(!defined('WPB_VC_VERSION')){
			add_action('admin_notices',array($this,'stockShowVvBersionNotice'));
			return;			
		}
		// vc addons
		include STOCK_ACC_PATH.'/vc-addons/vc-slides.php';
		
	}
	//show vc versions

	public function stockShowVvBersionNotice(){
		$theme_data = wp_get_theme();
		echo '
		<div class="notice notice-warning">
			<p>'.sprintf(__('<strong>%s</strong> recomends <strong><a href="'.site_url().'/wp-admin/theme.php?page=tgmpa-install-pluings" target="_blank"> Visula COmposer</a></strong> plugin to be installed and activated on your site.','stock-crazecafe'), $theme_data->get('name')).'</p>
		</div>';
		
	}
	
}
// Finally instialize code
new stockVCExtendAddonsClass();




?>


















?>


























?>