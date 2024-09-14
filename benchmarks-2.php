<?php

// load WordPress
require '../wp-load.php';

?>
	<script src="https://cdn.tailwindcss.com"></script>
<?php
function benchmark_wp_html_tag_processor( $html, $scenario ) {
	$start_time = microtime( true );

	switch ( $scenario ) {
		case 1:
			$processor = new WP_HTML_Tag_Processor( $html );
			while ( $processor->next_tag('img') ) {
				$processor->add_class( 'image-class' );
			}
			$result = $processor->get_updated_html();
			break;
		case 2:
			$processor = new WP_HTML_Tag_Processor( $html );
			while ( $processor->next_tag('p') ) {
				$processor->remove_attribute( 'style' );
			}
			$result = $processor->get_updated_html();
			break;
		case 3: // Example: Wrapping external links
			$processor = new WP_HTML_Tag_Processor( $html );
			while ( $processor->next_tag('a') ) {
				if ( strpos( $processor->get_attribute( 'href' ), 'http' ) === 0 ) {
 					$processor->set_attribute( 'class', 'external-link' );
				}
			}
			$result = $processor->get_updated_html();
			break;
		default:
			$result = $html;
			break;
	}

	$end_time = microtime( true );

	return $end_time - $start_time;
}

// Function to test DOMDocument
function benchmark_domdocument( $html, $scenario ) {
	$start_time = microtime( true );
	$dom        = new DOMDocument();
	@$dom->loadHTML( $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );

	switch ( $scenario ) {
		case 1:
			$images = $dom->getElementsByTagName( 'img' );
			foreach ( $images as $img ) {
				$img->setAttribute( 'class', $img->getAttribute( 'class' ) . ' image-class' );
			}
			$result = $dom->saveHTML();
			break;
		case 2:
			$paragraphs = $dom->getElementsByTagName( 'p' );
			foreach ( $paragraphs as $p ) {
				$p->removeAttribute( 'style' );
			}
			$result = $dom->saveHTML();
			break;
		case 3:
			$links = $dom->getElementsByTagName( 'a' );
			foreach ( $links as $link ) {
				if ( strpos( $link->getAttribute( 'href' ), 'http' ) === 0 ) {
					$span = $dom->createElement( 'span' );
					$span->setAttribute( 'class', 'external-link' );
					$span->appendChild( $link->cloneNode( true ) );
					$link->parentNode->replaceChild( $span, $link );
				}
			}
			$result = $dom->saveHTML();
			break;
		default:
			$result = $html;
			break;
	}

	$end_time = microtime( true );

	return $end_time - $start_time;
}

$html     = file_get_contents( 'https://commons.wikimedia.org/wiki/Category:Panoramic_photography' );
$senarios = [ 1, 2, 3 ];

	foreach ( $senarios as $scenario ) {
	$wp_time  = benchmark_wp_html_tag_processor( $html, $scenario );
	$dom_time = benchmark_domdocument( $html, $scenario );
	$faster = $wp_time < $dom_time ? 'WP_HTML_Tag_Processor' : 'DOMDocument';
	$result = $faster . ' is faster by ' . abs( $wp_time - $dom_time ) . ' seconds';
	?>
	<div class="bg-white p-4 rounded-lg shadow mb-4">
		<h2 class="text-lg font-bold mb-4">Scenario <?php echo $scenario; ?></h2>
		<div class="flex">
			<div class="w-1/2">
				<div class="bg-gray-100 p-4 rounded-lg shadow">
					<h3 class="text-lg font-bold mb-4">WP_HTML_Tag_Processor</h3>
					<p>Time: <?php echo $wp_time; ?> seconds</p>
				</div>
			</div>
			<div class="w-1/2">
				<div class="bg-gray-100 p-4 rounded-lg shadow">
					<h3 class="text-lg font-bold mb-4">DOMDocument</h3>
					<p>Time: <?php echo $dom_time; ?> seconds</p>
				</div>
			</div>
		</div>
		<div class="bg-gray-100 p-4 rounded-lg shadow mt-4">
			<h3 class="text-lg font-bold mb-4">Result</h3>
			<p><?php echo $result; ?></p>
		</div>
	</div>
	<?php
}
