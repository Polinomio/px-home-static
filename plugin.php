<?php
/*
Plugin Name: Homepage Static Generator
Plugin URI:  https://github.com/alvaroveliz/pxHomeStatic
Description: Generates a static file of the WordPress homepage.
Version:     1.0 
Author:      Polinomio Devs
Author URI:  http://polinomio.cl.cl
License:     MIT
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
define('PX_HOME_STATIC_PLUGIN_NAME', basename(dirname(__FILE__)) . '/' . basename(__FILE__));
define('PX_HOME_STATIC_GENERATE_URL', plugins_url(basename(dirname(__FILE__)) . '/' . 'generate.php'));

require 'includes/pxHomeStatic.php';

$adg = new pxHomeStatic();

/** DO THE ADMIN **/
add_action('admin_menu', array($adg, 'getAdminOptions'));