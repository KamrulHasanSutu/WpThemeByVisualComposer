<?php

// stock-toolkit.php
//--------------------------

// function of list of vc servies
function stock_toolkit_get_servies_as_list(){
	
		$args = wp_parse_args(array(
			'post_type' => 'page',
			'numberposts' => -1,
		) );
		$posts = get_posts( $args );
		
		$post_options = array(esc_html__('-- Select slide --', 'stock-toolkit')=>'');
		
		if($posts){
			foreach($posts as $post){
				$post_options[ $post->post_title] = $post->ID;
			}
			
		}
		return $post_options;
	
} 



// Theme sortcodes
require_once(STOCK_ACC_PATH.'theme-shortcodes/service-shortcode.php');

// vc-blocks-load.php
//--------------------------

	public function stockIntegrateWithVC(){
		
		// check if visula composer is not installed	
		if(!defined('WPB_VC_VERSION')){
			add_action('admin_notices',array($this,'stockShowVvBersionNotice'));
			return;			
		}
		// vc addons
		include STOCK_ACC_PATH.'/vc-addons/vc-slides.php';
		include STOCK_ACC_PATH.'/vc-addons/vc-logo-carosel.php';
		include STOCK_ACC_PATH.'/vc-addons/vc-service.php';
		
	}

// vc-logo-carosel.php
//--------------------------


vc_map( array(
			  "name" => __( "Stock service carousel", "my-text-domain" ),
			  "base" => "stock_service_carousel",  
			  "category" => __( "Stock", "my-text-domain"),
			  "params" => array(
				 array(
					"type" => "textfield",
					"heading" => __( "title", "my-text-domain" ),
					"param_name" => "title",                 
					"description" => __( "", "my-text-domain" )
				   ),
				   array(
					"type" => "textarea",
					"heading" => __( "content", "my-text-domain" ),
					"param_name" => "desc",                                                           
					"description" => __( "", "my-text-domain" ),
				   ),
				   array(
					"type" => "dropdown",
					"heading" => __( "Link type", "my-text-domain" ),
					"param_name" => "type",                               
					"std" => __( "1", "my-text-domain" ),
					"value" => array(
						'Link to paye' => 1,
						'External link'  => 2,
					),
					"description" => __( "", "my-text-domain" )
				   ),
				   
				   array(
					"type" => "dropdown",
					"heading" => __( "link to page", "my-text-domain" ),
					"param_name" => "link_to_page", 
					"value"=>stock_toolkit_get_servies_as_list(),
					"description" => __( "", "my-text-domain" ),
					"dependency"  => array(
						"element" => "type",
						"value"   =>array("1"),
					)
				   ),
				    array(
					"type" => "textfield",
					"heading" => __( "External link", "my-text-domain" ),
					"param_name" => "erternal_link",                 
					"description" => __( "", "my-text-domain" ),
					"dependency"  => array(
						"element" => "type",
						"value"   =>array("2"),
					)
				   ),
				    array(
					"type" => "textfield",
					"heading" => __( "link text", "my-text-domain" ),
					"param_name" => "link_text", 
					"std" => __( "See more", "my-text-domain" ),
					"description" => __( "", "my-text-domain" ),	
				   ),
				   
				   array(
					"type" => "dropdown",
					"heading" => __( "icon type", "my-text-domain" ),
					"param_name" => "icon_type",                               
					"std" => __( "1", "my-text-domain" ),
					"value" => array(
						'Upload' => 1,
						'FontAwesome'  => 2,
					),
					"description" => __( "", "my-text-domain" ),
				   ),
				    array(
					"type" => "attach_image",
					"heading" => __( "Upload icon", "my-text-domain" ),
					"param_name" => "upload_icon",                 
					"description" => __( "", "my-text-domain" ),
					"dependency"  => array(
						"element" => "icon_type",
						"value"   =>array("1"),
					)
				   ),
				    array(
					"type" => "iconpicker",
					"heading" => __( "Choose icon", "my-text-domain" ),
					"param_name" => "choose_icon",                 
					"description" => __( "", "my-text-domain" ),
					"dependency"  => array(
						"element" => "icon_type",
						"value"   =>array("2"),
					)
				   ),
				   
				     array(
					"type" => "attach_image",
					"heading" => __( "Box background", "my-text-domain" ),
					"param_name" => "box_background",                                    
					"description" => __( "", "my-text-domain" ),
				   ),

				
			    )
		    )
	    );



// logo-carosel-shortcode.php
//-----------------------------

<?php

function stock_service_box_shortcode($atts, $content = null){
	
	extract( shortcode_atts( array(
        'title' => '',
        'desc' => '',
        'type' => 1,
        'link_to_page' => '',
        'erternal_link' => '',
        'link_text' => 'See more',
        'icon_type' => 1,
        'upload_icon' => '',
        'choose_icon' => '',
        'box_background' => '',
    ), $atts) );	

	$stock_service_box_markup .= '';
	return $stock_service_box_markup;
	
}

add_shortcode('stock_service_box', 'stock_service_box_shortcode');  


?>


