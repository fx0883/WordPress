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
define( 'DB_NAME', 'wordpress_ed' );

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
define( 'AUTH_KEY',         '/Ih0sq)8wG!m.&XHM6|$p79hvMeE?xqc*f_ oOXTa5A& ]9u!2`7ZI.AV+!$t%kt' );
define( 'SECURE_AUTH_KEY',  'h.[fDDLfs(kw YS$,68Ck-51Ntj#qmRCih)BBwzW R1ZkvUz<0?+i$e=Im?oumvQ' );
define( 'LOGGED_IN_KEY',    'D^:Vh-R|Aj6eAx`V+@P5iR:yW?2N,sG7390``Atf.SDAG.D*Y_a7[ysweT0p=#QV' );
define( 'NONCE_KEY',        'dR%4x3_Qz-LQ@4NJ01Qsr2JpTG`Rq|TsA2|%5$_dV?.PEHKdA?WLbAy:v4!4.}P&' );
define( 'AUTH_SALT',        '7U(]29HtZP|qcy/md;q#;AGMYk};u0oW]8Y<.33~U#hbN`G!g+ WLU(Kp[` FAu&' );
define( 'SECURE_AUTH_SALT', '_H?G*J8&%P-]=ez(C2;fz,2;&+E%X&DLX4R`{S?g-%/dEvE4@:2UF@&=>-,v0y9O' );
define( 'LOGGED_IN_SALT',   'i}1qn1C!<=(mx<IsJ`hy7hMQP?xqiK3Qsp=&@/c-5.G8mm|;x;pAwn [UlPwfH7#' );
define( 'NONCE_SALT',       'Pi&?{Y-Jzc#95]AWZcgY PBCqcO^t2IlJU[Gr1M{&)2,z#?9-YgIfsE-k]:|Ja1l' );

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
