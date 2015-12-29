<?php
/**
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/consultorasdobra/public_html/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'consulto_devH');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'consulto_prod');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'i2j5t7e7');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '>W_}uf+v&PH/K&=n+::8M(/N%fS#F$|J,nU9pZ}nzeOGV2pljWbA0T@=hemRKfA;');
define('SECURE_AUTH_KEY',  'M} @Y5IC-NrHX&#%nO#I|hWMq}6xaB<9Mgxbs,otw}r<(gJX4x:H]oWvWw4z$PYZ');
define('LOGGED_IN_KEY',    't!3 XsK7Y}xKe3^l[FPLIF|^dlwIGKeHJ}f c89Aqbj!(NP3Edo4uQgA,l8h#cuE');
define('NONCE_KEY',        'B?QDn o)n<7nqQF.#?Sjj+>.p*~4TGD|A{nIxZ~5#o!!g|}QR y5)*-vy[-b?eGz');
define('AUTH_SALT',        '=s-]/F|+K-Or<Kq:;i N8>HNbf&#0G9=MH-6HGY7kr;n~g)h:>y(uL&L;C}ta=M@');
define('SECURE_AUTH_SALT', 'NrB>GWf,]0d~@*0;~q~-7AFi0${C*iiG:X6MF$1$DaUpE_N+!8p<jd*fjjD]{<||');
define('LOGGED_IN_SALT',   '/.rpM>p~<:o`8FI}VFg]7/7gaFTVBl$2ZMlSuHWRKES8(h+]]P4WWS?iE3^w00qS');
define('NONCE_SALT',       ']T+pxD+4TDP;IoV;QTs~^NdRR}[.p&XQ$NV$&?DJ%x$s10sx.|?sz#qj=4E|H>gc');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
