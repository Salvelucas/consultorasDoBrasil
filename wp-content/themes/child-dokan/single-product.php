<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
<body id="pageProdutos">
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>
      <?php
      $author     = get_user_by( 'id', $product->post->post_author );
      $store_info = dokan_get_store_info($author->ID);
			$store_tabs    = dokan_get_store_tabs( $author->ID );
      $banner_id  = isset( $store_info['banner'] ) ? $store_info['banner'] : 0;
      $store_url  = dokan_get_store_url( $author->ID );
			$social_fields = dokan_get_social_profile_fields();
			$map_location = isset( $store_info['location'] ) ? esc_attr( $store_info['location'] ) : '';
			$local = $store_info['location'];
			//echo '<pre>';
       //print_r($store_tabs);
      ?>
			<?php if($local == null) { ?>
			<style>
			aside#dokan-store-location{
			  display: none;
			}
			</style>
			<?php } ?>
      <?php
         if (isset($store_info['address']) && !empty($store_info['address'])) {
             $endereco    = $store_info['address'];
             $estadoAtual = $_GET['estado'];
             $h           = $endereco['street_1'];
						 $a           = $endereco['city'];
           }
         ?>
				 <div id="dokan-primary" class="dokan-single-store ">
        <div id="dokan-content" class="store-page-wrap woocommerce" role="main">
      <div class="profile-frame">
          <?php if ( isset( $store_info['banner'] ) && !empty( $store_info['banner'] ) ) { ?>
          <style type="text/css">
              .profile-frame {
                  background-image: url('<?php echo wp_get_attachment_url( $store_info['banner'] ); ?>');
              }
          </style>
          <?php } ?>

          <div class="profile-info-box">
              <div class="profile-img">
              			<span class="profile-img-sellers-prod"> <?php echo get_avatar( $author->ID); ?></span>
              </div>

              <div class="profile-info">
                  <ul class="dokan-store-info">

                      <?php if ( isset( $store_info['store_name'] ) ) { ?>
                          <li class="store-name"><?php echo esc_html( $store_info['store_name'] ); ?></li>
                      <?php } ?>

                      <?php if ( isset( $store_info['address'] ) && !empty( $store_info['address'] ) ) { ?>
                          <li class="dokan-store-address"><i class="fa fa-map-marker"></i>
                            <?php echo $h; ?>
                            <?php echo $a; ?>
                          </li>
                      <?php } ?>
                        <li class="dokan-store-address"><i class="fa fa-tags"></i>
                      <?php if ( isset( $store_info['brands'] ) ) { $marca = isset( $store_info['brands'] ) ? $store_info['brands'] : '';  echo $str = implode(" - ",$marca); } ?>
                      </li>
                      <?php if ( isset( $store_info['phone'] ) && !empty( $store_info['phone'] ) ) { ?>
                          <li class="dokan-store-phone">
                              <i class="fa fa-phone"></i>
                              <?php echo esc_html( $store_info['phone'] ); ?>
                          </li>
                      <?php } ?>

											<li class="dokan-store-email">
													<i class="fa fa-envelope-o"></i>
													<a href="mailto:<?php echo the_author_meta( 'user_email', $author->ID ); ?>"><?php echo the_author_meta( 'user_email', $author->ID ); ?></a>
											</li>

                      <li>
                          <i class="fa fa-star"></i>
                          <?php dokan_get_readable_seller_rating( $store_user->ID ); ?>
                      </li>
                  </ul>

                  <?php do_action( 'dokan_store_before_social', $store_user, $store_info ); ?>

                  <?php if ( $social_fields ) { ?>
                      <ul class="store-social">
                          <?php foreach( $social_fields as $key => $field ) { ?>
                              <?php if ( isset( $store_info['social'][ $key ] ) && !empty( $store_info['social'][ $key ] ) ) { ?>
                                  <li>
                                      <a href="<?php echo esc_url( $store_info['social'][ $key ] ); ?>" target="_blank"><i class="fa fa-<?php echo $field['icon']; ?>"></i></a>
                                  </li>
                              <?php } ?>
                          <?php } ?>
                      </ul>
                  <?php } ?>
              </div> <!-- .profile-info -->
          </div> <!-- .profile-info-box -->
      </div> <!-- .profile-frame -->
