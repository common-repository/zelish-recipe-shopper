<?php
namespace SKULLZISH_ZELISH;
defined( 'ABSPATH' ) || exit;
final class ZELISHMAIN {

	public $version = '1.0.0';
	public static $button = '';
	public static $url = '';
	
	/**
	 * ZELISHMAIN Constructor.
	 */
	 function __construct() {
		$config       = get_option( 'skullzlsh_zelish_config', true );
		$imgurl       = esc_url( $this->skullzlsh_zelish_plugin_url() . '/assets/images/shop-recipe.gif' );
		self::$url    = esc_url( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
		self::$button = wp_kses_post('<section><div style="display:block;z-index:999999;min-height:75px;text-align:center;position:relative"><a class="shopnow_button" href="' . esc_url( self::$url ) . '" style="background-color:transparent; border:none; outline: 1px solid transparent;" ><img src="' . esc_url( $imgurl ) . '" style="width:250px; outline:none;"></a></div></section>');
		$this->skullzlsh_zelish_define_constants();
		$this->skullzlsh_zelish_includes();
		$this->skullzlsh_zelish_init_hooks();
	}

	/**
	 * plugin hooks
	 *
	 * @return void
	 */
	private function skullzlsh_zelish_init_hooks() {

		add_action( 'admin_enqueue_scripts' , array( $this, 'skullzlsh_zelish_enque_style' ) );
		add_action( 'wp_enqueue_scripts' , array( $this, 'skullzlsh_zelish_enque_script' ) );
		add_filter( 'the_content', array( $this, 'skullzlsh_zelish_add_content_on_every_page' ), 10, 1 );
		add_action( 'admin_menu', array( $this, 'skullzlsh_zelish_add_submenu' ), 50 );
	}

	/**
	 * modify post content
	 *
	 * @return mixed
	 */
	public function skullzlsh_zelish_add_content_on_every_page( $content ) {
		global $post;
		if( ! isset( $post ) || ! is_single() ) {
			return $content;
		}
		$config = get_option( 'skullzlsh_zelish_config', true );
			if ( isset( $config['position']) ) {
				switch ( $config['position'] ) {
					case 'top':
					return self::$button . $content;
						break;
					case 'bottom':
						return $content . self::$button;
						break;
					case 'both':
						return self::$button . $content . self::$button;
						break;
					default:
						return self::$button . $content . self::$button;
						break;
				}
			} else {
				return self::$button . $content . self::$button;
			}
		return $content;
	}

	/**
	 * Admin menu
	 *
	 * @return void
	 */
	public function skullzlsh_zelish_add_submenu() {
		global $submenu;
		$config = new ADMIN\SKULLZISH_CONFIG();
		add_menu_page( esc_html__( 'Zelish', 'skullzlsh' ), esc_html__( 'Zelish', 'skullzlsh' ), 'manage_options', 'zelish', array( $config, 'skullzlsh_index' ), 'dashicons-admin-links', 95.5 );
	}

	/**
	 * include files
	 *
	 * @return void
	 */
	public function skullzlsh_zelish_includes() {
		if ( file_exists( SKULLZISH_ZELISH_ABSPATH . 'includes/admin/class-skullzlsh-config.php' ) ) { 
			include_once SKULLZISH_ZELISH_ABSPATH . 'includes/admin/class-skullzlsh-config.php';
		}
	}

	/**
	 * enque admin style
	 *
	 * @return void
	 */
	public function skullzlsh_zelish_enque_style() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_style( 'skullzlsh_zelish_boot' , $this->skullzlsh_zelish_plugin_url(). '/assets/boot.css', false, false, 'all') ;
	}

	/**
	 * enque frontend script
	 *
	 * @return void
	 */
	public function skullzlsh_zelish_enque_script() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'skullzlsh_zelish_main' , $this->skullzlsh_zelish_plugin_url() . '/assets/main.js', array('jquery'), 1.0, true) ;
		$data = array(
						'siteUrl' => esc_url( site_url() ),
						'ajaxUrl' => esc_url( "https://api.zelish.in/zelish/shopnow/analytics?url=" . site_url() ),
						'rdrUrl'  => esc_url( "https://shoprecipe.zelish.in/?url=" ),
					);
		wp_localize_script('skullzlsh_zelish_main', 'sZelishObj', $data);
	}

	/**
	 * Define ZELISH Constants
	 *
	 * @return void
	 */
	private function skullzlsh_zelish_define_constants() {

		$this->skullzlsh_zelish_define( 'SKULLZISH_ZELISH_ABSPATH', dirname( SKULLZISH_ZELISH_PLUGIN_FILE ) . '/' );
		$this->skullzlsh_zelish_define( 'SKULLZISH_ZELISH_PLUGIN_BASENAME', plugin_basename( SKULLZISH_ZELISH_PLUGIN_FILE ) );
		$this->skullzlsh_zelish_define( 'SKULLZISH_ZELISH_VERSION', $this->version );
	}

	/**
	 * Define ZELISH Constants
	 *
	 * @return void
	 */
	private function skullzlsh_zelish_define( $name, $value) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}
	

	/**
	 * Get the plugin url.
	 *
	 * @return string
	 */
	public function skullzlsh_zelish_plugin_url() {
		return untrailingslashit( plugins_url( '/', SKULLZISH_ZELISH_PLUGIN_FILE ) );
	}
	

	/**
	 * Get the plugin path.
	 *
	 * @return string
	 */
	public function skullzlsh_zelish_plugin_path() {
		return untrailingslashit( plugin_dir_path( SKULLZISH_ZELISH_PLUGIN_FILE ) );
	}

}
