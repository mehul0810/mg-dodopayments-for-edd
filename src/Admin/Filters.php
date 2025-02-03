<?php
/**
 * MG DodoPayments for Easy Digital Downloads | Admin Filters
 * 
 * @package MG DodoPayments for Easy Digital Downloads
 */

namespace MG\EDD\DodoPayments\Admin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Filters class.
 */
class Filters {
    public function __construct() {
        // Register the gateway.
        add_filter('edd_payment_gateways', array($this, 'register_gateway'));

        // Add settings page.
        add_filter('edd_settings_sections_gateways', array($this, 'add_settings_page'));

        // Add fields to settings page.
        add_filter('edd_settings_gateways', [$this, 'add_settings_fields']);
    }

    /**
     * Register the gateway.
     * 
     * @param array $gateways List of payment gateways.
     * 
     * @since  1.0.0
     * @access public
     * 
     * @return array
     */
    public function register_gateway($gateways) {
        $gateways['dodopayments'] = array(
            'admin_label'    => esc_html__( 'Dodo Payments', 'mg-dodopayments-for-edd' ),
            'checkout_label' => esc_html__( 'Dodo Payments', 'mg-dodopayments-for-edd' ),
        );

        return $gateways;
    }

    /**
     * Add settings.
     * 
     * @param array $sections List of sections.
     * 
     * @since  1.0.0
     * @access public
     * 
     * @return array
     */
    public function add_settings_page($sections) {
        $sections['dodopayments'] = __('Dodo Payments', 'mg-dodopayments-for-edd');
    
        return $sections;
    }

    /**
     * Add settings fields.
     * 
     * @param array $fields Settings Field Array.
     * 
     * @since  1.0.0
     * @access public
     * 
     * @return array
     */
    public function add_settings_fields($fields) {
        // Define the Dodo Payments settings.
        $dodo_settings = array(
            'dodopayments' => array(
                array(
                    'id'   => 'mg_edd_dodopayments_api_key',
                    'name' => esc_html__('API Key', 'mg-dodopayments-for-edd'),
                    'desc' => esc_html__('Enter your Dodo Payments API Key.', 'mg-dodopayments-for-edd'),
                    'type' => 'text',
                ),
                array(
                    'id'   => 'edd_dodo_webhook_secret',
                    'name' => __('Webhook Secret', 'mg-dodopayments-for-edd'),
                    'desc' => __('Enter your Dodo Payments Webhook Secret.', 'mg-dodopayments-for-edd'),
                    'type' => 'text',
                ),
            ),
        );

        // Merge the Dodo Payments settings with existing settings.
        return array_merge($fields, $dodo_settings);
    }
}