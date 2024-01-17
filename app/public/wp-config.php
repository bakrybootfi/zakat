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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);

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
define( 'AUTH_KEY',          '^,Z~-O<iDFnDlTBp-:#>Et/k-fn,5T{vy~s?O^I8C|n!gHa^q1J$e$nDjQcIFG8,' );
define( 'SECURE_AUTH_KEY',   'jm~nusO$<CXZ[N25eWs/w.9`L*<ogUF`C=?(:+.=#n+_TT{2}A$p(6^Tb!!KyBR_' );
define( 'LOGGED_IN_KEY',     '( >PpY<tqH7^$a@,|^a<_PG%J%@+19s2)P8e=b,2&xj<ZlCn dHQUr^@9JSkm*M8' );
define( 'NONCE_KEY',         'V/:EztvXpk?9W.ydw725{%.(TR.xL/c,!k|GjMnuyh11W3ZPS?qZT:Gb*X:u3Psh' );
define( 'AUTH_SALT',         'l2LRyc)u,3VL&r$h.SMX!e]W}/ |Q|x`BUS}oK|$bxsFV@+n[[G(QZCM/]a!D0J>' );
define( 'SECURE_AUTH_SALT',  'B5nq6/,/A^J!AZR9bz+gBP2NB$tB<x[S%5W<pE`*HyU-/+q4Tu:,Jk>OvZ@HyRuX' );
define( 'LOGGED_IN_SALT',    'Rn.-Om=.?P9TuU=M58}<NyokRJLF7.7gQ`uslU`^q`*67qc]F!K^!u}T1l&$uVta' );
define( 'NONCE_SALT',        'R;+d@R@s6hpcI$kK^qSS1Y}B?K$j}:c6(206W0m;<(]9qlT0Ds|7at;X+p=,=dEE' );
define( 'WP_CACHE_KEY_SALT', 'l7AROIb6>JSErDVWjFpz]*8bcOZ_9x(A19:FTd=??F34H^#3VU/?t:a8`-r1as1!' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
