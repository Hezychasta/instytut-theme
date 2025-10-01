<?php

/*
Plugin Name: Are You Paying Attention?
Plugin URI: https://example.com/are-you-paying-attention
Description: A plugin to check if users are paying attention.
Version: 1.0.0
Author: Hezy
Author URI: https://example.com
*/

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class AreYouPayingAttention
{
    function __construct()
    {
        add_action('init', array($this, 'adminAssets'));
    }

    function adminAssets()
    {
        wp_register_script('ournewblocktype', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element', 'wp-editor'), filemtime(plugin_dir_path(__FILE__) . 'build/index.js'), true);
        register_block_type('ourplugin/are-you-paying-attention', array(
            'editor_script' => 'ournewblocktype',
            'render_callback' => array($this, 'theHTML'),
        ));
    }

    function theHTML($attributes)
    {
        ob_start();
?>
        <div class="paying-attention">
            <h2>Are You Paying Attention?</h2>
            <p>Today the sky is <?php echo esc_html($attributes['skyColor']); ?> and the grass is <?php echo esc_html($attributes['grassColor']); ?>.</p>
        </div>
<?php
        return ob_get_clean();
    }
}
$areYouPayingAttention = new AreYouPayingAttention();
