<?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'avada-parent-stylesheet', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );


remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// this filter adds the custom field values to the json output
add_filter( 'tribe_rest_event_data', 'sp_add_event_customfields' );
  
function sp_add_event_customfields($data) {
$event_id = $data['id'];
$data = array_merge( $data, 

array("custom_fields" => array(
    'price'  => get_post_meta( $event_id, '_ecp_custom_2', true ),
    'price2'  => get_post_meta( $event_id, '_ecp_custom_3', true ),

    'Referent' => get_post_meta( $event_id, '_ecp_custom_3', true ),
    'Details_Anmeldung' => get_post_meta( $event_id, '_ecp_custom_4', true ),
    'Fotorechte' => get_post_meta( $event_id, '_ecp_custom_7', true ),
    'Preis' => get_post_meta( $event_id, '_ecp_custom_16', true ),

    )    ));
   
    return $data;
}
