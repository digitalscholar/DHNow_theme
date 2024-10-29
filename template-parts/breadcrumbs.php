<?php
if ( ! is_front_page() && function_exists( 'yoast_breadcrumb' ) ) {
	yoast_breadcrumb( '<div id="breadcrumbs">','</div>' );
}
