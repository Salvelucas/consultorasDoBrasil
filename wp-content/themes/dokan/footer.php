<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package dokan
 * @package dokan - 2014 1.0
 */
?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="<?php echo get_template_directory_uri(); ?>/map/gmaps.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/dist/sweetalert.min.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dist/sweetalert.css"> <!-- Resource style -->
</div><!-- .row -->
</div><!-- .container -->
</div><!-- #main .site-main -->
<?php global $woocommerce;
// echo '<pre>';
// print_r($woocommerce);
if ( 0 == $woocommerce->cart->total ) { ?>
<script type="text/javascript">
  $('input#place_order').trigger( "click" );
</script>

<?php } ?>
<script type="text/javascript">
$('input#_manage_stock').attr('checked','checked');
$( "label.form-label:contains('Linhas')" ).hide();
$( "label:contains('Habilitar gerenciamento de produtos no estoque')" ).hide();
$( "label.dokan-w3.dokan-control-label:contains('+Infos')" ).hide();
$( "label:contains('Visibilidade')" ).hide();
$( "label:contains('Habilitar somente uma quantidade desse produto a ser comprado em um pedido')" ).hide();
$( "label:contains('Habilitar review de produtos')" ).hide();
$( "input[name*='_enable_reviews']" ).val( "yes" );
$( "input#dokan_store_tnc_enable" ).trigger( "click" );
$( "input#_disable_shipping" ).trigger( "click" );
$('.dokan-checkbox-cat :checkbox').change(function (){
    $(this).siblings('li').find(':checkbox').prop('checked', this.checked);
    if (this.checked) {
        $(this).parentsUntil('.dokan-checkbox-cat', 'ul').siblings(':checkbox').prop('checked', true);
    } else {
        $(this).parentsUntil('.dokan-checkbox-cat', 'ul').each(function(){
            var $this = $(this);
            var childSelected = $this.find(':checkbox:checked').length;
            if (!childSelected) {
                $this.prev(':checkbox').prop('checked', false);
            }
        });
    }
});
$("input[type='checkbox'][name='_enable_reviews']").val('yes');
$(document).ready(function () {
    $(".dokan-checkbox-cat li > ul.children > li input[type=checkbox]").change(function () {
        var maxAllowed = 3;
        var cnt = $(".dokan-checkbox-cat ul.children input[type=checkbox]:checked").length;
        if (cnt > maxAllowed) {
            $('input[type=checkbox]').prop("checked", false);
            swal("OPSS!", "Você marcou mais de 4 categorias. Marque novamente.")
        }
    });
});

$(document).ready(function () {
    $(".dokan-checkbox-cat li > ul.children > li > ul.children  input[type=checkbox]").change(function () {
        var maxA = 3;
        var cntA = $(".dokan-checkbox-cat ul.children input[type=checkbox]:checked").length;
        if (cntA > maxA) {
            $('input[type=checkbox]').prop("checked", false);
            swal("OPSS!", "Você marcou mais de 4 categorias. Marque novamente.")
        }
    });
});

$(document).ready(function () {
    $(".dokan-checkbox-cat > li > input[type=checkbox]").change(function () {
        var max = 1;
        var nt = $(".dokan-checkbox-cat > li >  input[type=checkbox]:checked").length;
        if (nt > max) {
            $('input[type=checkbox]').prop("checked", false);
            swal("OPSS!", "Você so pode escolher uma marca por produto ou categoria de produto personalizado!")
        }
    });
});

</script>
<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="footer-widget-area">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <?php dynamic_sidebar( 'footer-1' ); ?>
                </div>

                <div class="col-md-3">
                    <?php dynamic_sidebar( 'footer-2' ); ?>
                </div>

                <div class="col-md-3">
                    <?php dynamic_sidebar( 'footer-3' ); ?>
                </div>

                <div class="col-md-3">
                    <?php dynamic_sidebar( 'footer-4' ); ?>
                </div>
            </div> <!-- .footer-widget-area -->
        </div>
    </div>

    <div class="copy-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer-copy">
                        <div class="col-md-6 site-info">
                            <?php
                            $footer_text = get_theme_mod( 'footer_text' );

                            if ( empty( $footer_text ) ) {
                                printf( __( '&copy; %d, %s. All rights are reserved.', 'dokan' ), date( 'Y' ), get_bloginfo( 'name' ) );
                                printf( __( 'Powered by <a href="%s" target="_blank">Dokan</a> from <a href="%s" target="_blank">weDevs</a>', 'dokan' ), esc_url( 'http://wedevs.com/theme/dokan/?utm_source=dokan&utm_medium=theme_footer&utm_campaign=product' ), esc_url( 'http://wedevs.com/?utm_source=dokan&utm_medium=theme_footer&utm_campaign=product' ) );
                            } else {
                                echo $footer_text;
                            }
                            ?>
                        </div><!-- .site-info -->

                        <div class="col-md-6 footer-gateway">
                            <?php
                                wp_nav_menu( array(
                                    'theme_location'  => 'footer',
                                    'depth'           => 1,
                                    'container_class' => 'footer-menu-container clearfix',
                                    'menu_class'      => 'menu list-inline pull-right',
                                ) );
                            ?>
                        </div>
                    </div>
                </div>
            </div><!-- .row -->
        </div><!-- .container -->
    </div> <!-- .copy-container -->
</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

<div id="yith-wcwl-popup-message" style="display:none;"><div id="yith-wcwl-message"></div></div>
</body>
</html>
