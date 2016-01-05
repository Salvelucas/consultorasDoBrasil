<?php ob_start() ?>

<?php
function patricks_billing_fields( $fields ) {
	global $woocommerce;
	// if the total is more than 0 then we still need the fields
	if ( 0 != $woocommerce->cart->total ) {
		return $fields;
	}
	// return the regular billing fields if we need shipping fields
	if ( $woocommerce->cart->needs_shipping() ) {
		return $fields;
	}
	echo '<style>.woocommerce { display: none; } </style>';
  $zeroG .="<script type='text/javascript'> $('h1.entry-title').html('<h6>VOCÊ SERÁ REDIRECIONADO EM ALGUNS SEGUNDOS AGUARDE</h6>'); </script>";
	echo $zeroG;
	$zeroT .="<script type='text/javascript'> $('.woocommerce-info').html( '<h5></h5>' );</script>";
	echo $zeroT;
  // we don't need the billing fields so empty all of them except the email
  unset( $fields['billing_country'] );
  unset( $fields['billing_first_name'] );
  unset( $fields['billing_last_name'] );
  unset( $fields['billing_company'] );
  unset( $fields['billing_address_1'] );
  unset( $fields['billing_address_2'] );
  unset( $fields['billing_city'] );
  unset( $fields['billing_state'] );
  unset( $fields['billing_postcode'] );
  unset( $fields['billing_phone'] );
  unset( $fields['billing_number'] );
  unset( $fields['billing_neighborhood'] );
  unset( $fields['billing_cellphone'] );
  unset( $fields['billing_cpf'] );
	return $fields;
}
add_filter( 'woocommerce_billing_fields', 'patricks_billing_fields', 20 );
 ?>
<?php
/**
 * WooCommerce
 *
 * Unhook sidebar
 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
function wc_remove_required_last_name( $fields ) {
	unset( $fields['account_last_name'] );
	return $fields;
}
	function vb_pagination( $query=null ) {
	  global $wp_query;
	  $query = $query ? $query : $wp_query;
	  $big = 999999999;
	  $paginate = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'type' => 'array',
	    'total' => $query->max_num_pages,
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'prev_text' => __('&laquo;'),
	    'next_text' => __('&raquo;'),
	    )
	  );
	  if ($query->max_num_pages > 1) :
	?>
<ul class="pagination">
	<?php
		foreach ( $paginate as $page ) {
		  echo '<li>' . $page . '</li>';
		}
		?>
</ul>
<?php
endif;
} ?>
<?php
 //Chamando tema filho:
define( 'THEMEROOT', get_stylesheet_directory_uri() );
function scripts(){
wp_enqueue_style( 'dokan-child', THEMEROOT.'/style.css', false, null );
}
add_action( 'wp_enqueue_scripts', 'scripts', 99);
?>
<?php
error_reporting(0);
function consultoras_is_checked($brands,$brandValue)
{
    if(in_array($brandValue,$brands))
    {
        return 'checked="checked"';
    }
}
function extra_fields( $current_user, $profile_info ) {
	$brands = isset( $profile_info['brands'] ) ? $profile_info['brands'] : '';
    ?>

		<div class="gregcustom dokan-form-group">
				<label class="dokan-w3 dokan-control-label" for="setting_address"><?php _e( 'Marcas', 'dokan' ); ?></label>
				<div class="dokan-w5">
						<?php
						$brandArray = consultoras_get_brands();
						foreach($brandArray as $brandvalue)
						{?>
								<div class="bandeirasH"><span><input type="checkbox" name="brands[]" value="<?php echo $brandvalue;?>"  class="<?php echo 'id_' . $store_id; ?>" <?php echo consultoras_is_checked($brands,$brandvalue)?>>&nbsp;&nbsp;<?php echo $brandvalue;?></span></div>
								<?php }?>

				</div>
		</div>
<?php
 ?>
<?php
}
add_filter( 'dokan_settings_after_banner', 'extra_fields');
/**
 * Save the extra fields.
 *
 * @param  int  $customer_id Current customer ID.
 *
 * @return void
 */
function save_extra_fields( $store_id ) {
    $prev_dokan_settings = get_user_meta( $store_id, 'dokan_profile_settings', true );
    $dokan_settings = array();
		        if ( isset( $_POST['brands'] ) ) {
		            $dokan_settings['brands'] = $_POST['brands'];
		        }
    $dokan_settings = array_merge( $prev_dokan_settings,$dokan_settings );
    update_user_meta( $store_id, 'dokan_profile_settings', $dokan_settings );
}
add_action( 'dokan_store_profile_saved', 'save_extra_fields', 15 );
 ?>
<?php
/**
 * Retorna array de marcas da tabela criada wp_consultoras_brands
 * @return mixed
 */
function consultoras_get_brands()
{
    global $wpdb;
    global $path;
    $query = "SELECT brand_name FROM wp_consultoras_brands wcb ORDER BY brand_name ASC";
    $brands = $wpdb->get_results($query);
    foreach($brands as $brand)
    {
        $return[$brand->brand_name] = $brand->brand_name;
    }
    return $return;
}
/**
 * Exibe o formulário com o slect das marcas, estados e campo livre
 * @return string
 */
