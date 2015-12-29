<?php get_header(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/filtro/js/jquery-2.1.1.js"></script>
<!--FILTRO DE BUSCA-->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/filtro/css/style.css"> <!-- Resource style -->
<script src="<?php echo get_template_directory_uri(); ?>/filtro/js/modernizr.js"></script> <!-- Modernizr -->
<script src="<?php echo get_template_directory_uri(); ?>/filtro/js/jquery.mixitup.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/filtro/js/main.js"></script> <!-- Resource jQuery -->
<?php $sellers = dokan_get_sellers( $limit, $offset ); ?>

	<main class="cd-main-content">

		<?php
		$query = "SELECT brand_name FROM wp_consultoras_brands wcb ORDER BY brand_name ASC";
		// $query = "SELECT * FROM wp_usermeta WHERE meta_key='dokan_profile_settings'";
    $brands = $wpdb->get_results($query);
		// echo '<pre>';
		// print_r($brands);
		 ?>
		 <?php
		 $query = "SELECT sigla FROM wp_estados ORDER BY sigla ASC";
		 $estados = $wpdb->get_results($query);
		//  echo '<pre>';
		//  print_r($estados);
			?>

		 <form>
			 <div class="cd-filter-block h">
				 <div class="cd-filter-content">
					 <input type="search" placeholder="Busca livre">
				 </div> <!-- cd-filter-content -->
			 </div> <!-- cd-filter-block -->

			 <div class="cd-filter-block h">
				 <div class="cd-filter-content">
					 <div class="cd-select cd-filters">
			 <select class="filter" name="selectThis" id="selectThis">
					 <option value="">ESCOLHA UMA MARCA</option>
				 <?php foreach($brands as $brand){  ?>
				 <option value=".<?php echo $brand->brand_name ?>"><?php echo $brand->brand_name ?></option>
				 <?php } ?>
				 </select>
			 </div>
			 </div>
		 </div>

			 <div class="cd-filter-block h">
				 <div class="cd-filter-content">
					 <div class="cd-select cd-filters">
						 <select class="filter" name="selectThis" id="selectThis">
							 	 <option value="">ESCOLHA UM ESTADO</option>
							<?php foreach ($estados as $estado): ?>
								<option value=".<?php echo $estado->sigla; ?>"><?php echo $estado->sigla; ?></option>
							<?php endforeach; ?>
						 </select>
					 </div> <!-- cd-select -->
				 </div> <!-- cd-filter-content -->
			 </div> <!-- cd-filter-block -->

		 </form>

		<section class="cd-gallery">
			<ul>
        <?php foreach ( $sellers['users'] as $seller ) { ?>
          <?php
            $store_info = dokan_get_store_info( $seller->ID );
            $banner_id  = isset( $store_info['banner'] ) ? $store_info['banner'] : 0;
            $store_name = isset( $store_info['store_name'] ) ? esc_html( $store_info['store_name'] ) : __( 'N/A', 'dokan' );
            $store_url  = dokan_get_store_url( $seller->ID );
					  $endereco   = dokan_get_seller_address($seller->ID);
            ?>
						<?php
			         if (isset($store_info['address']) && !empty($store_info['address'])) {
			             $endereco    = $store_info['address'];
			             $estadoAtual = $_GET['estado'];
			             $h           = $endereco['street_1'];
									 $a           = $endereco['city'];
			           }
			         ?>
						<?php
			         if (isset($store_info['address']) && !empty($store_info['address'])) {
			             $endereco    = $store_info['address'];
			             $estadoAtual = $_GET['estado'];
			             $h           = $endereco['state'];
								 }
			         ?>

        <li class="mix <?php if ( isset( $store_info['brands'] ) ) { $marca = isset( $store_info['brands'] ) ? $store_info['brands'] : '';  echo $str = implode(" ",$marca); } ?> <?php echo $store_name; ?> <?php echo $h; ?>">
					<div class="dokan-store-thumbnail">

							<a href="<?php echo $store_url; ?>">
									<?php if ( $banner_id ) {
											$banner_url = wp_get_attachment_image_src( $banner_id, 'medium' );
											?>
											<img class="dokan-store-img" src="<?php echo esc_url( $banner_url[0] ); ?>" alt="<?php echo esc_attr( $store_name ); ?>">
									<?php } else { ?>
											<img class="dokan-store-img" src="<?php echo dokan_get_no_seller_image(); ?>" alt="<?php _e( 'No Image', 'dokan' ); ?>">
									<?php } ?>
								<span class="profile-img-sellers2"> <?php echo get_avatar( $seller->ID); ?></span>
							</a>

							<div class="dokan-store-caption">
									<h3><a href="<?php echo $store_url; ?>"><?php echo $store_name; ?></a></h3>

									<address>


                    <?php if ( isset( $store_info['address'] ) && !empty( $store_info['address'] ) ) { ?>
											<br /><i class="fa fa-map-marker"></i>
                  	<?php echo $a; ?>  <?php echo $h; ?>
										<br />
									<?php if ( isset( $store_info['brands'] ) ) { ?>
										<i class="fa fa-tags"></i>
									<?php $marca = isset( $store_info['brands'] ) ? $store_info['brands'] : '';  echo $str = implode(" ",$marca);  ?>
								<?php	 } ?>

                    <?php } ?>
											<br />
										<?php if ( isset( $store_info['phone'] ) && !empty( $store_info['phone'] ) ) { ?>
														<i class="fa fa-phone"></i>
														<?php echo esc_html( $store_info['phone'] ); ?>
										<?php } ?>



									</address>

									<p><a class="dokan-btn dokan-btn-theme" href="<?php echo $store_url; ?>"><?php _e( 'Visit Store', 'dokan' ); ?></a></p>

							</div> <!-- .caption -->
					</div> <!-- .thumbnail -->
        </li>
        <?php } ?>
			</ul>
			<div class="cd-fail-message">NADA LOCALIZADO</div>
		</section> <!-- cd-gallery -->
	</main>
	<style >
	span.profile-img-sellers img {
	    border-radius: 52px;
	    margin: -46px 69px 6px;
	    box-shadow: 1px 2px 3px #A7AE94;
	    width: 41%;
	}
	span.profile-img-sellers {
    margin-top: -13px;
    position: relative;
    top: -54px;
}
		.dokan-store-caption {
		    padding: 20px 20px 20px 20px;
		    text-align: center;
		    text-transform: uppercase;
		}

	</style>
<?php get_footer(); ?>
