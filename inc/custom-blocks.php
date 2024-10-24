<?php
/**
 * DHNow Blocks customizations.
 *
 * @package DHNow
 */

/**
 * @param string $block_content The block content.
 * @param array  $block The block attributes.
 *
 * @return string
 */
function dhn_custom_post_author_render( $block_content, $block ) {
	if ( $block['blockName'] !== 'core/post-author' ) {
		return $block_content;
	}

	// Get post ID from block context
	$post_id = $block['attrs']['postId'] ?? get_the_ID();
	$author_id = get_post_field( 'post_author', $post_id );

	if ( empty( $author_id ) ) {
		return '';
	}

	$attributes = $block['attrs'] ?? []; // Access the block attributes

	$avatar = ! empty( $attributes['avatarSize'] ) ? get_avatar(
		$author_id,
		$attributes['avatarSize']
	) : null;

	$link = get_author_posts_url( get_the_author_meta( 'ID' ) );
	$author_name = get_the_author();
	if ( ! empty( $attributes['isLink'] && ! empty( $attributes['linkTarget'] ) ) ) {
		$author_name = sprintf( '<a href="%1$s" target="%2$s">%3$s</a>', esc_url( $link ), esc_attr( $attributes['linkTarget'] ), $author_name );
	}

	$byline  = ! empty( $attributes['byline'] ) ? $attributes['byline'] : false;
	$classes = array();
	if ( isset( $attributes['itemsJustification'] ) ) {
		$classes[] = 'items-justified-' . $attributes['itemsJustification'];
	}
	if ( isset( $attributes['textAlign'] ) ) {
		$classes[] = 'has-text-align-' . $attributes['textAlign'];
	}
	if ( isset( $attributes['style']['elements']['link']['color']['text'] ) ) {
		$classes[] = 'has-link-color';
	}

	$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => implode( ' ', $classes ) ) );

	return sprintf( '<div %1$s>', $wrapper_attributes ) .
	       ( ! empty( $attributes['showAvatar'] ) ? '<div class="wp-block-post-author__avatar">' . $avatar . '</div>' : '' ) .
	       '<div class="wp-block-post-author__content">' .
	       ( ! empty( $byline ) ? '<p class="wp-block-post-author__byline">' . wp_kses_post( $byline ) . '</p>' : '' ) .
	       '<p class="wp-block-post-author__name">' . $author_name . '</p>' .
	       ( ! empty( $attributes['showBio'] ) ? '<p class="wp-block-post-author__bio">' . get_the_author_meta( 'user_description', $author_id ) . '</p>' : '' ) .
	       '</div>' .
	       '</div>';
}

add_filter('render_block', 'dhn_custom_post_author_render', 10, 2);
