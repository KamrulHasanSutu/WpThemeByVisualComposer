
<?php

// stock-toolkit.php
//--------------------------
// Theme sortcodes
require_once(STOCK_ACC_PATH.'theme-shortcodes/logo-carosel-shortcode.php');
require_once(STOCK_ACC_PATH.'theme-shortcodes/cta-shortcode.php');

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
		include STOCK_ACC_PATH.'/vc-addons/vc-cta.php';
		
	}

// vc-logo-carosel.php
//--------------------------


vc_map( array(
			  "name" => __( "Stock call to action", "my-text-domain" ),
			  "base" => "stock_cta",  
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
				  
				 
				
			    )
		    )
	    );


// logo-carosel-shortcode.php
//-----------------------------
function stock_cta_shortcode($atts, $content = null){
	
	extract( shortcode_atts( array(
        'title' => '',
        'desc' => '',
        'type' => 1,
        'link_to_page' => '',
        'erternal_link' => '',
        'link_text' => 'See more',
    ), $atts) );
	
	if($type == 1){
		$link_source = get_page_link($link_to_page);
	}else{
		$link_source = $erternal_link;
	}

	$stock_cta_markup = '
		<div class="stock-cta-box">
			<h2>'.$title.'</h2>
			'.wpautop($desc).'
			
			<a href="'.$link_source.'" class="bodered-btn">'.$link_text.'</a>
		</div>
	';

	$stock_cta_markup.='';
	return $stock_cta_markup;
	
}

add_shortcode('stock_cta', 'stock_cta_shortcode');  


// stock-toolkit.css
//-----------------------------



.stock-cta-box {
  text-align: center;
  color: #666;
  font-size: 20px;
  font-weight: 300;
}
.stock-cta-box h2 {
  color: #333;
}
.stock-cta-box .bodered-btn {
  display: inline-block;
  position: relative;
  font-size: 24px;
  color: #333;
  font-weight: 700;
  padding-bottom: 10px;
  margin-top: 20px;
}
.stock-cta-box .bodered-btn:after {
  width: 70%;
}
.stock-cta-box .bodered-btn:hover::after {
  width: 100%;
}





?>