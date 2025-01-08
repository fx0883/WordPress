<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_edm' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '123456' );

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
define( 'AUTH_KEY',         ';LF<$^$(^i~O9qyM /J?06y@jTQOYU.n3|NZU7u*#bH6Meni<w<rMEGGsL^}^c+p' );
define( 'SECURE_AUTH_KEY',  'VEK+NxLmQQ*F@{a/V_II?H3zM;1@]Ze.SI[!n+`Ee#%`Pn)|)EL9`43;1{bHEY>0' );
define( 'LOGGED_IN_KEY',    'P W}s[3~pe7&A6,k<P8@>i[z=L$/U;]ue#Js>k>Eso5T>o,B=Tu`s_f&esUHgqih' );
define( 'NONCE_KEY',        'RCcuhqR=6Xx34uS5>=GHM.O%9Dd9#Au3+=oqhENkRR_Q4Vr:S8U=V}2J2Tj6b@fW' );
define( 'AUTH_SALT',        'aQ_`4; V#[_ UW8i!G.,Uy>ey*}v7BAvW4AWhzg&oS2bcq,GF;i17=0?BsXnCIIf' );
define( 'SECURE_AUTH_SALT', '+Uwn&0)EKep@G9%eA;E6N+UtnKPvP&xd$7;qF2(vsW%xEP:y/4@u2.Ke.D>.Zj&s' );
define( 'LOGGED_IN_SALT',   'Oy,@AnxI,v%0//YQ`*.j_s~OPj)AUP^j-}Fx1v<k.n5Nbo131%H(hTrGwm1Rj<Up' );
define( 'NONCE_SALT',       '?[3 ld^XVz1c&#,L*,~`XbqjR?`nRmh%YZW,c&w.{+=er7o5m[+6a=yo fvG(J:)' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
