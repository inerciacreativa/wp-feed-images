<?php
/**
 * Plugin Name: ic Feed Images
 * Plugin URI:  https://github.com/inerciacreativa/wp-feed-images
 * Version:     2.0.2
 * Text Domain: ic-feed-images
 * Domain Path: /languages
 * Description: Inserta imágenes destacadas en feeds RSS.
 * Author:      Jose Cuesta
 * Author URI:  https://inerciacreativa.com/
 * License:     MIT
 * License URI: https://opensource.org/licenses/MIT
 */

if (!defined('ABSPATH')) {
	exit;
}

ic\Plugin\FeedImages\FeedImages::create(__FILE__);
