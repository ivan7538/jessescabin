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
define( 'DB_NAME', 'jessescabin' );

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
define( 'AUTH_KEY',         'C|.|oH&&62m5S/O_K>~h:(s8Y^Cty9c{~/^7G4n$>ZtACtq<bz>Hq7*s-WvgrpM_' );
define( 'SECURE_AUTH_KEY',  'v+^bjdID$x2N%l`!LhLJE?61tc;GdhxV*K4e<=p>:-bYL/fM+-|n$*Ul</s|Gf1>' );
define( 'LOGGED_IN_KEY',    ']l^|[~pVc^Ie~8-k3swrmHyY+Di-5sV)ZBy#?]&UN`o@aA`c-%eoLttAMah$N,y~' );
define( 'NONCE_KEY',        '@rZ}1IT|N:4tP7(kC$Gj%&NTU5i4-(UtZuRbBQ~$j`<^V~fPT<O;p#%mcAy4z8Mw' );
define( 'AUTH_SALT',        'ie,U3^%b7oqvKjl?;C$4e S@R0m#TdsXqN@J;<p4-m}]:o,u Os,c+Ua~r>0+8=l' );
define( 'SECURE_AUTH_SALT', '[Ht6<{eTL=3KD,M:C$fY9/pD*/mrp 00XBFBwa1=YNuOE~v[-wJD`$ZW+1Y8&U8~' );
define( 'LOGGED_IN_SALT',   'fRj+8H+Kt%+.Gacg>[4ObKOYWjgRPX9k#(JyjC<9]9xpOZ9Om]1 y3T|(39=0nqc' );
define( 'NONCE_SALT',       'Fm!C)i7Lh|q }mA+w3Mf$rJt<=1C>@oXY-[feI``-MuE3`zF3dmh97A)Mo:NbbLu' );

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