function consultoras_get_search_form()
{
    //Load Brands;
    $brands = consultoras_get_brands();
    $html = "<form method='get' id='searchform' action='' class='formbusca'>";
    $html .="<div class='formi-groupo'>";
    $html .="<input type='text' class='campobusca' size='42' value='' name='storename' id='storename' placeholder='Nome da Consultora ou Região' />";
    $html .="<select name='brand' id='brand' class='selecbusca'>";
    $html .="<option value=''>Marcas</option>";
    foreach ($brands as $brand)
    {
        $html .="<option value='".$brand."'>".$brand."</option>";
    }
    $html .="</select>";
    $estados = consultoras_get_estados();
    /*$html .= '<select name="state" id="state" >';
    $html.= '<option value="Selecione um Estado">Selecione</option>';
    foreach ($estados as $estado)
    {
        $html .="<option value='".$estado['sigla']."'>".$estado['nome']."</option>";
    }
    $html.= '</select>';*/
    $html .="<input type='submit' id='searchbrand' value='Pesquisar' class='dokan-btn dokan-btn-theme' />";
    $html .="</div>";
    $html .="</form>";
    return $html;
}
function consultorasEstadoBanco()
{
    global $wpdb;
    global $path;
    $query = "SELECT sigla FROM wp_estados ORDER BY sigla ASC";
    $estado = $wpdb->get_results($query);
    foreach($estado as $estados)
    {
        $return[$estados->sigla] = $estados->sigla;
    }
    return $return;
}
function consultorasGetEstadoBanco()
{
    //Load Brands;
    global $product;
    $carregar = consultorasEstadoBanco();
    $cate = get_queried_object();
    $cateID = $cate->term_id;
		$cateName = $cate->name;
	 if($cateID == null){
 }else{
		 $rato = get_category_parents($cateID, TRUE, ' > ');
 }
    $html = "<form method='post' id='procurarEstado' action='http://consultorasdobrasil.com/chamar-estado/' class='formbusca'>";
    $html .="<div class='input-group'>";
    $html .="<input type='hidden' name='categoria' id='categoria' value='$cateID' >";
		$html .="<input type='hidden' name='Nomecategoria' id='Nomecategoria' value='$rato' >";
    $html .="<select name='estado' id='estado' class='form-control'>";
    $html .="<option value=''>Escolha um estado</option>";
    foreach ($carregar as $brand)
    {
        $html .="<option value='".$brand."'>".$brand."</option>";
    }
    $html .="</select>";
    $html .="<span class='input-group-btn'>";
    $html .="  <button type='submit' id='searchsubmit' class='btn btn-primary'>Pesquisar</button>";
    $html .="</span>";
    $html .="</div>";
    $html .="</form>";
    return $html;
}
class Foo_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'foo_widget', // Base ID
			__( 'Consultora do Produto', 'text_domain' ), // Name
			array( 'description' => __( 'Aparece no Single Product', 'text_domain' ), ) // Args
		);
	}
	/**
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		//
		// Post Content here
		//
	} // end while
} // end if
		global $product;
		$author     = get_user_by( 'id', $product->post->post_author );
		$store_info = dokan_get_store_info( $author->ID );
		$banner_id  = isset( $store_info['banner'] ) ? $store_info['banner'] : 0;
		$store_url  = dokan_get_store_url( $author->ID );
?>


		<h3 class="widget-title"> <?php echo esc_html( $store_info['store_name'] ); ?> </h3>
		<a href="<?php echo $store_url; ?>">
			<?php if ( $banner_id ) {
				$banner_url = wp_get_attachment_image_src( $banner_id, 'medium' );
				?>
				<img class="dokan-store-img" src="<?php echo esc_url( $banner_url[0] ); ?>" alt="<?php echo esc_attr( $store_name ); ?>">
			<?php } else { ?>
				<img class="dokan-store-img" src="<?php echo dokan_get_no_seller_image(); ?>" alt="<?php _e( 'No Image', 'dokan' ); ?>">
			<?php } ?>
			<span class="profile-img-sellers-prod"> <?php echo get_avatar( $author->ID); ?></span>
		</a>

<span class="dadoconsultora">
		<?php
		printf( 'Consultora: <a href="%s">%s</a>', dokan_get_store_url( $author->ID ), $author->display_name );
		if ( !empty( $store_info['address'] ) ) { ?>

				<span><br><b><?php _e( 'Address:', 'dokan' ); ?></b></span>
            <span class=" ">
                <?php echo dokan_get_seller_address( $author->ID ) ?>
            </span>
			<?php if ( isset( $store_info['phone'] ) && !empty( $store_info['phone'] ) ) { ?>
				<br>
				<abbr title="<?php _e( 'Phone Number', 'dokan' ); ?>"><?php _e( 'P:', 'dokan' ); ?></abbr> <?php echo esc_html( $store_info['phone'] ); ?>
				<!-- <p><a class="dokan-btn dokan-btn-theme" href="<?php echo $store_url; ?>"><?php _e( 'Visit Store', 'dokan' ); ?></a></p> -->
			<?php } ?>
</span>
		<?php } ?>


		<?php
		//dokan_get_template_part('global/product-tab', '', array(
			//'author' => $author,
			//'store_info' => $store_info,
		//) );
		echo $args['after_widget'];
	}
	/**
	 * Prints seller info in product single page
	 *
	 * @global WC_Product $product
	 * @param type $val
	 */
	function dokan_product_seller_tab( $val ) {
		global $product;
		$author     = get_user_by( 'id', $product->post->post_author );
		$store_info = dokan_get_store_info( $author->ID );
		dokan_get_template_part('global/product-tab', '', array(
			'author' => $author,
			'store_info' => $store_info,
		) );
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
	<?php
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} // class Foo_Widget
?>
<?php
// register Foo_Widget widget
function register_foo_widget() {
    register_widget( 'Foo_Widget' );
}
add_action( 'widgets_init', 'register_foo_widget' );
// Fim do Widget Consultora do Produto.
?>
