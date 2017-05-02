<?php
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
define('DB_NAME', 'tododb');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '=S)+VkT< +:AOzT9,YxUJ)A%[tL/#/n~X#!c&`h_4~|>I0t:a`$`tq.:*ww+vuBE');
define('SECURE_AUTH_KEY',  '=48 ||0@#on8L|J)kfKOw3zql8bPDrN`~s_hQ[x!OA}OvkY@,CfPt/pOo*2kiK=+');
define('LOGGED_IN_KEY',    'kG<pw:lwYZ$M(%1^9Wb;vTn,l>%d[F?xU3^s{ <_2e=nxD_|~Mue&$b9tx;pO O<');
define('NONCE_KEY',        'e4fW<i;AVgTuN$Ud@b>G>?kFq;?4%,1OVVj?$Qa-d=?1lQ_>?#aPigK(f8w7_{7|');
define('AUTH_SALT',        '%4&0B,,yrtg.rWGHmUqk(xI%{Uq!Ge!+=4-Z.rZuGkR.C6f)nIe-T,a#.aC,xc(|');
define('SECURE_AUTH_SALT', 'w;NV,Nlo-hQ5yc_pW(:N8PP4sK lNv4pY]~Nj.x+:w(5QhM$z}IGR7nc:0<*/w3>');
define('LOGGED_IN_SALT',   'PN1<b^)V9a70Se{TfsZN~EJ3Xyq#[_9yPV47{`a|K]}f6jF^?TdzE/+=T#kER*b1');
define('NONCE_SALT',       ' |+6sQgbcVgd6k`g_)6e6]+2Orl.+_P;g_0_TiCMSMQ}|[eOHs][C5#~i}3NRY?&');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
