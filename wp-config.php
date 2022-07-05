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
define( 'DB_NAME', 'testwordpress_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'nX7>aay^]5K%TWqE)*~!Xe!Y_.Hf+2/&k7!*^hf+KAbM[W Uzcr#}9JYJ3<v!25n' );
define( 'SECURE_AUTH_KEY',  'X5`&!Hsc<9`y k^7~$~TN=?-SreV}z<QV!)c`fgCj|}$cv^T}}.tx)J:n.?9(Ch_' );
define( 'LOGGED_IN_KEY',    'L%WV D]]z?&/N<j-rhf9,u;9S1zrilTD^7>MD0IL}ja|[lU  PgE}1=3j9|84$wA' );
define( 'NONCE_KEY',        'u+t?F4=r4Zm`c=aPRSu`TrHH6KT)#F&.#/i!T6}{P@6DM&+=%14Fv0NBnV#RL{vY' );
define( 'AUTH_SALT',        '}2ji3Ot$?~gAm @DYq;)Ym6 > PoF@Btq}d|8q!}ZHyF=(O`k,vwbO(xoO9O5Wpf' );
define( 'SECURE_AUTH_SALT', '@q6vRxAE(?g#;ByCZ_3l% ,BnV(fY+p6ZwV*%!1P=zf~>HEp<MT^Bk*HX24$fCJU' );
define( 'LOGGED_IN_SALT',   'd%:Wn{U7@#1M^L=-M0Z|/%0Ap G4U2RL-N`jC.Bh:M#dH`Ae+04F4&H0+;$XwEfU' );
define( 'NONCE_SALT',       '%Bh?>7Xw>uCF752ZG;fQ^xb_P%*D+jY#@n[(C9]}M(+rvS:1T@(B]O7t0eU`*1K3' );

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
