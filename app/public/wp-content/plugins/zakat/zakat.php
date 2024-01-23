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


}


//new SimpleContentForm;


function woo_order_status_change_custom($order_id)
{
    $order = wc_get_order($order_id);
    $order_data = $order->get_data();
    $customer_email = $order_data['billing']['email'];
    $customer_name = $order_data['billing']['first_name'] . ' ' . $order_data['billing']['last_name'];
    $customer_phone = $order_data['billing']['phone'];
    $customer_address = $order_data['billing']['address_1'] . ' ' . $order_data['billing']['address_2'];
    $customer_city = $order_data['billing']['city'];
    $customer_state = $order_data['billing']['state'];
    $customer_zip = $order_data['billing']['postcode'];
    $customer_country = $order_data['billing']['country'];
    $customer_note = $order_data['customer_note'];
    $order_total = $order_data['total'];
    $order_status = $order_data['status'];
    $store_name = get_bloginfo('name');
    $store_url = home_url();

    $data = [$customer_name, $customer_email, $customer_phone, $customer_address, $customer_city, $customer_state, $customer_zip, $customer_country, $customer_note, $order_total, $order_status, $store_name,$store_url];

//wp_send_json_success($data);
    require __DIR__ . '/vendor/autoload.php';

    $client = new \Google_Client();
    $client->setApplicationName('Google Sheets with Primo');
    $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
    $client->setAuthConfig(__DIR__ . '/credentials.json');

    $service = new Google_Service_Sheets($client);
    $spreadsheetId = "1Y6MPAWQfZFt8FxbwH3-kCH7ATJdJtJo0d8F_bGX0pYc";

    $range = "ammar1"; // Sheet name

    $values = [
        $data ,
    ];
// echo "<pre>";print_r($values);echo "</pre>";exit;
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'RAW'
    ];

    $result = $service->spreadsheets_values->append(
        $spreadsheetId,
        $range,
        $body,
        $params
    );

    if ($result->updates->updatedRows == 1) {
        echo "Success";
    } else {
        echo "Fail";
    }


}

add_action('woocommerce_order_status_changed', 'woo_order_status_change_custom');