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
define( 'DB_NAME', 'wordpress' );

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
define('FS_METHOD','direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'EF,nUj`q;nKJwpe&3RB!5/f4cLcoe7zZ]8:>MH)G&~m(CK^~rd/pSLgs[PJ$Eelt' );
define( 'SECURE_AUTH_KEY',  '%1U7O X,AB$ !:mR/@5_+|:7|Ar^IJe~RD;Iz?RXpS(c3s]r1N6h3O5sGvp]clD@' );
define( 'LOGGED_IN_KEY',    '7tq?%8.4sr$l{`ttOQ&GT%{!.QUi{+IDof/D/?z,%D7x77SFpm sV*~hn Nk&]sn' );
define( 'NONCE_KEY',        ');#-z~?/x{osSK_SYjL8@e:f`tSthPtoCl4//;U,DB*S~7L!zWNpbGWZJH,m;z.]' );
define( 'AUTH_SALT',        '/OS|*H]<JG<AfYlix/e9Q7:+e/8J)bMfJS&G@QvHJWq-0C7cV]fD.F=HeShi7Hgo' );
define( 'SECURE_AUTH_SALT', ' %#9*#jS>Z^i7I7N-J7Pf:kHwbdhgK;{|_q1EjdL91ivPW)n[:IE9<NEdGVdRtwC' );
define( 'LOGGED_IN_SALT',   ':7Z|`SsQcpx}o&A}c%<r:L0?z_)+%(S_t`-7cHP`nQsaAjsL>mqLQsy66cii`xji' );
define( 'NONCE_SALT',       'n-*toO=LvKo`qmr6 (,QI)5RSL2!{fJVmmL_hmrd.i8I:uX~$!HK&mgT=q7(<]ba' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
