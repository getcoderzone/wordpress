<?php 
	//
	/*Adding Custom Table Headers*/
	//
	
	/**manage_single_course_posts_columns == 'single_course_posts'  this is a Custom post type**/
	add_filter('manage_single_course_posts_columns', 'bs_event_table_head');
	function bs_event_table_head( $defaults ) {
		$defaults['newsletter_event_venue']  = 'Event Date';
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
?>