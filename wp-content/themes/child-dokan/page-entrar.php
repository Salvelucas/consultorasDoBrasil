<?php get_header(); ?>


<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">SOU CONSULTORA</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">SOU CLIENTE</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
      <?php $args = array(
              'echo' => true,
              'redirect' => site_url('dashboard/'),
              'form_id' => 'loginform',
              'label_username' => __( 'Nome de usuário ou E-mail' ),
              'label_password' => __( 'Password' ),
              'label_remember' => __( 'Remember Me' ),
              'label_log_in' => __( 'Log In' ),
              'id_username' => 'user_login',
              'id_password' => 'user_pass',
              'id_remember' => 'rememberme',
              'id_submit' => 'wp-submit',
              'remember' => true,
              'value_username' => NULL,
              'value_remember' => false ); ?>

          <div class="container">

              <div class="card card-container">
                  <p id="profile-name" class="profile-name-card"></p>
              <?php wp_login_form( $args ); ?>
                  <a class="forgot-password" href="<?php echo wp_lostpassword_url(); ?>" title="Lost Password">Esqueceu sua senha</a>
              </div><!-- /card-container -->
          </div><!-- /container -->
    </div>

    <!-- fim da tab consultoras -->
    <div role="tabpanel" class="tab-pane" id="profile">
      <?php $cliente = array(
              'echo' => true,
              'redirect' => site_url('minha-conta/'),
              'form_id' => 'loginform',
              'label_username' => __( 'Nome de usuário ou E-mail' ),
              'label_password' => __( 'Password' ),
              'label_remember' => __( 'Remember Me' ),
              'label_log_in' => __( 'Log In' ),
              'id_username' => 'user_login',
              'id_password' => 'user_pass',
              'id_remember' => 'rememberme',
              'id_submit' => 'wp-submit',
              'remember' => true,
              'value_username' => NULL,
              'value_remember' => false ); ?>

          <div class="container">

              <div class="card card-container">
                  <p id="profile-name" class="profile-name-card"></p>
              <?php wp_login_form( $cliente ); ?>
                  <a class="forgot-password" href="<?php echo wp_lostpassword_url(); ?>" title="Lost Password">Esqueceu sua senha</a>
              </div><!-- /card-container -->
          </div><!-- /container -->


    </div>
    <!-- fim da tab cliente -->
  </div>

</div>
<style>
.card-container.card {
  max-width: 350px;
  padding: 40px 40px;
}


/*
* Card component
*/
.card {
  background-color: #F7F7F7;
  /* just in case there no content*/
  padding: 20px 25px 30px;
  margin: 0 auto 25px;
  /* shadows and rounded borders */
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  border-radius: 2px;
  -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}




input[type=email],
input[type=password],
input[type=text],
button {
  width: 100%;
  display: block;
  margin-bottom: 10px;
  z-index: 1;
  position: relative;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  padding: 10px;
  border: 1px solid #ccc;
}

input:focus {
  border-color: rgb(104, 145, 162);
  outline: 0;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}
input#wp-submit {
    background-color: #8e44ad;
    border-color: #8e44ad;
    color: white;
    width: 100%;
    border: none;
    padding: 7px;
    text-transform: uppercase;
}
    </style>

    <script type="text/javascript">
      $('input#wp-submit').addClass('higor');
      $('input#wp-submit').val('Entrar');
    </script>
<?php get_footer(); ?>
