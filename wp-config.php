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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'marknguyen' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'a<W~J|Ork(a>wm:g1{RylhK[)1PEkWl.?Z_emG0G9.^?}57 {(F-&m_Y/~L@F,H ' );
define( 'SECURE_AUTH_KEY',  '>9`B/+:wPVy`y9K,w>4Jt2vscmkC7t.;^mR5R=Y!VKkq<PE@6D,2)IwJJ,MS77iu' );
define( 'LOGGED_IN_KEY',    'HqI&:r98ACfO[)Ov 56.U?/mAD}>;EyZpqb44q>cI%^}LOP=;c`~Dtme4F{3`^;o' );
define( 'NONCE_KEY',        'sO[2,7(recNrTw?[P9}GyX9~a#~l}<bxTlS^xl^JG3;i!T7z;d!?J)fQ,Q9>2kQ;' );
define( 'AUTH_SALT',        'e/Fe&r/P8BE1AEx:/%b-:R+ZWfqE2G9=hBvi(@ _1SyxXGZ%O@z`08,:OfIa,-I-' );
define( 'SECURE_AUTH_SALT', 'BN#>-~#8*,Yeo^_AqVM9$~wTi->lw]{@l$.q?S21viU`(G0Snhs>@qhs1L5oV _h' );
define( 'LOGGED_IN_SALT',   '=`EP$WAQ67ln9rSIL|-ziUbLfX~vK(U/jU6tZAW@mkGAZzQovwV$Z~;]@Z9s:=1z' );
define( 'NONCE_SALT',       '&gfAD>8#%3_+5}XJ3W:8jdnOmQe s=qLMt.>st~V._xu3bR6}wYma,Fg178|v:X:' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
