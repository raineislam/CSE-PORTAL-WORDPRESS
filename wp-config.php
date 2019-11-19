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
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/srv/disk14/2272334/www/cseportal.co.nf/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', '2272334_wpress76455436');

/** MySQL database username */
define('DB_USER', '2272334_wpress76455436');

/** MySQL database password */
define('DB_PASSWORD', '34549019ri');

/** MySQL hostname */
define('DB_HOST', 'fdb5.runhosting.com');

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
define('AUTH_KEY',         '[@0/R3j{9_:7sTyxU}oTG2ql$bdxYTxh?Fru`Pm~SuVSY$w64)m6#y,RRqsw5~2a');
define('SECURE_AUTH_KEY',  'm([kHfK_hYY-.iwU.,pH`!w_1Nm[Ah;29e=}WTe&F$k56[4f_18h;[bwXg_YfJ4<');
define('LOGGED_IN_KEY',    '6<C.;1mX(&9kPKaxFOO8[kgzABMoDYw$fPCo63.!)$s8y:*!tk3;`g9yp[;0klNr');
define('NONCE_KEY',        'HsGb~C!`$3zUj~B,7hyT61G:D^_nzby*~;Khwf1#P962I]QdHhmxAYMa;XP/cmF/');
define('AUTH_SALT',        'RWBO3+*.u=%pknq(@qSI^ cq+;b.N7o$zm@ByA<K V[;JOI2U!ZKM~!I^i.Jk]8C');
define('SECURE_AUTH_SALT', ';Q#[M[J!Wi/o<zim<@^Co)c%4=em6$$@:j_0tkb3]`%ZT;w8+d$[XX88w:%/Mj4&');
define('LOGGED_IN_SALT',   '(z,{kiR rf:}=e__RW`^X<k9p=K2zJ5Y`si<V8eU.WMK7Q[O>yp?;XNLp2nY 4u)');
define('NONCE_SALT',       '7=hh;qHv^B]h3I/IrBJ:B,PpFh#<hG|-VJ^-Onned1p-^S7d`+%-we^^z)au&)se');

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
