<?php
/**
 * Plugin Name: ic Feed Images
 * Plugin URI:  https://github.com/inerciacreativa/wp-feed-images
 * Version:     4.0.1
 * Text Domain: ic-feed-images
 * Domain Path: /languages
 * Description: Inserta imágenes destacadas en feeds RSS.
 * Author:      Jose Cuesta
 * Author URI:  https://inerciacreativa.com/
 * License:     MIT
 * License URI: https://opensource.org/licenses/MIT
 */

use ic\Framework\Framework;
use ic\Plugin\FeedImages\FeedImages;

if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists(Framework::class)) {
	throw new RuntimeException(sprintf('Could not find %s class.', Framework::class));
}

if (!class_exists(FeedImages::class)) {
	$autoload = __DIR__ . '/vendor/autoload.php';

	if (file_exists($autoload)) {
		/** @noinspection PhpIncludeInspection */
		include_once $autoload;
	} else {
		throw new RuntimeException(sprintf('Could not load %s class.', FeedImages::class));
	}
}

FeedImages::create(__FILE__);
