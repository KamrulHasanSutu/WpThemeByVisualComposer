<?php
// vc-service.php
//---------------------

vc_map( array(
			  "name" => __( "Stock service carousel", "my-text-domain" ),
			  "base" => "stock_service_box",  
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
	
	if($type == 1){
		$link_source = get_page_link($link_to_page);
	}else{
		$link_source = $erternal_link;
	}
	$box_bg_array = wp_get_attachment_image_src($upload_icon, 'medium');
	
	$stock_service_box_markup = '
		<div class="stock-service-box">
			<div style="background-image:url('.$box_bg_array[0].')" class="stock-service-icon">
				<div class="stock-service-table">
					<div class="stock-service-tablecell">';
		if($icon_type==1){
			$service_icon_array = wp_get_attachment_image_src($upload_icon, 'thumbnail');		
	        $stock_service_box_markup .= '<img src="'.$service_icon_array[0].'" alt=""/>';
			
		}
		else{
			 $stock_service_box_markup .= '<i class="'.$choose_icon.'"></i>';
		}
		
		 $stock_service_box_markup .= '
					</div>
				</div>
			</div>
			
			<div class="stock-service-content">
			    <h3>'.$title.'</h3>
				'.wpautop($desc).'
				<a href="'.$link_source.'" class="service-more-btn">'.$link_text.'</a>
			</div>
		</div>
	';
	$stock_service_box_markup.='';
	return $stock_service_box_markup;
	
}

add_shortcode('stock_service_box', 'stock_service_box_shortcode');  



?>