</div>
</div>
<?php if ( $store_tabs ) { ?>
    <div class="dokan-store-tabs">
        <ul class="dokan-list-inline">
            <?php foreach( $store_tabs as $key => $tab ) { ?>
                <li><a href="<?php echo esc_url( $tab['url'] ); ?>"><?php echo $tab['title']; ?></a></li>
            <?php } ?>
            <?php do_action( 'dokan_after_store_tabs', $store_user->ID ); ?>
        </ul>
    </div>
<?php } ?>
					<div id="secondary" class="clearfix" role="complementary">
						<button type="button" class="navbar-toggle widget-area-toggle collapsed" data-toggle="collapse" data-target=".widget-area">
					        <i class="fa fa-bars"></i>
					        <span class="bar-title">Menu - Localização - Contato</span>
					    </button>
						<div class="widget-area widget-collapse collapse" style="height: auto;">
					<aside class="widget dokan-category-menu">
								<h3 class="widget-title">Meus Produtos</h3>
								<div id="cat-drop-stack">
										<?php
										global $wpdb;
										$post_tmp = get_post( $post_id );
										$seller_id = $post_tmp->post_author;
										$categories = get_transient( 'dokan-store-category-'.$seller_id );

										if ( false === $categories ) {
												$sql = "SELECT t.term_id,t.name, tt.parent FROM $wpdb->terms as t
																LEFT JOIN $wpdb->term_taxonomy as tt on t.term_id = tt.term_id
																LEFT JOIN $wpdb->term_relationships AS tr on tt.term_taxonomy_id = tr.term_taxonomy_id
																LEFT JOIN $wpdb->posts AS p on tr.object_id = p.ID
																WHERE tt.taxonomy = 'product_cat'
																AND p.post_type = 'product'
																AND p.post_status = 'publish'
																AND p.post_author = $seller_id GROUP BY t.term_id";

												$categories = $wpdb->get_results( $sql );
												set_transient( 'dokan-store-category-'.$seller_id , $categories );
										}

										$args = array(
												'taxonomy'      => 'product_cat',
												'selected_cats' => ''
										);

										$walker = new Dokan_Store_Category_Walker( $seller_id );
										echo "<ul>";
										echo call_user_func_array( array(&$walker, 'walk'), array($categories, 0, array()) );
										echo "</ul>";
										?>
								</div>
						</aside>
					<aside id="dokan-store-location" class="widget dokan-store-location">
								<h3 class="widget-title">Localização da Consultura</h3>
								<script type="text/javascript">
								<?php
								$locations = explode( ',', $map_location );
								$def_lat = isset( $locations[0] ) ? $locations[0] : 90.40714300000002;
								$def_long = isset( $locations[1] ) ? $locations[1] : 23.709921;
								?>
									var def_longval = <?php echo $def_long; ?>;
									var def_latval = <?php echo $def_lat; ?>;
									var map;
									$(document).ready(function(){
										map = new GMaps({
											el: '#map',
											lat: def_latval,
											lng: def_longval,
										});
										map.addMarker({
											lat: def_latval,
											lng: def_longval,
											mouseover: function(e){
												if(console.log)
													console.log(e);
											}
										});

									});
								</script>
										<div id="map"></div>
						</aside>
					<aside id="dokan-store-contact-widget" class="widget dokan-store-contact">
						<h3 class="widget-title">Fale comigo</h3>
						<form id="dokan-form-contact-seller" action="" method="post" class="seller-form clearfix">
					    <div class="ajax-response"></div>
					    <ul>
					        <li class="dokan-form-group">
					            <input type="text" name="name" value="" placeholder="<?php esc_attr_e( 'Your Name', 'dokan' ); ?>" class="dokan-form-control" minlength="5" required="required">
					        </li>
					        <li class="dokan-form-group">
					            <input type="email" name="email" value="" placeholder="<?php esc_attr_e( 'you@example.com', 'dokan' ); ?>" class="dokan-form-control" required="required">
					        </li>
					        <li class="dokan-form-group">
					            <textarea  name="message" maxlength="1000" cols="25" rows="6" value="" placeholder="<?php esc_attr_e( 'Type your messsage...', 'dokan' ); ?>" class="dokan-form-control" required></textarea>
					        </li>
					    </ul>

					    <?php wp_nonce_field( 'dokan_contact_seller' ); ?>
					    <input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>">
					    <input type="hidden" name="action" value="dokan_contact_seller">
					    <input type="submit" name="store_message_send" value="<?php esc_attr_e( 'Send Message', 'dokan' ); ?>" class="dokan-right dokan-btn dokan-btn-theme">
					</form>
					</aside>
					</div>
					</div>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
</body>
<?php get_footer( 'shop' ); ?>
