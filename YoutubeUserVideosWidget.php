<?php
/**
 * Youtube User Videos
 *
 * @package   youtube-user-videos
 * @author    Guillaume Kanoufi <g.kanoufi@gmail.com>
 * @license   GPL-2.0+
 * @link      http://lostwebdesigns.com
 * @copyright 12-28-2013 Company Name
 */

/**
 * Youtube User Videos Widget class.
 *
 * @package YoutubeUserVideos
 * @author  Guillaume Kanoufi <g.kanoufi@gmail.com>
 */
class YoutubeUserVideosWidget extends WP_Widget{
	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	protected $version = "1.0.0";

	/**
	 * Unique identifier for your plugin.
	 *
	 * Use this value (not the variable name) as the text domain when internationalizing strings of text. It should
	 * match the Text Domain file header in the main plugin file.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = "youtube-user-videos";



	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since     1.0.0
	 */
	public function __construct() {

		// Load plugin text domain
		add_action("init", array($this, "load_plugin_textdomain"));

		parent::__construct(
            'youtube-user-videos',
            __( 'Youtube User Videos', 'youtube-user-videos-locale' ),
            array(
                'classname'     =>  'youtube_user_videos',
                'description'   =>  __( 'Youtube User Video, retrieve all videos from a user, show the associated thumbnails and open the video in a modal(fancybox)', 'youtube-user-videos-locale' )
            )
        );

		// Register admin styles and scripts
	        add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
	        add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

	        // Register site styles and scripts
	        add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_styles' ) );
	        add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_scripts' ) );

		// Define custom functionality. Read more about actions and filters: http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
		add_action("show_videos", array($this, "widget"));
		add_filter("TODO", array($this, "filter_method_name"));

	}

	 /*--------------------------------------------------*/
    /* Widget API Functions
    /*--------------------------------------------------*/

    /**
     * Outputs the content of the widget.
     * @since     1.0.0
     *
     * @param   array   args        The array of form elements
     * @param   array   instance    The current instance of the widget
     */
    public function widget( $args, $instance ) {

        extract( $args, EXTR_SKIP );
        $title = apply_filters('widget_title', $instance['widgettitle']);

        echo $before_widget;

       if(!empty($title)):
       		if(!empty($username)){
       			$before_title .= '<a href="http://www.youtube.com/user/' . $username . '" rel="nofollow" target="_blank">';
       			$after_title = '</a>' . $after_title;
       		}
			echo $before_title . $title . $after_title;
	 endif;

       include( plugin_dir_path( __FILE__ ) . '/views/widget.php' );

        echo $after_widget;

    } // end widget

    /**
     * Processes the widget's options to be saved.
     * @since     1.0.0
     *
     * @param   array   new_instance    The previous instance of values before the update.
     * @param   array   old_instance    The new instance of values to be generated via the update.
     */
    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['widgettitle'] = strip_tags($new_instance['widgettitle']);

        $instance['username'] = ( ! empty( $new_instance['username'] ) ) ? strip_tags( $new_instance['username'] ) : '';
        $instance['limit'] = ( ! empty( $new_instance['limit'] ) ) ? strip_tags( $new_instance['limit'] ) : '';
        $instance['modal'] = ( ! empty( $new_instance['modal'] ) ) ? strip_tags( $new_instance['modal'] ) : '';

        return $instance;

    } // end widget

    /**
     * Generates the administration form for the widget.
     * @since     1.0.0
     *
     * @param   array   instance    The array of keys and values for the widget.
     */
    public function form( $instance ) {

        // TODO:    Define default values for your variables
        $instance = wp_parse_args(
            (array) $instance
        );

        // TODO:    Store the values of the widget in their own variable

        // Display the admin form
        include( plugin_dir_path(__FILE__) . '/views/admin.php' );

    } // end form


	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean $network_wide    True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public static function activate($network_wide) {
		// TODO: Define activation functionality here
	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean $network_wide    True if WPMU superadmin uses "Network Deactivate" action, false if WPMU is disabled or plugin is deactivated on an individual blog.
	 */
	public static function deactivate($network_wide) {
		// TODO: Define deactivation functionality here
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters("plugin_locale", get_locale(), $domain);

		load_textdomain($domain, WP_LANG_DIR . "/" . $domain . "/" . $domain . "-" . $locale . ".mo");
		load_plugin_textdomain($domain, false, dirname(plugin_basename(__FILE__)) . "/lang/");
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */

    public function register_admin_styles() {

		if (!isset($this->plugin_screen_hook_suffix)) {
			return;
		}

		$screen = get_current_screen();
		if ($screen->id == $this->plugin_screen_hook_suffix) {
			wp_enqueue_style($this->plugin_slug . "-admin-styles", plugins_url("css/admin.css", __FILE__), array(),
				$this->version);
		}

	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function register_admin_scripts() {

		if (!isset($this->plugin_screen_hook_suffix)) {
			return;
		}

		$screen = get_current_screen();
		if ($screen->id == $this->plugin_screen_hook_suffix) {
			wp_enqueue_script($this->plugin_slug . "-admin-script", plugins_url("js/youtube-user-videos-admin.js", __FILE__),
				array("jquery"), $this->version);
		}

	}

	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since    1.0.0
	 */
	public function register_widget_styles() {
		wp_enqueue_style("prettyPhoto", plugins_url("css/prettyPhoto.css", __FILE__), array(),
			$this->version);
	}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since    1.0.0
	 */
	public function register_widget_scripts() {
		wp_enqueue_script("prettyPhoto", plugins_url("js/jquery.prettyPhoto.js", __FILE__), array("jquery"),
			$this->version, true);
		wp_enqueue_script($this->plugin_slug . "-widget-script", plugins_url("js/youtube-user-videos.js", __FILE__), array("prettyPhoto"),
			$this->version, true);
	}



}
add_action( 'widgets_init', create_function( '', 'register_widget("YoutubeUserVideosWidget");' ) );
