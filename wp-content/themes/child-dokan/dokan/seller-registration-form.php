<?php
/**
 * Dokan Seller registration form
 *
 * @since 2.4
 *
 * @package dokan
 */
?>

<p class="form-row form-group user-role">
    <label class="radio">
        <input type="radio" name="role" value="customer"<?php checked( $role, 'customer' ); ?>>
        <?php _e( 'I am a customer', 'dokan' ); ?>
    </label>

    <label class="radio">
        <input type="radio" name="role" value="seller"<?php checked( $role, 'seller' ); ?>>
        <?php _e( 'I am a seller', 'dokan' ); ?>
    </label>
<div class="show_if_seller"<?php echo $role_style; ?>>
  <?php
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
       $the_query = new WP_Query( $args );
   ?>
  <?php  if ( $the_query->have_posts() ) {  ?>
    <ul id="palnos">
      <?php while ( $the_query->have_posts() ) { $the_query->the_post(); ?>
        <li id="<?php echo get_the_title(); ?>">
          <p><?php echo get_the_title(); ?></p>
          <div id="grupo">
            <span class="dps-amount">
              <div id="marcar"></div>
              <i>
                <?php _e( 'Price :', 'dps' ) ?>
                <?php if ( get_post_meta( get_the_ID(), '_regular_price', true ) == '0' ): ?>
                <?php _e( 'Free', 'dps' ); ?>
                <?php else: ?>
                <?php if ( get_post_meta( get_the_ID(), '_sale_price', true ) ): ?>
                <strike><?php echo get_woocommerce_currency_symbol() . get_post_meta( get_the_ID(), '_regular_price', true ); ?></strike> <?php echo get_woocommerce_currency_symbol() . get_post_meta( get_the_ID(), '_sale_price', true ); ?>
                <?php else: ?>
                <?php echo get_woocommerce_currency_symbol() . get_post_meta( get_the_ID(), '_regular_price', true ); ?>
                <?php endif ?>
                <?php endif; ?>
              </i>
            </span>
              <?php the_content(); ?>
            </div>
              <div id="ass" >
                <div class="btn btn-primary">Assinar</div>
              </div>

        </li>

        <?php } ?>
    </ul>
  <?php  } else{ ?>
  <?php } ?>

  <div class="split-row form-row-wide">
      <p class="form-row form-group">
          <label for="first-name"><?php _e( 'First Name', 'dokan' ); ?> <span class="required">*</span></label>
          <input type="text" class="input-text form-control" name="fname" id="first-name" value="<?php if ( ! empty( $postdata['fname'] ) ) echo esc_attr($postdata['fname']); ?>" required="required" />
      </p>

      <p class="form-row form-group">
          <label for="last-name"><?php _e( 'Last Name', 'dokan' ); ?> <span class="required">*</span></label>
          <input type="text" class="input-text form-control" name="lname" id="last-name" value="<?php if ( ! empty( $postdata['lname'] ) ) echo esc_attr($postdata['lname']); ?>" required="required" />
      </p>
  </div>
    <p class="form-row form-group form-row-wide">
        <label for="company-name"><?php _e( 'Shop Name', 'dokan' ); ?> <span class="required">*</span></label>
        <input type="text" class="input-text form-control" name="shopname" id="company-name" value="<?php if ( ! empty( $postdata['shopname'] ) ) echo esc_attr($postdata['shopname']); ?>" required="required" />
    </p>

    <p class="form-row form-group form-row-wide">
        <label for="seller-url" class="pull-left"><?php _e( 'Shop URL', 'dokan' ); ?> <span class="required">*</span></label>
        <strong id="url-alart-mgs" class="pull-right"></strong>
        <input type="text" class="input-text form-control" name="shopurl" id="seller-url" value="<?php if ( ! empty( $postdata['shopurl'] ) ) echo esc_attr($postdata['shopurl']); ?>" required="required" />
        <small><?php echo home_url() . '/' . dokan_get_option( 'custom_store_url', 'dokan_general', 'store' ); ?>/<strong id="url-alart"></strong></small>
    </p>

    <p class="form-row form-group form-row-wide">
        <label for="shop-phone"><?php _e( 'Phone Number', 'dokan' ); ?><span class="required">*</span></label>
        <input type="text" class="input-text form-control" name="phone" id="shop-phone" value="<?php if ( ! empty( $postdata['phone'] ) ) echo esc_attr($postdata['phone']); ?>" required="required" />
    </p>
    <?php

        $show_toc = dokan_get_option( 'enable_tc_on_reg', 'dokan_general' );

        if ( $show_toc == 'on' ) {
            $toc_page_id = dokan_get_option( 'reg_tc_page', 'dokan_pages' );
            if ( $toc_page_id != -1 ) {
                $toc_page_url = get_permalink( $toc_page_id );
    ?>
            <p class="form-row form-group form-row-wide">
                <input class="tc_check_box" type="checkbox" id="tc_agree" name="tc_agree" required="required">
                <label style="display: inline" for="tc_agree"><?php _e( 'I have read and agree to the <a target="_blank" href='.$toc_page_url.'>Terms &amp; Conditions</a>.' , 'dokan' ) ?></label>
            </p>
            <?php } ?>
        <?php } ?>
    <?php  do_action( 'dokan_seller_registration_field_after' ); ?>

</div>


</p>

<script type="text/javascript">
  $('li#Gratuito').click(function() {
    $('select#dokan-subscription-pack').val('14180');
     swal({   title: "Plano Gratuito",   text: "Seja preminun e confirar oque a de melhor.",   timer: 2000,   showConfirmButton: false });
    $(this).addClass('chek');
    $('li#Associada').removeClass('chek1');
    $('li#Premium').removeClass('chek2');
  });

  $('li#Associada').click(function() {
    $('select#dokan-subscription-pack').val('14237');
    // swal({   title: "Plano Associado",   text: "Parabéns confirar oque a de melhor no Premium",   timer: 2000,   showConfirmButton: false });
    $(this).addClass('chek1');
    $('li#Gratuito').removeClass('chek');
    $('li#Premium').removeClass('chek2');

  });

  $('li#Premium').click(function() {
    $('select#dokan-subscription-pack').val('14238');
    // swal({   title: "Plano Premium",   text: "Voce e invcrivel",   timer: 2000,   showConfirmButton: false });
    $(this).addClass('chek2');
    $('li#Gratuito').removeClass('chek');
    $('li#Associada').removeClass('chek1');

  });


</script>
