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
    }

    /**
     * Register the gateway.
     * 
     * @param array $gateways
     * @return array
     */
    public function register_gateway($gateways) {
        $gateways['dodopayments'] = array(
            'admin_label'    => esc_html__( 'Dodo Payments', 'mg-dodopayments-for-edd' ),
            'checkout_label' => esc_html__( 'Dodo Payments', 'mg-dodopayments-for-edd' ),
        );

        return $gateways;
    }
}