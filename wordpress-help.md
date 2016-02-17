
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

#### Adding Custom Table Headers [#] (https://www.smashingmagazine.com/2013/12/modifying-admin-post-lists-in-wordpress/)
```php
	/**manage_single_course_posts_columns == 'single_course_posts'  this is a Custom post type**/
	add_filter('manage_single_course_posts_columns', 'bs_event_table_head');
	function bs_event_table_head( $defaults ) {
		$defaults['newsletter_event_venue']  = 'Event Venue';
		$defaults['ticket_status']    = 'Ticket Status';
		$defaults['venue']   = 'Venue';
		$defaults['author'] = 'Added By';
		return $defaults;
	}
	
	add_action( 'manage_single_course_posts_custom_column', 'bs_event_table_content', 10, 2 );
	function bs_event_table_content( $column_name, $post_id ) {
		if ($column_name == 'newsletter_event_venue') {
			echo "event_date";
			$event_date = get_post_meta( $post_id, '_bs_meta_event_date', true );
			echo  date( _x( 'F d, Y', 'Event date format', 'textdomain' ), strtotime( $event_date ) );
		}
		if ($column_name == 'ticket_status') {
			echo "ticket_status";
			$status = get_post_meta( $post_id, '_bs_meta_event_ticket_status', true );
			echo $status;
		}

		if ($column_name == 'venue') {
			echo "venue";
			echo get_post_meta( $post_id, '_bs_meta_event_venue', true );
		}

	}
```
