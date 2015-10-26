<?php

/* 	Description:	New widgetized area for Largo child theme
* 	Attribution:	Code adapted from wpgyan.com
* 	Programmer:	Natalie Feibish 
* 	Email:		feibishn@gmail.com 
* 
*/


/**
 * Register Widget Area.
 *
 */
function rns_widgets_init() {

	register_sidebar( array(
		'name' => 'Test Category Archive',
		'id' => 'test_cat_arch',
		'before_widget' => '<aside id="nats-widgets-2" class="widget widget-4 even widget-nats clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'rns_widgets_init' );
