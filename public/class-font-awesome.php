<?php
/**
 * Font Awsome the easy way
 *
 * @package   Font-Awesome-Easy-Way
 * @author    Łukasz Jasiński <studio@ljasinski.pl>
 * @license   GPL-2.0+
 * @link      http://www.ljasinski.pl/category/komputery/wordpress-komputery/pluginy/font-awesome-easy-way/
 * @copyright 2013 Studio Multimedialne ljasinski.pl
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * public-facing side of the WordPress site.
 *
 * If you're interested in introducing administrative or dashboard
 * functionality, then refer to `class-plugin-name-admin.php`
 *
 * @package   Font-Awesome-Easy-Way
 * @author    Łukasz Jasiński <studio@ljasinski.pl>
 */
class LJPL_FontAwesome {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 * @since   0.1.0
	 * @var     string
	 */
	const VERSION = '0.1.0';

	/**
	 * Version of Font Awesome files
	 *
	 * Used for caching purposes
	 * @since	0.1.0
	 * @var		string
	 */
	const FA_VERSION = '4.0.3';

	/**
	 * Unique identifier for your plugin.
	 *
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * plugin file.
	 *
	 * @since    0.1.0
	 * @var      string
	 */
	protected $plugin_slug = 'font-awesome-easy-way';

	/**
	 * Instance of this class.
	 *
	 * @since    0.1.0
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     0.1.0
	 */
	private function __construct() {

		// Load plugin text domain
		add_action('init', array($this, 'load_plugin_textdomain'));

		// Activate plugin when new blog is added
		add_action('wpmu_new_blog', array($this, 'activate_new_site'));

		// Load public-facing style sheet and JavaScript.
		add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));

		// FontAwesome shortcode
		add_shortcode('faicon', array($this, 'shortcode_faicon'));
	}

	/**
	 * Return the plugin slug.
	 *
	 * @since    0.1.0
	 * @return    Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return $this -> plugin_slug;
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     0.1.0
	 * @return    object    A single instance of this class.
	 */

	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if (null == self::$instance) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    0.1.0
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Activate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       activated on an individual blog.
	 */
	public static function activate($network_wide) {
		if (function_exists('is_multisite') && is_multisite()) {
			if ($network_wide) {
				// Get all blog ids
				$blog_ids = self::get_blog_ids();
				foreach ($blog_ids as $blog_id) {
					switch_to_blog($blog_id);
					self::single_activate();
				}
				restore_current_blog();
			} else {
				self::single_activate();
			}
		} else {
			self::single_activate();
		}
	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    0.1.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Deactivate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       deactivated on an individual blog.
	 */
	public static function deactivate($network_wide) {
		if (function_exists('is_multisite') && is_multisite()) {
			if ($network_wide) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();
				foreach ($blog_ids as $blog_id) {
					switch_to_blog($blog_id);
					self::single_deactivate();
				}
				restore_current_blog();
			} else {
				self::single_deactivate();
			}
		} else {
			self::single_deactivate();
		}
	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @since    0.1.0
	 * @param    int    $blog_id    ID of the new blog.
	 */
	public function activate_new_site($blog_id) {
		if (1 !== did_action('wpmu_new_blog')) {
			return;
		}
		switch_to_blog($blog_id);
		self::single_activate();
		restore_current_blog();
	}

	/**
	 * Get all blog ids of blogs in the current network that are:
	 * - not archived
	 * - not spam
	 * - not deleted
	 *
	 * @since    0.1.0
	 *
	 * @return   array|false    The blog ids, false if no matches.
	 */
	private static function get_blog_ids() {

		global $wpdb;
		// get an array of blog ids
		$sql = "SELECT blog_id FROM $wpdb->blogs
                        WHERE archived = '0' AND spam = '0'
                        AND deleted = '0'";
		return $wpdb -> get_col($sql);
	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since    0.1.0
	 */
	private static function single_activate() {
		// @TODO: Define activation functionality here
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since    0.1.0
	 */
	private static function single_deactivate() {
		// @TODO: Define deactivation functionality here
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    0.1.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this -> plugin_slug;
		$locale = apply_filters('plugin_locale', get_locale(), $domain);

		load_textdomain($domain, trailingslashit(WP_LANG_DIR) . $domain . '/' . $domain . '-' . $locale . '.mo');

	}

	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style($this -> plugin_slug . '-plugin-styles', plugins_url('assets/css/font-awesome.min.css', __FILE__), array(), FA_VERSION);
	}

	public function shortcode_faicon ( $atts, $content = NULL ) {
		extract( shortcode_atts( array(
			'name' => '',
			'size' => '',
			'title' => '',
		), $atts ) );		
		if( 0 !==strpos( $name, 'fa-') )
			$name = 'fa-' . $name;
		
		return '<i class="fa ' . $name . '"></i>';
	}

}
