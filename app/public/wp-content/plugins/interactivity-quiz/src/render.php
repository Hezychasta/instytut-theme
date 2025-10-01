<?php

/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// Generates a unique id for aria-controls.
$unique_id = wp_unique_id('p-');

// Adds the global state.
wp_interactivity_state(
	'create-block',
	array(
		'isDark'    => false,
		'darkText'  => esc_html__('Switch to Light', 'interactivity-quiz'),
		'lightText' => esc_html__('Switch to Dark', 'interactivity-quiz'),
		'themeText'	=> esc_html__('Switch to Dark', 'interactivity-quiz'),
	)
);
?>

<div data-wp-interactive="create-block" data-wp-context='{"clickCount": 0}'>
	<p>The button below has been clicked <span data-wp-text="context.clickCount"></span> times.</p>
	<button data-wp-on--click="actions.buttonHandler">Click me</button>
</div>