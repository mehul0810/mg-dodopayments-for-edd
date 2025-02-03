<?php
/**
 * MG DodoPayments for Easy Digital Downloads | Frontend Actions
 * 
 * @package MG DodoPayments for Easy Digital Downloads
 */

namespace MG\EDD\DodoPayments\Includes;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Actions class.
 */
class Actions {
    public function __construct() {       
        // Process payment.
        add_action('edd_gateway_dodopayments', array($this, 'process_payment'));
    }

    public function process_payment( $data ) {
        
    }
}