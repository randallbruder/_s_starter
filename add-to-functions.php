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
 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
 */
function custom_editor_styles() {
	add_theme_support('editor-styles');
	add_editor_style('editor.css');
}
add_action('init', 'custom_editor_styles');



/**
 * Hanging punctuation
 */
 
function hanging_punctuation($content){
	$hanging_punctuation_map = [
		'"' => "quot",
		"'" => "apos",
		"“" => "ldquo",
		"”" => "rdquo",
		"‘" => "lsquo",
		"’" => "rsquo",
		"«" => "laquo",
		"‹" => "lsaquo",
		"„" => "bdquo",
		"‚" => "sbquo",
		"(" => "lparen",
		"[" => "lbracket",
		"-" => "hyphen",
		"–" => "ndash",
		"—" => "mdash",
	];
	
	/* TO DO:
	   • wptexturize causes straight quotes to not get wrapped at all
	   ✓ inline CSS can be caught by the regex, like: <div style="position: absolute; left: -5000px;" aria-hidden="true">
	   • adding the "starts-with" class would fail if the <p> tag already has a class on it (like accidentally pasted into WordPress)
	 */
	
	// Check for special characters that are at the start of a word, but ignore anything between a < and a >
	$content = preg_replace_callback('/<[^>]*>(*SKIP)(*F)|([ \t\xA0])([\"\'“”‘’«‹„‚\(\-–—])([^ \t\xA0\<]+)/', function($m) use($hanging_punctuation_map) {
		foreach ($hanging_punctuation_map as $char => $value) {
			if (strpos($m[2].$m[3], $char) !== false && strpos($m[2].$m[3], $char) == 0) {
				$class = $value;
			}
		}
		return '<span class="s-' . $class . '">' . $m[1] . '</span><span class="h-' . $class . '">' . $m[2] . $m[3] . '</span>';
	},
	$content);
	
	// Check for special characters that are at the start of a paragraph
	$content = preg_replace_callback('/(\<p[^\>]*\>(\<[^\>]+\>)?)([\"\'“”‘’«‹„‚\(\[\-–—])([^ \t\xA0\<]+)/', function($m) use($hanging_punctuation_map) {
		foreach ($hanging_punctuation_map as $char => $value) {
			if (strpos($m[3].$m[4], $char) !== false && strpos($m[3].$m[4], $char) == 0) {
				$class = $value;
			}
		}
		return substr_replace($m[0], ' class="starts-with-' . $class . '"', 2, 0);
	},
	$content);
				
	return $content;
}

add_filter('the_content', 'hanging_punctuation');

?>