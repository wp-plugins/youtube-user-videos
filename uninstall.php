<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package   youtube-user-videos
 * @author    Guillaume Kanoufi <g.kanoufi@gmail.com>
 * @license   GPL-2.0+
 * @link      http://lostwebdesigns.com
 * @copyright 12-28-2013 Company Name
 */

// If uninstall, not called from WordPress, then exit
if (!defined("WP_UNINSTALL_PLUGIN")) {
	exit;
}

// TODO: Define uninstall functionality here