/**
 * Represents the view for the public-facing component of the plugin.
 *
 * This typically includes any information, if any, that is rendered to the
 * frontend of the theme when the plugin is activated.
 *
 * @package   youtube-user-videos
 * @author    Guillaume Kanoufi <g.kanoufi@gmail.com>
 * @license   GPL-2.0+
 * @link      http://lostwebdesigns.com
 * @copyright 12-28-2013 Company Name
 */

(function ($) {
	"use strict";
	$(function () {
			$("a[rel^='prettyPhoto']").prettyPhoto();
	});
}(jQuery));
