<?php
/**
 * Youtube User Videos
 *
 * Retrieve videos from a user
 *
 * @package   youtube-user-videos
 * @author    Guillaume Kanoufi <g.kanoufi@gmail.com>
 * @license   GPL-2.0+
 * @link      http://lostwebdesigns.com
 * @copyright 12-28-2013 Company Name
 *
 * @wordpress-plugin
 * Plugin Name: Youtube User Videos
 * Plugin URI:  http://lostwebdesigns.com
 * Description: Retrieve videos from a user
 * Version:     1.1.0
 * Author:      Guillaume Kanoufi
 * Author URI:  http://lostwebdesigns.com
 * Text Domain: youtube-user-videos-locale
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /lang
 */

// If this file is called directly, abort.
if (!defined("WPINC")) {
	die;
}

require_once(plugin_dir_path(__FILE__) . "YoutubeUserVideosWidget.php");

// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
register_activation_hook(__FILE__, array("YoutubeUserVideosWidget", "activate"));
register_deactivation_hook(__FILE__, array("YoutubeUserVideosWidget", "deactivate"));

// YoutubeUserVideosWidget::get_instance();
