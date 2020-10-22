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
define( 'DB_NAME', 'wp_course_locator' );

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
define( 'AUTH_KEY',         ':HoyM^hL! 4NdUBSVyArn8B7d%&i}CARLINmq%`lA}r9C/ZsS9Y#Bsb}VuQM[XN!' );
define( 'SECURE_AUTH_KEY',  '={|r&!SL/P,$Kb.tG  j%,EG&erm]ay6-OWJCb(U`$zc:s!>ZXx~!3g4N/oV|amw' );
define( 'LOGGED_IN_KEY',    'kB6TLhF<+f41YAxnEfF7n&(,AZKMI<aT<O|j6(vx8}&?hJfyA$S(z:,6|!&f=Ke#' );
define( 'NONCE_KEY',        'i$O~nh%yyA1jzA$29g=%B(nDo<Q%Nc$I)HvVT}&z[FZ|WiZ.!c`G^k>#@h:a<gD7' );
define( 'AUTH_SALT',        '=qem~ >|B|}Fru<<A)-cDGvOi<qj1S%0&uLDLwY:E/r=L)#,TvxN5# s?OX9y)% ' );
define( 'SECURE_AUTH_SALT', 'KI1{kqosdLL@s.5V?]*t*@hqM[#x.}9YM-(wQ1I<7[sV>XXxhR)sM]nW#?}awWai' );
define( 'LOGGED_IN_SALT',   'A-u9vh`BM)GzAA0C!!/nnovBn&}o:N?8*twmacqpkxcjpS:~uW_11U0&<O>;;5NI' );
define( 'NONCE_SALT',       'xYFRH(l@P}eH{lw zStM7<^D}(12o%V}XQknQ$=*k$^bl`m3:6P[S3QW=r*Vxq|_' );

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
