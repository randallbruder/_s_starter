<?

/**
 * Functions to add to the theme's functions.php file.
 *
 * WordPress Meta Box Generator
 * @link https://jeremyhixon.com/tool/wordpress-meta-box-generator-v2-beta/
 * 
 * Adding Block Styles to Gutenberg
 * @link https://www.billerickson.net/block-styles-in-gutenberg/
 *
 * Gutenberg: Writing Your First Block
 * @link https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
 */


/**
* Add styles to admin
*/

// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
// Register our callback to the appropriate filter
add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );

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
 * Add a stylesheet to the Gutenberg editor
 * @link: https://rudrastyh.com/gutenberg/css.html 
 */
function gutenberg_css() {
	add_theme_support('editor-styles');
	add_editor_style('editor.css');
}
add_action('after_setup_theme', 'gutenberg_css');


?>