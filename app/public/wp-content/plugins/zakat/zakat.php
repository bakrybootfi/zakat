<?php

/*
Plugin Name: Simple Contact Form
Description: Simple Contact Form tutorial
Version: 1.0.0
Author: Bootfi
Author URI: https://bootfi.com/
Text Domain: simple-contact-form
*/

use GuzzleHttp\Client;

add_action('woocommerce_order_status_changed', 'woo_order_status_change_custom');


function woo_order_status_change_custom($order_id)
{

    require __DIR__ . "/vendor/autoload.php";


    $client = new Client([
        'base_uri' => 'http://127.0.0.1:82/api/',
        'headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer your_token_here',
        ],
    ]);

    $data = orderData($order_id);

    try {
        $response = $client->post('orders', ['json' => $data]);
        $body = $response->getBody();
        $user = json_decode($body, true);
        echo "User created successfully: " . print_r($user, true) . "\n";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }


}

function orderData($order_id)
{
    $order = wc_get_order($order_id);
    $order_data = $order->get_data();

    $orders = array();

    $order_info = array(
        'order_id' => $order_data['id'],
        'total_vat' => $order_data['cart_tax'],
        'total_price_after_tax' => $order_data['total'],
        'total_price' => $order_data['total'] - $order_data['cart_tax'],
        'url' => $home_url = home_url(),
    );

    $products = [];

    foreach ($order->get_items() as $item) {
        $product = $item->get_product();
        $quantity = $item->get_quantity();
        $products[] = [
            'name' => $product->get_name(),
            'quantity' => $quantity,
            'unit_price' => $unit_price = $item->get_total() / $quantity, $product->get_price(),
            'vat' => $vat = $item->get_total_tax(),
            'price_with_vat' => $unit_price + $vat,
            'order_id' => $order_data['id'],
        ];


    }

   return  $orders = ['order' => $order_info, 'products' => $products];

}
