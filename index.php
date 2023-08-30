<?php

/**
 * Plugin Name: AM Social
 * Plugin URI: #
 * Description: Transform WordPress to Social network
 * Version: 0.0.1
 * Requires at least: 6.0
 * Requires PHP: 8.1
 * Author: AM
 * Author URI: #
 * License: GPL v3 or later
 * Text Domain: ams
 * Domain Path: /languages
 */

// start classes PSR-4 autoloader
require_once('vendor/autoload.php');

// Include Plugin Init
use Core\Init;

// Define base constants
if (!defined("AMS_PLUGIN_VERSION")) define("AMS_PLUGIN_VERSION", get_file_data(__FILE__, ['Version' => 'Version'])["Version"]);
if (!defined("AMS_PLUGIN_DIR")) define("AMS_PLUGIN_DIR", __DIR__);
if (!defined("AMS_PLUGIN_URL")) define("AMS_PLUGIN_URL", plugin_dir_url(__FILE__));
if (!defined("AMS_PLUGIN_FILE")) define("AMS_PLUGIN_FILE", __FILE__);
if (!defined("AMS_ACTIVE_THEME_DIR")) define("AMS_ACTIVE_THEME_DIR", get_stylesheet_directory());
if (!defined("AMS_ACTIVE_THEME_URL")) define("AMS_ACTIVE_THEME_URL", get_stylesheet_directory_uri());

// load plugin core
(Init::getInstance());
