<?php
/**
 * Plugin Name: MG - DodoPayments for Easy Digital Downloads
 * Plugin URI: https://mehulgohil.com/plugins/dodopayments-for-edd
 * Description: Accept payments via DodoPayments in your Easy Digital Downloads store.
 * Version: 1.0.0
 * Author: Mehul Gohil
 * Author URI: https://mehulgohil.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: mg-dodopayments-for-edd
 * Domain Path: /languages
 * Requires at least: 4.4
 * Tested up to: 5.7
 */

namespace MG\EDD\DodoPayments;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define constants.
define( 'MG_EDD_DODOPAYMENTS_VERSION', '1.0.0' );
define( 'MG_EDD_DODOPAYMENTS_FILE', __FILE__ );
define( 'MG_EDD_DODOPAYMENTS_DIR', plugin_dir_path( MG_EDD_DODOPAYMENTS_FILE ) );
define( 'MG_EDD_DODOPAYMENTS_URL', plugin_dir_url( MG_EDD_DODOPAYMENTS_FILE ) );

// Automatically loads files used throughout the plugin.
require_once PERFORM_PLUGIN_DIR . 'vendor/autoload.php';

// Initialize the plugin.
$plugin = new Plugin();
$plugin->register();