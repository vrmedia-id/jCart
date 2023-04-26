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

// By default, this file returns the $config array for use with PHP scripts
// If requested via Ajax, the array is encoded as JSON and echoed out to the browser

// Don't edit here, edit config.php
include_once('config.php');

// Use default values for any settings that have been left empty
if (!$config['currencyCode']) {
	$config['currencyCode'] = 'INA';
}
if (!$config['text']['cartTitle']) {
	$config['text']['cartTitle'] = 'Shopping Bag';
}
if (!$config['text']['singleItem']) {
	$config['text']['singleItem'] = 'Item';
}
if (!$config['text']['multipleItems']) {
	$config['text']['multipleItems'] = 'Items';
}
if (!$config['text']['subtotal']) {
	$config['text']['subtotal'] = 'Subtotal';
}
if (!$config['text']['update']) {
	$config['text']['update'] = 'Update';
}
if (!$config['text']['checkout']) {
	$config['text']['checkout'] = 'Checkout';
}
if (!$config['text']['checkoutPaypal']) {
	$config['text']['checkoutPaypal'] = 'Checkout With PayPal';
}
if (!$config['text']['removeLink']) {
	$config['text']['removeLink'] = 'Delete';
}
if (!$config['text']['emptyButton']) {
	$config['text']['emptyButton'] = 'Empty';
}
if (!$config['text']['emptyMessage']) {
	$config['text']['emptyMessage'] = 'Your Cart Is Empty!';
}
if (!$config['text']['itemAdded']) {
	$config['text']['itemAdded'] = 'Item Added!';
}
if (!$config['text']['priceError']) {
	$config['text']['priceError'] = 'Invalid Price Format!';
}
if (!$config['text']['quantityError']) {
	$config['text']['quantityError'] = 'Item Quantities Must Be Whole Numbers!';
}
if (!$config['text']['checkoutError']) {
	$config['text']['checkoutError'] = 'Your Order Could Not Be Processed!';
}

if (isset($_GET['ajax']) && $_GET['ajax'] === 'true') {
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($config);
}
