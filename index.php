<?php
/*
Plugin Name: CFS - Validate Image Field Add-on
Plugin URI: https://github.com/sectsect/cfs-validate-image
Description: Add Validate Image dimension field type for Custom Field Suite.
Author: SECT INTERACTIVE AGENCY
Version: 1.0.1
Author URI: https://www.ilovesect.com/
License: GPL2
*/

$cfs_validate_image_addon = new cfs_validate_image_addon();

class cfs_validate_image_addon
{
    function __construct() {
        add_filter('cfs_field_types', array($this, 'cfs_field_types'));
		add_action( 'plugins_loaded', 'cfsvalidateimage_load_textdomain' );
        function cfsvalidateimage_load_textdomain() {
			load_plugin_textdomain( 'cfs-validateimage', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
        }
    }

    function cfs_field_types( $field_types ) {
        $field_types['validate_image'] = dirname( __FILE__ ) . '/validateimage.php';
        return $field_types;
    }
}
