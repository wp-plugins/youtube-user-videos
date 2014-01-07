<?php
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
?>

<?php

	/**
	* Get all videos id
	*
	**/

	 function get_yt_ID( $uri ) {

	    // how long YT ID's are
	    $id_len = 11;

	    // where to start looking
	    $id_begin = strpos( $uri, '?v=' );
	    // if the id isn't at the beginning of the uri for some reason
	    if( $id_begin === FALSE )
	        $id_begin = strpos( $uri, "&v=" );
	    // all else fails
	    if( $id_begin === FALSE )
	        wp_die( 'YouTube video ID not found. Please double-check your URL.', 'youtube-user-videos-locale' );
	    // now go to the proper start
	    $id_begin +=3;

	    // get the ID
	    $yt_ID = substr( $uri, $id_begin, $id_len);

	    return $yt_ID;
	}

	$feed = fetch_feed('http://gdata.youtube.com/feeds/api/videos?alt=rss&author='.$instance["username"]);

	   if ( is_wp_error( $feed ) ):
		 return false;

	   else:
		$maxitems =$feed->get_item_quantity( $instance['limit'] );
		$rss_videos = $feed->get_items( 0, $maxitems );

		$prettyrel = ($instance['modal'] == 1) ? 'rel="prettyPhoto[video]"' : '';
		$gallery_class = ($instance['limit'] > 1) ? 'yt-videos prettyGallery' : 'yt-videos';

		if ( is_array( $rss_videos ) ):

?>
<!-- This file is used to markup the public facing aspect of the plugin. -->
<div class="-widget youtube-user-videos">
	<ul class="<?php echo $gallery_class;?>">
    <?php
		foreach($rss_videos as $video):
			// print_r($video);
			$id = get_yt_ID( $video->get_permalink() );
			$enclosure = $video->get_enclosure();


	?>
		<li>
			<a href="http://www.youtube.com/watch?v=<?php echo $id;?>" <?php echo $prettyrel;?>>
				<img src="<?php echo esc_url( $enclosure->get_thumbnail() ); ?>" width="290" height="164" />
			</a>
		</li>

	<?php endforeach; endif; endif;?>
</div>

