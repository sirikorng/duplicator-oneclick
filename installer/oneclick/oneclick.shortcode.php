<?php 
function create_button_shortcode( $atts, $content = null ) {
    $main_site_url = get_site_url(null, '', 'http');
    $funcs_url = '/wp-content/plugins/duplicator/installer/oneclick/oneclick.installer.php';
    $short_code_home_html = '<form method="post" action="' . $main_site_url . $funcs_url .'">';
    $current_user = wp_get_current_user();
    $current_user_name = esc_html( $current_user->user_login );
    $short_code_home_html .= '<input class="form-control hidden" type="hidden" id="wp_user" name="wp_user" type="search" value="' . $current_user_name . '">';
    $short_code_home_html .= '<button type="submit" class="btn btn-success btn-lg">Create Shop</button>';
    $short_code_home_html .= '</form>';

    return $short_code_home_html;
 
}
add_shortcode( 'create_shop', 'create_button_shortcode' );

function view_button_shortcode( $atts, $content = null ) {
    $main_site_url = get_site_url(null, '', 'http');
    $current_user = wp_get_current_user();
    $current_user_name = esc_html( $current_user->user_login );
    $funcs_url = $main_site_url . '/shop/' . $current_user_name . '/wp-login.php';
    $short_code_home_html = '<form method="post" action="' . $funcs_url .'">';
    $short_code_home_html .= '<input class="form-control hidden" type="hidden" id="wp_user" name="wp_user" type="search" value="">';
    $short_code_home_html .= '<button type="submit" class="btn btn-success btn-lg">View Shop</button>';
    $short_code_home_html .= '</form>';

    return $short_code_home_html;
 
}
add_shortcode( 'view_shop', 'view_button_shortcode' );
