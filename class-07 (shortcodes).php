<?php
/*
Plugin Name: Stock Toolkit
*/


//test shotcodes

/* function stock_alert_shortcode($atts, $content = null){
	
	extract(shortcode_atts(
		array(
			'type' => 'success',
			'type' => 'alert',
			'type' => 'warning',
			'type' => 'info'
			//'text' => ''
			
		),
		$atts
	));
	
	//return '<div class="alert alert-'.esc_attr($type).'">'.esc_html($text).'</br>FIle is => '.__FILE__.'</div>';
	// esc_html kscs use kora jai
	return '<div class="alert alert-'.esc_attr($type).'">'.$content.'</br>FIle is => '.__FILE__.'</div>';
	
}
add_shortcode('alert','stock_alert_shortcode');

*/

function stock_alert_shortcode($atts, $content = null){
	
	extract(shortcode_atts(
		array(
			'id' => '',
			'size'=> 'large',
			'size'=> 'thumbnail',
			'size'=> 'medium'
		),
		$atts
	));
	
	//$img_array = wp_get_attachment_image_src($id, 'large');
	$img_array = wp_get_attachment_image_src($id, $size);
	
	var_dump($img_array);
	
	return '<img src="'.$img_array[0].'"/>';

	
}
add_shortcode('image','stock_alert_shortcode');

?>