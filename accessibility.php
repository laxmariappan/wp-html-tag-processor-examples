<?php
// load WordPress
require '../wp-load.php';
function accessibility_check_html($html) {
	$issues = array();

	// 1. Image Alt Text Check:
	$img_processor = new WP_HTML_Tag_Processor( $html );
	while ( $img_processor->next_tag('img') ) {
		if ( ! $img_processor->get_attribute( 'alt' ) ) {
			$issues[] = "Image missing alt text: " . htmlentities($img_processor->get_tag());
		}
	}

	// 2. Link Text Check (Avoid generic "click here"):
	$link_processor = new WP_HTML_Tag_Processor( $html );
	while ( $link_processor->next_tag('a') ) {
		$link_text = $link_processor->get_attribute('title'); // Just for demonstration, should be adjusted to get the actual text.
		if (strtolower($link_text) === "click here" || strtolower($link_text) === "read more" || strlen($link_text) < 5) {
			$issues[] = "Link text is not descriptive: '" . htmlentities($link_text) . "'";
		}
	}

	// 3. Heading Structure Check (Simplified - should be more robust):
	$headings = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
	$last_heading_level = 0;
	foreach ($headings as $heading) {
		$heading_processor = new WP_HTML_Tag_Processor( $html );
		while ( $heading_processor->next_tag($heading) ) {
			$current_heading_level = (int) substr($heading, 1);
			if ($current_heading_level - $last_heading_level > 1) {
				$issues[] = "Heading level jump detected: From H" . $last_heading_level . " to H" . $current_heading_level;
			}
			$last_heading_level = $current_heading_level;
		}
	}

	return $issues;
}

// Example usage:
$html = '
  <h2>My Website</h2>
  <p>Welcome! <a href="#">Click here</a> to learn more.</p> 
  <img src="my-image.jpg">
  <h1>A Subheading</h1> 
';
$accessibility_issues = accessibility_check_html($html);

if (!empty($accessibility_issues)) {
	echo "Accessibility issues found:\n";
	echo "<ul>";
	foreach ($accessibility_issues as $issue) {
		echo "<li>" . $issue . "</li>";
	}
	echo "</ul>";
} else {
	echo "No accessibility issues detected in the provided HTML.\n";
}