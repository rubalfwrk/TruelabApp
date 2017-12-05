<?php
// phpinfo();
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'BBBn1tz_Truelab');

/** MySQL database username */
define('DB_USER', 'BBBn1tz_Truelab');

/** MySQL database password */
define('DB_PASSWORD', 'Doctorslab1');

/** MySQL hostname */
define('DB_HOST', '76.162.223.2:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ']E&.l=<~F=+!#lZ*Avf(%*k8zT;_TcI[!hsBhE]eEY2eh,W`!Bf1ab E(C)cKIQ-');
define('SECURE_AUTH_KEY',  '.0CmFid2I=H~}^!Y#=*)^yF?R9~dRGLHo1~aB~+:&XiD*dq$8ntOdT63^3@!K_&=');
define('LOGGED_IN_KEY',    'yvJ/!~n+a|8g{8oUCASk*WrI;[cM$:VdP/S?BERj(=~vRq{Blps9& aQ^m)CU,3/');
define('NONCE_KEY',        'q1wze,Q@H2>jDN9b!}b;&P21Bh lvINk$$>7DslSFf<xZU{;mZr*-Oycb/@[l|Yl');
define('AUTH_SALT',        ']oN|w4N5~V8*Ac4:E;IWpxv~UY)32}-}@fRS(US=^CSX~gO[w90Mw2#U!q4N,]rR');
define('SECURE_AUTH_SALT', 'jh*hDBHgjUt/@l@Xx vLu$_l(/&w?x7hE?5/N{&-kk8`tgo]L95i<R[-wKm4R_Z:');
define('LOGGED_IN_SALT',   '}xc{gM_+bh@cUjrTn)<rj}I V[$r_s(<!nAhGG*eGo3ql35?,cF/w`q>w1QFbHdq');
define('NONCE_SALT',       'q7 9pg&:r!4M{9O?+/xNhhY|=kD w]e~P*0a$1f DKVq*UJHIFGE`y)N}(Upv~Y2');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

// define( 'WP_MEMORY_LIMIT', '1024M' );
