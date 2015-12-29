<?php get_header(); ?>
<?php $sellers = dokan_get_sellers($limit, $offset); ?>
<div id="primary" class="content-area col-md-12">
    <div id="content" class="site-content" role="main">

<?php
   $estadoAtual = $_POST['estado'];
   $NomeAtual   = $_POST['Nomecategoria'];

   if(  $estadoAtual == AL || $estadoAtual == GO ||
        $estadoAtual == MG || $estadoAtual == PE ||
        $estadoAtual == RO || $estadoAtual == RR ||
        $estadoAtual == SC || $estadoAtual == SP ||
        $estadoAtual == SE || $estadoAtual == TO
      ){
          echo $nc .= '<div id="rato">'.$NomeAtual.'</div>';
          echo $onde .= '<div id="camposH"><h1> COM CONSULTORAS EM ' . $estadoAtual . '</h1></div>';

   }else if(
    $estadoAtual == BA || $estadoAtual == PB
   ){
     echo $nc .= '<div id="rato">'.$NomeAtual.'</div>';
     echo $onde .= '<div id="camposH"><h1> COM CONSULTORAS NA ' . $estadoAtual . '</h1></div>';

   }else{
     echo $nc .= '<div id="rato">'.$NomeAtual.'</div>';
     echo $onde .= '<div id="camposH"><h1> COM CONSULTORAS NO ' . $estadoAtual . '</h1></div>';
   }

   ?>
   <a href="<?php echo get_site_url(); ?>/catalogo" style="margin: 20px 0px;" class="btn btn-primary" id="hBt">Nova Pesquisa</a>
<?php
   foreach ($sellers['users'] as $seller) {
   ?>
<?php
   $store_info = dokan_get_store_info($seller->ID);
   $endereco   = dokan_get_seller_address($seller->ID);
   $store_user = get_userdata(get_query_var('author'));

   if (isset($store_info['address']) && !empty($store_info['address'])) {
       $endereco    = $store_info['address'];
       $estadoAtual = $_POST['estado'];
       $h           = $endereco['state'];
     }
   ?>
   <?php if (isset($_POST['estado'])) { ?>
   <?php if ($estadoAtual == $h) { ?>
   <?php
      $author_id  = $seller->ID;
      $categoriaE = $_POST['categoria'];
      $values[] = "$author_id";
      ?>

<?php } ?>
<?php } ?>
<?php } ?>

<?php

if ( get_query_var('paged') ) {
   $paged = get_query_var('paged');
} else if ( get_query_var('page') ) {
   $paged = get_query_var('page');
} else {
   $paged = 1;
}
if(!empty($author_id) && !empty($categoriaE )){
  $my_args = array(
    'post_type' => 'product',
    'posts_per_page' => 24,
     'author__in' =>  $values,
     'tax_query' => array(
         array(
             'taxonomy' => 'product_cat',
             'terms' => $categoriaE
         )
     ),
    'paged' => $paged
  );

}else{

  $my_args = array(
    'post_type' => 'product',
    'posts_per_page' => 24,
     'author__in' =>  $values,
    'paged' => $paged
  );

}

$my_query = new WP_Query( $my_args );

echo '<div class="woocommerce">';
echo '<ul class="products">';
echo '<li>';
if ( $my_query->have_posts() ) :
  while ( $my_query->have_posts() ) : $my_query->the_post();
    wc_get_template_part( 'content', 'product' );
  endwhile;
echo '</li>';
echo '</ul>';
echo '</div>';
if ( function_exists('vb_pagination') ) {
  vb_pagination( $my_query );
} ?>

<?php else: ?>
  <div class="limpa"></div>
  <h2 id="desculpa">Desculpe não encontramos nada</h2>
<?php endif; ?>
</div>
</div>
<script type="text/javascript">
var estado=
  if(){

  }
</script>
<?php get_footer(); ?>
