<?php
/**
 * MG DodoPayments for Easy Digital Downloads | Admin Actions
 * 
 * @package MG DodoPayments for Easy Digital Downloads
 */

namespace MG\EDD\DodoPayments\Admin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Actions class.
 */
class Actions {
    /**
     * Constructor.
     */
    public function __construct() {
        add_action( 'edd_download_price_option_row', [ $this, 'add_variation_fields' ], 10, 3 );
    }

    /**
     * Add variation fields.
     * 
     * @param int   $post_id      Post ID.
     * @param int   $price_option Price option.
     * @param array $args         Arguments.
     * 
     * @since  1.0.0
     * @access public
     * 
     * @return void
     */
    public function add_variation_fields( $post_id, $price_option, $args ) {
        // Retrieve existing meta value for this price option, if it exists.
        $product = ! empty( $args['dodopayments_product'] ) ? $args['dodopayments_product'] : '';
        ?>
        <div class="edd-form-group">
            <label for="edd_variable_prices-1-name" class="edd-form-group__label">
                <?php esc_html_e( 'DodoPayments Product', 'mg-dodopayments-for-edd' ); ?>
            </label>
            <div class="edd-form-group__control">
                <span id="edd-edd_variable_dodopayments_product_wrap">
                    <input type="text" name="edd_variable_prices[<?php echo esc_attr( $price_option ); ?>][dodopayments_product]" id="edd_variable_prices-<?php echo esc_attr( $price_option ); ?>-dodopayments_product" autocomplete="" value="<?php echo $product; ?>" placeholder="Product ID" class="edd_variable_prices_dodopayments_product regular-text">
                </span>
            </div>
        </div>
        <?php
    }
}