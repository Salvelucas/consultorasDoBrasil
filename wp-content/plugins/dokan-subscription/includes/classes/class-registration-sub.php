<?php
/**
* Description of Pack_On_Registration
*
* Show dropdown of Subscription packs on Registration form
*
* @author WeDevs
*
* @since 1.0.2
*/
class DPS_Pack_On_Registration {

    public function __construct() {
        $this->init_hooks();
    }

    /**
     * Init hooks and filters
     *
     * @return void
     */
    function init_hooks() {

        add_action( 'dokan_seller_registration_field_after', array( $this, 'generate_form_fields' ) );
        add_filter( 'woocommerce_registration_redirect', array( $this, 'redirect_to_checkout' ), 10, 1 );
    }

    public static function init() {
        static $instance = false;

        if ( !$instance ) {
            $instance = new DPS_Pack_On_Registration();
        }
        return $instance;
    }

    /**
     * Generate select options and details for created subscription packs
     *
     * @since 1.0.2
     *
     */
    function generate_form_fields() {
        //get packs
        $query = $this->get_subscription_packs();

        $packs = $query->get_posts();

        //if packs not empty show dropdown
        if ( empty( $packs ) ) {
            return;
        }
        ?>

        <div >

            <select required="required" class="dokan-form-control" name="dokan-subscription-pack" id="dokan-subscription-pack" style="visibility:hidden;">
            <!--<option value=""><?php // _e( 'Choose Any' , 'dps' ) ?></option>-->

                <?php
                while ( $query->have_posts() ) {
                    $query->the_post();
                    ?>
                    <option value="<?php echo get_the_ID() ?>"><?php echo the_title() ?></option>
                    <?php
                }
                ?>
            </select>
            <?php
            while ( $query->have_posts() ) {
                $query->the_post();
                $is_recurring       = ( get_post_meta( get_the_ID(), '_enable_recurring_payment', true ) == 'yes' ) ? true : false;
                $recurring_interval = (int) get_post_meta( get_the_ID(), '_subscription_period_interval', true );
                $recurring_period   = get_post_meta( get_the_ID(), '_subscription_period', true );
                ?>


                <?php
            }
            ?>

        </div>
            <?php
            wp_reset_query();
        }

    /**
     * Query subscription packs
     *
     * @return object subscription_query
     */
    private function get_subscription_packs() {

        $args = array(
            'post_type' => 'product',
            'order' => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_type',
                    'field'    => 'slug',
                    'terms'    => 'product_pack'
                )
            )
        );

        $query = new WP_Query( $args );

        return $query;
    }

    /**
     * Redirect users to checkout directly with selected
     * subscription added in cart
     *
     * @since 1.0.2
     * @param string redirect_url
     * @return string redirect_url
     */
    function redirect_to_checkout( $redirect_url ) {

        if ( !isset( $_POST['dokan-subscription-pack'] ) ) {
            return $redirect_url;
        }
        return get_site_url() . '/?add-to-cart=' . $_POST['dokan-subscription-pack'];
    }

}

if ( dokan_get_option('enable_subscription_pack_in_reg', 'dokan_product_subscription', 'on' ) == 'on' ) {
    $dps_on_reg = DPS_Pack_On_Registration::init();
}
