<?php

/**
 * jCart - A Simple PHP Shopping Cart
 *
 * @version 1.3
 * @link http://conceptlogic.com/jcart/
 * @author
 *      - Original Author: Conceptlogic (http://conceptlogic.com/)
 *      - Rebuilt by: VRMedia
 */



////////////////////////////////////////////////////////////////////////////////
// REQUIRED SETTINGS

// Path to your jcart files

$config = [
    // Path
    'jcartPath'     => 'jcart/',
    // Path to your checkout page
    'checkoutPath'  => 'checkout.php',

    // The HTML name attributes used in your item forms
    'item'          => [
        'id'    => 'my-item-id',
        'name'  => 'my-item-name',
        'price' => 'my-item-price',
        'qty'   => 'my-item-qty',
        'url'   => 'my-item-url',
        'thumb' => 'my-item-thumb',
        // 'color' => 'my-item-color',
        'add'   => 'my-add-button',
    ],


    ////////////////////////////////////////////////////////////////////////////////
    // ADVANCED SETTINGS
    // Display tooltip after the visitor adds an item to their cart?
    'tooltip'       => true,
    // Allow decimals in item quantities?
    'decimalQtys'   => false,
    // How many decimal places are allowed?
    'decimalPlaces' => 1,
    // Number format for prices, see: http://php.net/manual/en/function.number-format.php
    'priceFormat'   => [
        'decimals'        => 2,
        'dec_point'       => '.',
        'thousands_sep'   => ',',
        'currency_symbol' => 'Rp. ',
    ],
    'paypal'        => [
        // Your PayPal secure merchant ID
        // Found here: https://www.paypal.com/webapps/customerprofile/summary.view
        'id'        => 'seller_1282188508_biz@conceptlogic.com',
        // Send visitor to PayPal via HTTPS?
        'https'     => true,
        // Use PayPal sandbox?
        'sandbox'   => false,
        // The URL a visitor is returned to after completing their PayPal transaction
        'returnUrl' => '',
        // The URL of your PayPal IPN script
        'notifyUrl' => '',
    ],
    // Override the default buttons by entering paths to your button images
    'button'        => [
        'checkout' => '',
        'paypal'   => '',
        'update'   => '',
        'empty'    => '',
    ],
    ////////////////////////////////////////////////////////////////////////////////
    // OPTIONAL SETTINGS
    // Add a unique token to form posts to prevent CSRF exploits
    // Learn more: http://conceptlogic.com/jcart/security.php
    'csrfToken'     => true,
    // Three-letter currency code, defaults to USD if empty
    // See available options here: http://j.mp/agNsTx
    'currencyCode'  => 'INA',
    // Override default cart text
    'text'          => [
        // Shopping Cart
        'cartTitle'        => '',
        // Item
        'singleItem'       => '',
        // Items
        'multipleItems'    => '',
        // Subtotal
        'subtotal'         => '',
        // update
        'update'           => '',
        // checkout
        'checkout'         => '',
        // Checkout with PayPal
        'checkoutPaypal'   => '',
        // remove
        'removeLink'       => '&#10005;',
        // empty
        'emptyButton'      => '',
        // Your cart is empty!
        'emptyMessage'     => '',
        // Item added!
        'itemAdded'        => '',
        // Invalid price format!
        'priceError'       => '',
        // Item quantities must be whole numbers!
        'quantityError'    => '',
        // Your order could not be processed!
        'checkoutError'    => '',
    ],
];
