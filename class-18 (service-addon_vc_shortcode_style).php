<?php

// service-shortcode.php
//-------------------------

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
	$box_bg_array = wp_get_attachment_image_src($box_background, 'medium');
	
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
// stock-toolkit.css
//-------------------------

/*service */
.stock-service-box {
  position: relative;
  border: 1px solid #ddd;
  padding-left: 25%;
  margin-bottom: 30px;
  transition: .2s;
}
.stock-service-icon {
  position: absolute;
  height: 100%;
  width: 25%;
  top: 0;
  left: 0;
  border-right: 1px solid #ddd;
  z-index: 1;
}
.stock-service-content {
  padding: 15px;
}
.stock-service-table {
  width: 100%;
  height: 100%;
  display: table;
}
.stock-service-tablecell {
  display: table-cell;
  vertical-align: middle;
  font-size: 36px;
  text-align: center;
  width: 100%;
}
.stock-service-icon:after {
  position: absolute;
  height: 100%;
  width: 100%;
  background: #EAF0F2;
  top: 0;
  left: 0;
  content: "";
  z-index: -1;
}
.stock-service-icon img {
  max-width: 50px;
}
.stock-service-box:hover {
  box-shadow: 0px 10px 20px #ddd;
}

.stock-service-box:hover .stock-service-icon:after {
  background-color: #278CC1;
  opacity: 0.8;
}
.stock-service-box:hover .stock-service-icon {
  color: #fff;
}
.stock-service-icon:after {
  transition: .3s;
}
?>