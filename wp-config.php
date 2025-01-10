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
define( 'DB_NAME', 'wordpress_woo' );

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
define( 'AUTH_KEY',         'n>H4*17nnHq]%}*SY62p>?]l,dbY[Z{F@&/rS.QK1-7`,^#85AH9&]B&n:O>|}[@' );
define( 'SECURE_AUTH_KEY',  '$lTZ;xLn!E[qtdzWx8RQbhQACx$@wfB,4$g>)Hb=-[(X@wI2[^IxU4&[:0vVw1_L' );
define( 'LOGGED_IN_KEY',    '8)]SBwk;#*qM3An:e>1dfvtf%n%#=5e$Plq;&2eH)C7x#_j}~3K,#>j~[J!c|vc,' );
define( 'NONCE_KEY',        'P|xUL]}f^eA{2`j7LM&Do@b{DG[H*laJc,E5Rb?vdC!>-I+c>H`kEHh& 8<.NN2.' );
define( 'AUTH_SALT',        '(z}heD>_@nf5cHN`Wx}VUJ)sfE( EBM0^mWxp `B+(NulY*.ula?]2R;,TLT4>32' );
define( 'SECURE_AUTH_SALT', '$TIn.ZzMOmbh|FG`~e?KWBu^IyJ+w;4@ae@;TJj><7l:0_<Y8>k(v6@*.mqL(1DQ' );
define( 'LOGGED_IN_SALT',   ']IR<FW,U*(${n|L}!Q$_7yUV$keK*3ZF0mYdqfzy25S)Ht!w7d$lTnx>tX42s5CU' );
define( 'NONCE_SALT',       '}O:N)L7=QN*Z3!j94SLt`+_FRI ]2AE0$DhMj_R.G[;T?mx|*K{EJC<$dlv,D#nk' );

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
