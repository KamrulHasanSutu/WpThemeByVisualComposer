<?php

// stock-toolkit.php
//--------------------------
// Theme sortcodes
require_once(STOCK_ACC_PATH.'theme-shortcodes/logo-carosel-shortcode.php');

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
		
	}

// vc-logo-carosel.php
//--------------------------


vc_map( array(
			  "name" => __( "Stock logo carousel", "my-text-domain" ),
			  "base" => "stock_logo_carousel",  
			  "category" => __( "Stock", "my-text-domain"),
			  "params" => array(
				 array(
					"type" => "attach_images",
					"heading" => __( "Upload logos", "my-text-domain" ),
					"param_name" => "logos",                 
					"description" => __( "upload images", "my-text-domain" )
				   ),
				   array(
					"type" => "textfield",
					"heading" => __( "Desktop count", "my-text-domain" ),
					"param_name" => "desktop_count",                                                             
					"std" => __( "5", "my-text-domain" ),                                                            
					"description" => __( "", "my-text-domain" ),
				   ),
				   array(
					"type" => "textfield",
					"heading" => __( "Tablet count", "my-text-domain" ),
					"param_name" => "tablet_count",                               
					"std" => __( "3", "my-text-domain" ),
					"description" => __( "tablet count", "my-text-domain" )
				   ),
				   array(
					"type" => "textfield",
					"heading" => __( "Mobile count", "my-text-domain" ),
					"param_name" => "mobile_count",                               
					"std" => __( "2", "my-text-domain" ),
					"description" => __( "moible", "my-text-domain" ),
				   ),
				   array(
					"type" => "dropdown",
					"heading" => __( "Enable loop ?", "my-text-domain" ),
					"param_name" => "loop",                               
					"std" => __( "true", "my-text-domain" ),
					"value" => array(
						'yes' => 'true',
						'no'  => 'false',
					),
					"description" => __( "", "my-text-domain" ),
				   ),
				   array(
					"type" => "dropdown",
					"heading" => __( "Enable autoplay", "my-text-domain" ),
					"param_name" => "autoplay",                               
					"std" => __( "true", "my-text-domain" ),
					"value" => array(
						'yes' => 'true',
						'no'  => 'false',
					),
					"description" => __( "", "my-text-domain" ),
				   ),
				   array(
					"type" => "dropdown",
					"heading" => __( "logo carosel time", "my-text-domain" ),
					"param_name" => "autoplaytimeout",                               
					"std" => __( "5000", "my-text-domain" ),
					"value" => array(
						'1 Second' => '1000',
						'2 Seconds' => '2000',
						'3 Seconds' => '3000',
						'4 Seconds' => '4000',
						'5 Seconds' => '5000',
						'6 Seconds' => '6000',
						'7 Seconds' => '7000',
						'8 Seconds' => '8000',
						'9 Seconds' => '9000',
						'10 Seconds' => '10000',
						'11 Seconds' => '11000',
						'12 Seconds' => '12000',
						'13 Seconds' => '13000',
						'14 Seconds' => '14000',
						'15 Seconds' => '15000',
						
					),
					"description" => __( "(description)", "my-text-domain" ),
					"dependency"  => array(
						"element" => "autoplay",
						"value"   =>array("true"),
					)
				   ),
				   array(
					"type" => "dropdown",
					"heading" => __( "Enable navigation icon ?", "my-text-domain" ),
					"param_name" => "nav",                               
					"std" => __( "true", "my-text-domain" ),
					"value" => array(
						'yes' => 'true',
						'no'  => 'false',
					),
					"description" => __( "", "my-text-domain" ),
				  ),
				   array(
					"type" => "dropdown",
					"heading" => __( "Enable dots ? ", "my-text-domain" ),
					"param_name" => "dots",                               
					"std" => __( "true", "my-text-domain" ),
					"value" => array(
						'yes' => 'true',
						'no'  => 'false',
					),
					"description" => __( "", "my-text-domain" ),
				  )
				
			    )
		    )
	    );



// logo-carosel-shortcode.php
//-----------------------------

<?php

function stock_logo_carousel_shortcode($atts, $content = null){
	
	extract( shortcode_atts( array(
        'logos' => '',
        'desktop_count' => '5',
        'tablet_count' => '3',
        'mobile_count' => '2',
        'loop' => 'true',
        'autoplay' => 'true',
        'autoplaytimeout' => 5000,
        'nav' => 'true',
        'dots' => 'true',
    ), $atts) );
	
	
	$logo_ids = explode(',', $logos);
	
	
	$stock_logo_carousel_markup = '
	<script>
		jQuery(document).ready(function($){
			$(".stock-logo-carousel").owlCarousel({
				margin : 30,
				items : 5,
				loop : '.$loop.',
				autoplay : '.$autoplay.',
				autoplayTimeout : '.$autoplaytimeout.',
				nav : '.$nav.',
				dots : '.$dots.',
				navText : ["<i class=\'fa fa-angle-left\'></i>", "<i class=\'fa fa-angle-right\'></i>"]
			});
		});
	</script>
	';
	$stock_logo_carousel_markup .='
	<div class="stock-logo-carousel">';
	foreach($logo_ids as $logo){
		$logo_array = wp_get_attachment_image_src($logo, 'lage');
		$stock_logo_carousel_markup.= '
			<div class="stock-logo-item-table">
				<div class="stock-logo-item-tablecell">
					<img src="'.$logo_array[0].'" alt=""/>
				</div>
			</div>
		';
	}
	$stock_logo_carousel_markup .= '
	</div>
	';
	
	return $stock_logo_carousel_markup;
	
}

add_shortcode('stock_logo_carousel', 'stock_logo_carousel_shortcode');  


// stock-toolkit.css
//-----------------------------


  /*carosel */
.stock-logo-carousel .owl-dots div {
  height: 5px;
  width: 30px;
  background: #ddd;
  margin: 5px;
  display: inline-block;
}
.stock-logo-carousel .owl-dots {
  text-align: center;
}
.stock-logo-carousel .owl-dot.active {
  background: red;
}
.stock-logo-carousel .owl-nav div {
  position: absolute;
  left: 0;
  top: 50%;
  font-size: 30px;
  line-height: 60px;
  opacity: .6;
  margin-top: -25px;
}
.stock-logo-carousel .owl-nav div.owl-next {
  left: auto;
  right: 0;
}
.stock-logo-carousel {
  padding-left: 30px;
  padding-right: 30px;
}
.stock-logo-item-table {
  display: table;
  height: 150px;
  width: 100%;
}
.stock-logo-item-tablecell {
  display: table-cell;
  vertical-align: middle;
}





?>