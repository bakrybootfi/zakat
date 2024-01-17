<?php

/*
Plugin Name: Simple Contact Form
Description: Simple Contact Form tutorial
Version: 1.0.0
Author: Bootfi
Author URI: https://bootfi.com/
Text Domain: simple-contact-form
*/

if (!defined('ABSPATH')) {
    echo 'what are you trying to do';
    exit;
}

class SimpleContentForm
{

    public function __construct()
    {
//        //create custom post type
//        add_action('init', [$this, 'so_status_completed']);
//
//        //add assets (js, css, etc)
//        add_action('wp_enqueue_scripts', [$this, 'load_assets']);
//
//        //add shortcode
//        add_shortcode('contact-form', [$this, 'load_shortcode']);
//
//        add_action('wp_footer', [$this, 'load_script']);
//
//        add_action('woocommerce_order_status_changed', 'so_status_completed', 10, 3);
//
//        add_action('woocommerce_order_status_changed', [$this, 'woocommerce_product_done']);
//
//        add_action('woocommerce_single_product_summary', [$this, 'trying']);

        add_action('woocommerce_order_status_changed', 'woo_order_status_change_custom');
        add_action('woocommerce_order_status_changed', 'woo_order_status_change_custom');


    }

    public function create_custom_post_type()
    {
        $args = [
            'public' => true,
            'has_archive' => true,
            'supports' => ['title'],
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'capability' => 'manage_options',
            'label' => 'Contact Form',
            // 'label' => [
            //     // 'name' => 'Contact Form',
            //     // 'singular_name' => 'Contact Form Entry',
            // ],
            'menu_icon' => 'dashicons-email-alt',

        ];

        register_post_type('simple-contact_form', $args);
    }

    public function load_assets()
    {

        wp_enqueue_script(
            'simple-contact-form', //name
            plugin_dir_url(__FILE__) . 'css/simple-contact-form.css', //src
            [], //dependencies
            1, //version
            'all', //media
        );

        wp_enqueue_script(
            'simple-contact-form',
            plugin_dir_url(__FILE__) . 'js/simple-contact-form.js',
            ['jquery'],
            1,
            true, //in footer
        );
    }

    public function load_shortcode()
    { ?>
        <div class="simple-contact-form">

            <h1>Send us an email</h1>
            <p>please fill the form below</p>

            <form id="simple-contact-form__form">

                <div class="form-group mb-2">
                    <input name="name" type="text" placeholder="Name" class="form-control">
                </div>

                <div class="form-group mb-2">
                    <input name="email" type="email" placeholder="Email" class="form-control">
                </div>

                <div class="form-group mb-2">
                    <input name="phone" type="tel" placeholder="Phone" class="form-control">
                </div>

                <div class="form-group mb-2">
                    <textarea name="message" placeholder="Message" class="form-control"></textarea>
                </div>

                <div class="form-group mb-2">
                    <button class="btn btn-success btn-block w-100">Send Message</button>
                </div>

            </form>

        </div>
    <?php }

    public function load_script()
    { ?>
        <script>
            alert('hello from footer');
        </script>
    <?php }

    public function woocommerce_product_done()
    {
        ?>
        <script>
            alert('hello');
        </script>
        <?php
    }

    function trying()
    {
        ?>
        <h1>hello</h1>

        <!-- <script>
            alert('hello');
        </script> -->
        <?php
    }


    function woo_order_status_change_custom($order_id, $old_status, $new_status)
    {
        $order = wc_get_order($order_id);

        $order->update_status('wc-on-hold');

    }


}


new SimpleContentForm;