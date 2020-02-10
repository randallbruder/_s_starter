<?

function my_mce_before_init_insert_formats( $init_array ) {

// Define the style_formats array

	$style_formats = array(
/*
* Each array child is a format with it's own settings
* Notice that each array has title, block, classes, and wrapper arguments
* Title is the label which will be visible in Formats menu
* Block defines whether it is a span, div, selector, or inline style
* Classes allows you to define CSS classes
* Wrapper whether or not to add a new block-level element around any selected elements
*/
		array(
			'title' => 'Intro Text',
			'inline' => 'span',
			'classes' => 'intro-text',
			'wrapper' => true,

		),
		array(
			'title' => 'Blue Highlight',
			'inline' => 'span',
			'classes' => 'blue-highlight',
			'wrapper' => true,
		
		),
	);
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );
	return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );



/**
 * Add styles to admin
 */
function load_admin_style() {
	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/admin.css', false, '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'load_admin_style' );

/**
 * Add styles to editor
 */
function custom_editor_styles() {
	add_editor_style('editor.css');
}
add_action('init', 'custom_editor_styles');

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'underscores_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 */
function underscores_register_required_plugins() {

	$plugins = array(

		array(
			'name'      => 'All-in-One WP Migration',
			'slug'      => 'all-in-one-wp-migration',
			'required'  => false,
		),
		array(
			'name'      => 'All-in-One WP Migration Unlimited Extension',
			'slug'      => 'all-in-one-wp-migration-unlimited-extension',
			'source'    => 'https://files.rb.gd/private/all-in-one-wp-migration-unlimited-extension.zip',
			'required'  => false,
		),
		array(
			'name'      => 'WP Super Cache',
			'slug'      => 'wp-super-cache',
			'required'  => false,
		),
		array(
			'name'      => 'wp-Typography',
			'slug'      => 'wp-typography',
			'required'  => false,
		),
		array(
			'name'      => 'ManageWP Worker',
			'slug'      => 'worker',
			'required'  => false,
		),
		array(
			'name'      => 'Duplicate Post',
			'slug'      => 'duplicate-post',
			'required'  => false,
		),
		array(
			'name'      => 'BackupBuddy',
			'slug'      => 'backupbuddy',
			'source'    => 'https://files.rb.gd/private/backupbuddy-8.2.8.3.zip',
			'required'  => false,
		),
		array(
			'name'      => 'iThemes Security Pro',
			'slug'      => 'ithemes-security-pro',
			'source'    => 'https://files.rb.gd/private/ithemes-security-pro-5.4.8.zip',
			'required'  => false,
		),
		array(
			'name'      => 'Page Builder by SiteOrigin',
			'slug'      => 'siteorigin-panels',
			'required'  => false,
		),
		array(
			'name'      => 'SiteOrigin Widgets Bundle',
			'slug'      => 'so-widgets-bundle',
			'required'  => false,
		),
	);

	$config = array(
		'id'           => '_s',           // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}


?>