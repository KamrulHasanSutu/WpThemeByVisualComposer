
<?php

// stock-toolkit.php
//--------------------------
// Theme sortcodes

require_once(STOCK_ACC_PATH.'theme-shortcodes/testimonial-shortcode.php');

// vc-blocks-load.php
//--------------------------

	public function stockIntegrateWithVC(){
		
		// check if visula composer is not installed	
		if(!defined('WPB_VC_VERSION')){
			add_action('admin_notices',array($this,'stockShowVvBersionNotice'));
			return;			
		}
		// vc addons
		include STOCK_ACC_PATH.'/vc-addons/vc-testimonial-box.php';
		
	}

// vc-testimonial-box.php
//--------------------------

vc_map( array(
			  "name" => __( "Stock Testimonial carousel", "my-text-domain" ),
			  "base" => "stock_testimonial_box",  
			  "category" => __( "Stock", "my-text-domain"),
			  "params" => array(
				 array(
					"type" => "textfield",
					"heading" => __( "title", "my-text-domain" ),
					"param_name" => "title",                 
					"description" => __( "", "my-text-domain" )
				   ),
				 array(
					"type" => "textfield",
					"heading" => __( "Position", "my-text-domain" ),
					"param_name" => "position",                 
					"description" => __( "", "my-text-domain" )
				   ),
				   array(
					"type" => "attach_image",
					"heading" => __( "Photo", "my-text-domain" ),
					"param_name" => "photo",                                                           
					"description" => __( "", "my-text-domain" ),
				   ),

				   array(
					"type" => "textarea",
					"heading" => __( "Testimonial", "my-text-domain" ),
					"param_name" => "testimonial",                 
					"description" => __( "", "my-text-domain" )
				   ),
				

			    )
		    )
	    );






// testimonial-shortcode.php
//-----------------------------
function stock_testimonial_box_shortcode($atts, $content = null){
	
	extract( shortcode_atts( array(
        'title' => '',
        'position' => '',
        'testimonial' => '',
        'photo' => '',   
    ), $atts) );
	
	$photo_array= wp_get_attachment_image_src($photo, 'large');
	
	$stock_testimonial_box_markup = '
		<div class="single-testimonial-box">
			<img src="'.$photo_array[0].'" alt="'.$title.'" />
			<h3>'.$title.' <span>'.$position.'</span></h3>
			'.wpautop($testimonial).'
		</div>
	';

	return $stock_testimonial_box_markup;
	
}

add_shortcode('stock_testimonial_box', 'stock_testimonial_box_shortcode');  




// stock-toolkit.css
//-----------------------------
/*testimonial*/

.single-testimonial-box{
	font-style:italic;
	margin-bottom: 20px;
	
}


.single-testimonial-box h3{
	font-size:20px;
	font-style:normal;
	
}
.single-testimonial-box h3 span{
	color:#666666;
	display:block;
	font-size:14px;
	font-weight:normal;
	line-height:26px;
	margin-top:5px;
	
}

.single-testimonial-box img{
margin-bottom:20px;

}




?>