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
    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    public function enqueue_scripts()
    {
        wp_enqueue_script('aypa-script', plugin_dir_url(__FILE__) . 'test.js', array(), '1.0.0', true);
    }
}

new AreYouPayingAttention();
