<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'interlingua_sitio');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'huo0lpaw');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'TA<^}Q-,y!0g&zCG+MkDJi^}D+f#JB6WG58H%aUrO|*?l$a};gtc>q~_F5q2$f?4');
define('SECURE_AUTH_KEY',  ':v0X{Ws[djLKj3OV,P6FDU9&KLYS<EC;FEK]g@$~bl7s?Y-o,SHDS*+]0_X@cz-}');
define('LOGGED_IN_KEY',    '4Ob_.n5FFaN2)9jn|aVRpDN:#]|yRY9`~gW%MJ+,-+x7eOvo#zJ`1f!7r;+p|ueL');
define('NONCE_KEY',        '<f<+:{u%SE1:ucH+r7(H|r7=(CJsp]WWdHMNF5SX+y+%!2+dGM(6Q}ujBgbyi6w^');
define('AUTH_SALT',        'G#GS0Cl#iP]q&/Y9mIvL;T[3L8hRZ 0aes<[>3QoU(aN-/zxzLbA:WKRQbM;KAPI');
define('SECURE_AUTH_SALT', '@#|@QWsUMiV^?@O7M&b.7]}:A  2 ^QOWN?wXD;IQl49%z=R)y/uec ;K-r8{}Em');
define('LOGGED_IN_SALT',   ')fsm`2z|JPvf=i.|J+xd=O+0y0sFlf*N4 Z5snmuy(9S#E3f@+6E+,Z5O7+^2UN~');
define('NONCE_SALT',       '7$YzDs]f8XDNws-7(rZBU;;!OYG,SrD.E R_Y~#S]t<g[ 34W1*T0/@^|ev;^wTf');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

