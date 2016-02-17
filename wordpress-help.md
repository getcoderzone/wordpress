## Wordpress cheat sheet
***

#### language_attributes

```php
<?php language_attributes(); ?>
```

#### Title

```php
<?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?>
```
#### Head action hook [#](https://codex.wordpress.org/Plugin_API/Action_Reference/wp_head)
```php
<?php wp_head(); ?>
```
#### Includes *Header* in template file. [#](https://codex.wordpress.org/Function_Reference/get_header)
```php
<?php get_header(); ?>
```
#### Includes *Footer* in template file. [#](https://codex.wordpress.org/Function_Reference/wp_footer)
```php
<?php wp_footer(); ?> 
```
#### Load the custom scripts for the theme.
```php
if ( ! function_exists( 'qtheme_scripts' ) ) {
	function qtheme_scripts() {
		// Adds support for pages with threaded comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Register scripts
		wp_register_script( 'bootstrap-js', '/bootstrap.min.js', array( 'jquery' ), false, true );

		// Load the custom scripts
        wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'bootstrap-js' );

		// Load the stylesheets
        wp_enqueue_style( 'qtheme-style', get_stylesheet_uri() );
		wp_enqueue_style( 'bootstrap', STYLE . '/bootstrap.css' );
	}

	add_action( 'wp_enqueue_scripts', 'qtheme_scripts' );
}
```
#### Bootstrap menu Walker. [#](https://github.com/twittem/wp-bootstrap-navwalker)
```php
// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');
```
#### Registers a widget. [#](http://codex.wordpress.org/Widgetizing_Themes)
```php
// function.php
function corp_widgets_init() {

	register_sidebar( array(
		'name'          => 'Widget Title',
		'id'            => 'widgetID',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>'
	) );

}
add_action( 'widgets_init', 'corp_widgets_init' );

// This is the function which outputs the widget
<?php if ( is_active_sidebar( 'footerblurbitem01' ) ) : ?>
	<?php dynamic_sidebar( 'footerblurbitem03' ); ?>
<?php endif; ?>

```

