<?php
/**
 * Example of using WP_HTML_Tag_Processor to process HTML tags.
 *
 * @see https://developer.wordpress.org/reference/classes/wp_html_tag_processor/
 */

// Load WordPress.
require '../wp-load.php';

$html = file_get_contents( 'https://commons.wikimedia.org/wiki/Category:Panoramic_photography' );

$tags = new WP_HTML_Tag_Processor( $html );

while ( $tags->next_tag() ) {
	if ( $tags->has_class( 'thumb' ) ) {
		$tags->set_attribute( 'style', 'border: 1px solid red;' );
	}
}
$result = $tags->get_updated_html();
echo $result;

$content = file_get_contents( 'https://commons.wikimedia.org/wiki/Category:Panoramic_photography' );

// Get all images from the post content.
$processor = new WP_HTML_Tag_Processor( $content );

while ( $processor->next_tag( 'img' ) ) {
	// Get image's server path.
	$path = parse_url( $processor->get_attribute( 'src' ), PHP_URL_PATH );
	// Append absolute path.
	$path = ABSPATH . ltrim( $path, '/' );
	$images_list['images'][] = $path;
}

echo '<pre>';
print_r( $images_list );
echo '</pre>';





