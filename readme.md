## Introduction

[WP_HTML_Tag_Processor](https://developer.wordpress.org/reference/classes/wp_html_tag_processor/) is a WordPress core class used to modify attributes in an HTML document for tags matching a query.

### Why do we need parsers?

Parsers are used to extract data from a given source. In this case, we are extracting data from HTML tags.

### Why WordPress's HTML API?

WordPress's HTML API is a simple and easy-to-use API that allows you to parse and modify HTML tags. It is also very fast and efficient.

### Benchmarks vs DOMDocument

Check out the benchmarks.php and run it on your local machine to see the performance difference between WP_HTML_Tag_Processor and DOMDocument.

### Use cases

- Extract data from HTML tags
- Modify HTML tags
- Migrating data from one source to another with modified HTML tags

### Examples

#### Using outside of WordPress

```php

// Adjust the path to the wp-load.php file.
require '../wp-load.php';

// You can use any HTML content that you want to parse.
$html = file_get_contents( 'https://commons.wikimedia.org/wiki/Category:Panoramic_photography' );

$tags = new WP_HTML_Tag_Processor( $html );

while ( $tags->next_tag() ) {
	if ( $tags->has_class( 'thumb' ) ) {
		$tags->set_attribute( 'style', 'border: 1px solid red;' );
	}
}
$result = $tags->get_updated_html();
echo $result;

```

### Some examples

Run the index.php file to see some examples of how to use WP_HTML_Tag_Processor.

Refer to this article for more information: [https://adamadam.blog/2023/02/16/how-to-modify-html-in-a-php-wordpress-plugin-using-the-new-tag-processor-api/](https://adamadam.blog/2023/02/16/how-to-modify-html-in-a-php-wordpress-plugin-using-the-new-tag-processor-api/)

## Supported tags

### Containers:
- `<ADDRESS>`
- `<BLOCKQUOTE>`
- `<DETAILS>`
- `<DIALOG>`
- `<DIV>`
- `<FOOTER>`
- `<HEADER>`
- `<MAIN>`
- `<MENU>`
- `<SPAN>`
- `<SUMMARY>`

### Custom elements:
- All custom elements are supported. :)

### Form elements:
- `<BUTTON>`
- `<DATALIST>`
- `<FIELDSET>`
- `<INPUT>`
- `<LABEL>`
- `<LEGEND>`
- `<METER>`
- `<PROGRESS>`
- `<SEARCH>`

### Formatting elements:
- `<B>`
- `<BIG>`
- `<CODE>`
- `<EM>`
- `<FONT>`
- `<I>`
- `<PRE>`
- `<SMALL>`
- `<STRIKE>`
- `<STRONG>`
- `<TT>`
- `<U>`
- `<WBR>`

### Heading elements:
- `<H1>`
- `<H2>`
- `<H3>`
- `<H4>`
- `<H5>`
- `<H6>`
- `<HGROUP>`

### Links:
- `<A>`

### Lists:
- `<DD>`
- `<DL>`
- `<DT>`
- `<LI>`
- `<OL>`
- `<UL>`

### Media elements:
- `<AUDIO>`
- `<CANVAS>`
- `<EMBED>`
- `<FIGCAPTION>`
- `<FIGURE>`
- `<IMG>`
- `<MAP>`
- `<PICTURE>`
- `<SOURCE>`
- `<TRACK>`
- `<VIDEO>`

### Paragraph:
- `<BR>`
- `<P>`

### Phrasing elements:
- `<ABBR>`
- `<AREA>`
- `<BDI>`
- `<BDO>`
- `<CITE>`
- `<DATA>`
- `<DEL>`
- `<DFN>`
- `<INS>`
- `<MARK>`
- `<OUTPUT>`
- `<Q>`
- `<SAMP>`
- `<SUB>`
- `<SUP>`
- `<TIME>`
- `<VAR>`

### Sectioning elements:
- `<ARTICLE>`
- `<ASIDE>`
- `<HR>`
- `<NAV>`
- `<SECTION>`

### Templating elements:
- `<SLOT>`

## Presentation slides

[PDF](https://drive.google.com/file/d/18Ml6zzKqbXXtmH7henvGy-7WxBnmyCF9/view?usp=drive_link)

## Contributing

Feel free to contribute to this project. You can submit a pull request or open an issue.

All contributions are welcome!


 