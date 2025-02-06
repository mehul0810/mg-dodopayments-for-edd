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

        // Get the serialized settings data from wp_options
        $stored_data = get_option('edd_settings');

        if ($stored_data && is_array($stored_data)) {
            // Extract the API key from the settings array
            $api_key = isset($stored_data['mg_edd_dodopayments_api_key']) ? $stored_data['mg_edd_dodopayments_api_key'] : '';
        }

        if( !empty($api_key)) {
            
            $headers = [
                'Authorization' => "Bearer {$api_key}",
                'Content-Type'  => 'application/json',
            ];
    
            /* $download_id = 10;
            $meta_key = 'edd_variable_prices';
            
            echo $producdata = get_post_meta($download_id, $meta_key, true);
            echo "<pre>";
            print_r($producdata); */
            
            $gateway = $data['gateway'];
    
            $queryParams = $this->getParameters($data);
            
            $response = wp_safe_remote_post(
                'https://test.dodopayments.com/subscriptions',
                [
                    'headers' => $headers,
                    'body'    => wp_json_encode( $queryParams ),
                ]
            );
       
            if ( ! is_wp_error( $response ) ) {
                
                $decoded_response = json_decode( wp_remote_retrieve_body( $response) );
                
                if (
                    ! empty( $response['response']['message'] ) &&
                    'OK' === $response['response']['message'] && intval($response['response']['code']) === 200
                ) {
                    $paymentUrl = $decoded_response->payment_link;
                    
                    // Redirect to gateway URL.
                    wp_redirect($paymentUrl);
                    exit();
                } else {
                    // Error.
                    edd_set_error( 'dodo_error', $decoded_response->message );
                    edd_send_back_to_checkout( '?payment-mode=' . $gateway );
                }
            }
        }
        wp_die();
    }

    /**
     * Prepare Data to send to a gateway.
	 *
	 * @return array
     */
    public function getParameters($data) {
        return [
            'billing' => [
                'city' => $data['post_data']['card_city'],
                'country' => $data['post_data']['billing_country'],
                'state' => $data['post_data']['card_state'],
                'street' => ! empty( $data['post_data']['card_address_2'] ) ? "{$data['post_data']['card_address']} {$data['post_data']['card_address_2']}" : $data['post_data']['card_address'],
                'zipcode' => $data['post_data']['card_zip'],
            ],
            'customer' => [
                'email' => $data['post_data']['edd_email'],
                'name' => ! empty( $data['post_data']['edd_last'] ) ? "{$data['post_data']['edd_first']} {$data['post_data']['edd_last']}" : $data['post_data']['edd_first'],
                'create_new_customer' => true,
            ],
            'product_id' => 'pdt_9PIwJvIT3pUFHhQZ5n5ho',
            'quantity' => 1,
            'payment_link' => true,
        ];
    }
}