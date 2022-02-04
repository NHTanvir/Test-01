<?php
/*
Plugin Name: Woocomrce single product 
Plugin URI: https://wptownhall.com
Description: Display Woocomrce single product 
Version: 1.0
Author: NH Tanvir
Author URI: https://wptownhall.com
License: GPLv2 or later
Text Domain: Woocomrce-single-product 
*/

 //Custom input field 

function custom_html_function(){
	?>
	<br>
	<br>
	<label for="custom_name">Input Custom Name :</label>
	<input type="text" name="custom_name">
	<?php
}


 //adding Custom input field to single product page 

function custom_input_action_woocommerce_after_add_to_cart_form(){
	custom_html_function();

}
add_action( 'woocommerce_after_add_to_cart_button', 'custom_input_action_woocommerce_after_add_to_cart_form' );


//setting cookie 

function tttttt() {

	if( ! isset( $_POST['custom_name'] ) ) return;
		setcookie( 'custom_name', sanitize_text_field( $_POST['custom_name'] ), time() + 3600, COOKIEPATH, COOKIE_DOMAIN );

}
add_action('init', 'tttttt');


//printing cookie at cart page

function custom_input_action_woocommerce_after_cart_item_name(){
	if( isset( $_COOKIE['custom_name'] ) ){
		echo $_COOKIE["custom_name"];
	}
	
}

add_action( 'woocommerce_after_cart_item_name', 'custom_input_action_woocommerce_after_cart_item_name' );

//printing cookie at checkout page

function custom_input_action_woocommerce_review_order_before_payment(){
	if( isset( $_COOKIE['custom_name'] ) ){
		echo $_COOKIE["custom_name"];
	}
	
}

add_action('woocommerce_review_order_before_payment','custom_input_action_woocommerce_review_order_before_payment');

//saving the cookie and removing cookie

function action_woocommerce_thankyou( $order_get_id ){

	if( isset( $_COOKIE['custom_name'] ) ){
		$cookie = $_COOKIE["custom_name"];
		echo $_COOKIE["custom_name"];
		global $wpdb;
		$key = 'I am meta';
		$value = $_COOKIE["custom_name"];
		wc_update_order_item_meta($order_get_id, $key, $value);
		// remove cookie
		unset( $_COOKIE['custom_name'] ); 
    	setcookie( 'custom_name', '', time() - ( 15 * 60 ), COOKIEPATH, COOKIE_DOMAIN );
	}
	
}


add_action( 'woocommerce_thankyou', 'action_woocommerce_thankyou', 10, 1 );



?>
