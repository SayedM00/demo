<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'demo' );

/** Database username */
define( 'DB_USER', 'ita' );

/** Database password */
define( 'DB_PASSWORD', '27981350s' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '%uL)dtBxByxA/O6*fh];:)xUtDSNFAbt WJ!H8HQ?-Oom2TW2Tn(__9f{2R9r=G1' );
define( 'SECURE_AUTH_KEY',  'WlkO(G.*=m*vheVl[c:J/F,]:T5xr::bw;cQqRDIItN!sJX{!,hs<G,:8HBh`!-k' );
define( 'LOGGED_IN_KEY',    '+ukI1o4s||+rf<)A3/w howr0I9:3K+$IlH.~S|8I)8<G~wEerGV0oKYS-u0+L8*' );
define( 'NONCE_KEY',        'j7DeGP<8ae,}:[h*1uv]UlBF[}U8&lim|&)7<)d0Xm*~Q^<IyL`qy`!~~s~?kn:Y' );
define( 'AUTH_SALT',        ' g5<48pE1JmQ9x6RK146u!ssE24)S2*8f2nQp-1G,u?!Xs%|FbZ{=*#wRH.<#Se=' );
define( 'SECURE_AUTH_SALT', 'WqK8@3pNWSbjW}JE=l=&:xS3uj-CM!bMfvbjr2LS(797#clgv.k-z3W/rd1P*Cm&' );
define( 'LOGGED_IN_SALT',   'MCp$*Z=d i?T4gU2Q{zb{w JDD=7f.a#GLL5Z-&ifkpehb9bZkLk?iip8K&tiSe.' );
define( 'NONCE_SALT',       ' I5thSdvFY*xXu=b)|T=Y+2y?CnTKY,)_6H~E(2*DYxucC5]fG)Twxj;[P9+<N9!' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
