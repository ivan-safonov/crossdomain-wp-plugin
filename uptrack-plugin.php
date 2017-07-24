<?php

/*
Plugin Name: Crossdomain call
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Plugin for send crossdoaim ajax call
Version: 1.0
Author: ivan
Author URI: http://URI_Of_The_Plugin_Author
License: MIT
*/

// create custom plugin settings menu
add_action('admin_menu', 'uptrack_create_menu');
add_action( 'wp_enqueue_scripts', 'my_enqueue_script' );

function my_enqueue_script() {
  wp_register_script('redirect', plugins_url('js/redirect.js', __FILE__), array('jquery'),'', true);
  $page = get_option('u_site_pages' )['page_id'];
  if ( !empty($page) ){
      if ( is_page( $page ) ) {
        wp_enqueue_script('redirect');
        $inf = array( 'id'=> get_option('u_product_id') ); 
        wp_localize_script('redirect', 'redirect', $inf );
      }
  }

}

function uptrack_create_menu() {

	//create new top-level menu
	add_menu_page('Uptrack Settings', 'Uptrack Settings', 'administrator', __FILE__, 'uptrack_settings_page');

	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
	//register our settings
	register_setting( 'uptrack-settings-group', 'u_product_id' );
	register_setting( 'uptrack-settings-group', 'u_site_pages' );
}

function uptrack_settings_page() {
?>
<div class="wrap">
<h2>Uptrack</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'uptrack-settings-group' ); ?>
    <table class="form-table">

        <tr valign="top">
        <th scope="row">Redirect page:</th>
        <td> <?php 
        $options = get_option('u_site_pages');
            wp_dropdown_pages(
                array(
                     'name' => 'u_site_pages[page_id]',
                     'echo' => 1,
                     'show_option_none' => __( '&mdash; Select &mdash;' ),
                     'option_none_value' => '0',
                     'selected' => $options['page_id']
                )
            );
        ?> </td>
        </tr>

        <tr valign="top">
        <th scope="row">Product ID:</th>
        <td><input type="text" name="u_product_id" value="<?php echo get_option('u_product_id'); ?>" /></td>
        </tr>       

    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>
<?php } ?>
