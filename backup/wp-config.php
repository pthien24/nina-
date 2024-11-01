<?php
define( 'WP_CACHE', true );
define('WP_AUTO_UPDATE_CORE', 'minor');// This setting is required to make sure that WordPress updates can be properly managed in WordPress Toolkit. Remove this line if this WordPress website is not managed by WordPress Toolkit anymore.
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
define('DB_NAME', 'phuongqu_OC');

/** MySQL database username */
define('DB_USER', 'phuongqu_oc');

/** MySQL database password */
define('DB_PASSWORD', 'k4-A8RkD(6is');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Xj{ZT0%BRG*awjHI$PD-||]Gg&,<g<Mm!@FGJG 7%!xp7Yoy7d5p7jm+%/1Smo_A');
define('SECURE_AUTH_KEY',  'L;o7H2Gh-2H5vBN%@xrqZy9Si5+Hc>pGlini~?=,3~5y 9+FXtJ2~3*N|KR3:7_R');
define('LOGGED_IN_KEY',    'qAPCVMguDrF{mUV++-XD,?4 4waBKqy!!YFrYib(PS>b4%ak85?jzqi+`DBT}s?z');
define('NONCE_KEY',        ')sDmMCH0}EpjpT:|2 ;%I-7XQy-D;qt;`(w1kbJ.(%+dQQzUZ{nfu-[bAiN#!an%');
define('AUTH_SALT',        'vcN;~D(@+ew`Fav-S<6BSlu|G3~d.DCMwjSU i@$HBnd/~o8MFLNfNy_+iw!X% 4');
define('SECURE_AUTH_SALT', 'N1gx.9s?k(*4+t(Tb=1zyr|G(dk+h:rNZ*Xhj,vX,Hfu{])cGRZ=-nrf-t56VO*h');
define('LOGGED_IN_SALT',   'H9C!cG4[f4FbWI)P=jb}QfrvinLz*>Gj5NP<z@%ks{wM?1*}+u+yx;&!4m>VV]us');
define('NONCE_SALT',       'BZ-/_qX~cAay=Z;ITax+NP6mC<QU8!Zb9?%pfVn`R;VkClO{-N-|KY|!EYFj7Gik');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
