
<?php

// stock-toolkit.php
//--------------------------
// Theme sortcodes

require_once(STOCK_ACC_PATH.'theme-shortcodes/stock-btn-shortcode.php');
require_once(STOCK_ACC_PATH.'theme-shortcodes/stat-shortcode.php');


// vc-blocks-load.php
//--------------------------

	public function stockIntegrateWithVC(){
		
		// check if visula composer is not installed	
		if(!defined('WPB_VC_VERSION')){
			add_action('admin_notices',array($this,'stockShowVvBersionNotice'));
			return;			
		}
		// vc addons
		include STOCK_ACC_PATH.'/vc-addons/vc-stock-btn.php';
		include STOCK_ACC_PATH.'/vc-addons/vc-stat.php';
		
	}

// vc-stock-btn.php
//--------------------------


vc_map( array(
			  "name" => __( "Stock button", "my-text-domain" ),
			  "base" => "stock_btn",  
			  "category" => __( "Stock", "my-text-domain"),
			  "params" => array(
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
				   // dropdown icon
			    )
		    )
	    );




// stock-btn-shortcode.php
//-----------------------------
function stock_btn_shortcode($atts, $content = null){
	
	extract( shortcode_atts( array(
        'type' => 1,
        'link_to_page' => '',
        'erternal_link' => '',
        'link_text' => 'Read more about us',
       
    ), $atts) );
	
	if($type == 1){
		$link_source = get_page_link($link_to_page);
	}else{
		$link_source = $erternal_link;
	}
	
	
	$stock_stock_btn_markup = '
			<a href="'.$link_source.'" class="bordered-btn">'.$link_text.'</a>
	';
	
	return $stock_stock_btn_markup;
	
}

add_shortcode('stock_btn', 'stock_btn_shortcode');  


// vc-stat.php
//--------------------------

vc_map( array(
			  "name" => __( "Stock statics box", "my-text-domain" ),
			  "base" => "stock_stat",  
			  "category" => __( "Stock", "my-text-domain"),
			  "params" => array(
				    array(
					"type" => "textfield",
					"heading" => __( "Static number", "my-text-domain" ),
					"param_name" => "number",                 
					"description" => __( "", "my-text-domain" ),
				   ),
				   array(
					"type" => "textfield",
					"heading" => __( "Static number after text", "my-text-domain" ),
					"param_name" => "after_text",                 
					"description" => __( "", "my-text-domain" ),
				   ), 
				   array(
					"type" => "textfield",
					"heading" => __( "Static description", "my-text-domain" ),
					"param_name" => "desc",                 
					"description" => __( "", "my-text-domain" ),
				   ),
				   // dropdown icon
			    )
		    )
	    );




// stat-shortcode.php
//-----------------------------
function stock_stat_shortcode($atts, $content = null){
	
	extract( shortcode_atts( array(
        'number' => '',
        'after_text' => '',
        'desc' => '',
    ), $atts) );
	
	
	$stock_stat_markup = '
			<div class="stock-stat-box">
				<h1><span>'.$number.'</span>'.$after_text.'</h1>
				'.$desc.'
			</div>
	';
	 
	return $stock_stat_markup;
	
}

add_shortcode('stock_stat', 'stock_stat_shortcode');   



// stock-toolkit.css
//-----------------------------

/*stock start button */

.vc_row.overlay {
  z-index: 1;
  color: #fff;
}
.vc_row.overlay:after {
  height: 100%;
  width: 100%;
  position: absolute;
  left: 0;
  top: 0;
  content: "";
  display: block;
  background: #20272a;
  z-index: -1;
  opacity: 0.9;
}
.bordered-btn {
  position: relative;
  display: inline-block;
}
.overlay .bordered-btn {
  color: #fff;
}
.stock-stat-box h1 {
  margin-bottom: 12px;
  color: #39b4f3;
}
.vc-row.large-text{
	font-size:18px;
}
.vc-row.large-text .bordered-btn{
	font-size:20px;
}





?>