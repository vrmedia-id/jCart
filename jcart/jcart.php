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

// Cart logic based on Webforce Cart: http://www.webforcecart.com/
class Jcart
{

	public $config     = [];
	private $items     = [];
	private $names     = [];
	private $thumbs    = [];
	private $prices    = [];
	private $qtys      = [];
	private $urls      = [];
	private $subtotal  = 0;
	private $itemCount = 0;

	function __construct()
	{

		// Get $config array
		include_once('config-loader.php');
		$this->config = $config;
	}

	/**
	 * Get cart contents
	 *
	 * @return array
	 */
	public function get_contents()
	{
		$items = [];
		foreach ($this->items as $tmpItem) {
			$item = null;
			$item['id']       = $tmpItem;
			$item['name']     = $this->names[$tmpItem];
			$item['thumb']    = $this->thumbs[$tmpItem];
			$item['price']    = $this->prices[$tmpItem];
			$item['qty']      = $this->qtys[$tmpItem];
			$item['url']      = $this->urls[$tmpItem];
			$item['subtotal'] = $item['price'] * $item['qty'];
			$items[]          = $item;
		}
		return $items;
	}

	/**
	 * Add an item to the cart
	 *
	 * @param string $id
	 * @param string $name
	 * @param float $price
	 * @param mixed $qty
	 * @param string $url
	 *
	 * @return mixed
	 */
	private function add_item($id, $name, $thumb, $price, $qty = 1, $url = 1)
	{

		$validPrice = false;
		$validQty = false;

		// Verify the price is numeric
		if (is_numeric($price)) {
			$validPrice = true;
		}

		// If decimal quantities are enabled, verify the quantity is a positive float
		if ($this->config['decimalQtys'] === true && filter_var($qty, FILTER_VALIDATE_FLOAT) && $qty > 0) {
			$validQty = true;
		}
		// By default, verify the quantity is a positive integer
		elseif (filter_var($qty, FILTER_VALIDATE_INT) && $qty > 0) {
			$validQty = true;
		}

		// Add the item
		if ($validPrice !== false && $validQty !== false) {

			// If the item is already in the cart, increase its quantity
			if (isset($this->qtys[$id]) && $this->qtys[$id] > 0) {
				$this->qtys[$id] += $qty;
				$this->update_subtotal();
			}
			// This is a new item
			else {
				$this->items[]     = $id;
				$this->names[$id]  = $name;
				$this->thumbs[$id] = $thumb;
				$this->prices[$id] = $price;
				$this->qtys[$id]   = $qty;
				$this->urls[$id]   = $url;
			}
			$this->update_subtotal();
			return true;
		} elseif ($validPrice !== true) {
			$errorType = 'price';
			return $errorType;
		} elseif ($validQty !== true) {
			$errorType = 'qty';
			return $errorType;
		}
	}

	/**
	 * Update an item in the cart
	 *
	 * @param string $id
	 * @param mixed $qty
	 *
	 * @return boolean
	 */
	private function update_item($id, $qty)
	{

		// If the quantity is zero, no futher validation is required
		if ((int) $qty === 0) {
			$validQty = true;
		}
		// If decimal quantities are enabled, verify it's a float
		elseif ($this->config['decimalQtys'] === true && filter_var($qty, FILTER_VALIDATE_FLOAT)) {
			$validQty = true;
		}
		// By default, verify the quantity is an integer
		elseif (filter_var($qty, FILTER_VALIDATE_INT)) {
			$validQty = true;
		}

		// If it's a valid quantity, remove or update as necessary
		if ($validQty === true) {
			if ($qty < 1) {
				$this->remove_item($id);
			} else {
				$this->qtys[$id] = $qty;
			}
			$this->update_subtotal();
			return true;
		}
	}


	/* Using post vars to remove items doesn't work because we have to pass the
	id of the item to be removed as the value of the button. If using an input
	with type submit, all browsers display the item id, instead of allowing for
	user-friendly text. If using an input with type image, IE does not submit
	the	value, only x and y coordinates where button was clicked. Can't use a
	hidden input either since the cart form has to encompass all items to
	recalculate	subtotal when a quantity is changed, which means there are
	multiple remove	buttons and no way to associate them with the correct
	hidden input. */

	/**
	 * Reamove an item from the cart
	 *
	 * @param string $id	*
	 */
	private function remove_item($id)
	{
		$tmpItems = [];
		unset($this->names[$id], $this->thumbs[$id], $this->prices[$id], $this->qtys[$id], $this->urls[$id]);
		// Rebuild the items array, excluding the id we just removed
		foreach ($this->items as $item) {
			if ($item != $id) {
				$tmpItems[] = $item;
			}
		}
		$this->items = $tmpItems;
		$this->update_subtotal();
	}

	/**
	 * Empty the cart
	 */
	public function empty_cart()
	{
		$this->items     = [];
		$this->names     = [];
		$this->thumbs    = [];
		$this->prices    = [];
		$this->qtys      = [];
		$this->urls      = [];
		$this->subtotal  = 0;
		$this->itemCount = 0;
	}

	/**
	 * Update the entire cart
	 */
	public function update_cart()
	{
		// Check if there are any item IDs in the cart
		if (!isset($_POST['jcartItemId'])) {
			// If there are no items in the cart, return true to prevent unnecessary error messages
			return true;
		}
		// Get the new quantities for each item in the cart
		$qtys = array_map('intval', $_POST['jcartItemQty']);
		// If decimal quantities are enabled, verify that the quantities are valid floats
		if ($this->config['decimalQtys'] === true) {
			$validQtys = array_reduce(
				$qtys,
				function ($carry, $qty) {
					return $carry && filter_var($qty, FILTER_VALIDATE_FLOAT);
				},
				true
			);
		}
		// By default, verify that the quantities are valid integers
		else {
			$validQtys = array_reduce(
				$qtys,
				function ($carry, $qty) {
					return $carry && filter_var($qty, FILTER_VALIDATE_INT);
				},
				true
			);
		}
		// If the quantities are not valid, return false
		if (!$validQtys) {
			return false;
		}
		// Update the quantities of each item in the cart
		foreach ($_POST['jcartItemId'] as $id) {
			$qty = array_shift($qtys);
			if ($qty < 1) {
				$this->remove_item($id);
			} else {
				$this->update_item($id, $qty);
			}
		}
		// Return true to indicate that the cart was updated successfully
		return true;
	}

	/**
	 * Recalculate subtotal
	 */
	private function update_subtotal()
	{
		$this->itemCount = 0;
		$this->subtotal  = 0;
		if (sizeof($this->items) > 0) {
			foreach ($this->items as $item) {
				$this->subtotal += ($this->qtys[$item] * $this->prices[$item]);
				// Total number of items
				$this->itemCount += $this->qtys[$item];
			}
		}
	}

	/**
	 * Process and display cart
	 */
	public function display_cart()
	{

		$config = $this->config;
		$errorMessage = null;

		// Simplify some config variables
		$checkout = $config['checkoutPath'];
		$priceFormat = $config['priceFormat'];

		$id    = $config['item']['id'];
		$name  = $config['item']['name'];
		$thumb = $config['item']['thumb'];
		$price = $config['item']['price'];
		$qty   = $config['item']['qty'];
		$url   = $config['item']['url'];
		$add   = $config['item']['add'];

		// Use config values as literal indices for incoming POST values
		// Values are the HTML name attributes set in config.json
		$id    = (isset($_POST[$id])) ? $_POST[$id] : false;
		$name  = (isset($_POST[$name])) ? $_POST[$name] : false;
		$thumb = (isset($_POST[$thumb])) ? $_POST[$thumb] : false;
		$price = (isset($_POST[$price])) ? $_POST[$price] : false;
		$qty   = (isset($_POST[$qty])) ? $_POST[$qty] : false;
		$url   = (isset($_POST[$url])) ? $_POST[$url] : false;

		// Optional CSRF protection, see: http://conceptlogic.com/jcart/security.php
		$jcartToken = (isset($_POST['jcartToken'])) ? $_POST['jcartToken'] : true;

		// Only generate unique token once per session
		if (!isset($_SESSION['jcartToken']) || !$_SESSION['jcartToken']) {
			$_SESSION['jcartToken'] = md5(session_id() . time() . $_SERVER['HTTP_USER_AGENT']);
		}
		// If enabled, check submitted token against session token for POST requests
		if ($config['csrfToken'] === 'true' && $_POST && $jcartToken != $_SESSION['jcartToken']) {
			$errorMessage = 'Invalid token!' . $jcartToken . ' / ' . $_SESSION['jcartToken'];
		}

		// Sanitize values for output in the browser
		$id    = filter_var($id, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
		$name  = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
		$thumb = filter_var($thumb, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
		$url   = filter_var($url, FILTER_SANITIZE_URL);

		// Round the quantity if necessary
		if ($config['decimalPlaces'] === true) {
			$qty = round($qty, $config['decimalPlaces']);
		}

		// Add an item
		if (isset($_POST[$add]) && $_POST[$add]) {
			$itemAdded = $this->add_item($id, $name, $thumb, $price, $qty, $url);
			// If not true the add item function returns the error type
			if ($itemAdded !== true) {
				$errorType = $itemAdded;
				switch ($errorType) {
					case 'qty':
						$errorMessage = $config['text']['quantityError'];
						break;
					case 'price':
						$errorMessage = $config['text']['priceError'];
						break;
				}
			}
		}

		// Update a single item
		if (isset($_POST['jcartUpdate'])) {
			$itemUpdated = $this->update_item($_POST['itemId'], $_POST['itemQty']);
			if ($itemUpdated !== true) {
				$errorMessage = $config['text']['quantityError'];
			}
		}

		// Update all items in the cart
		if (isset($_POST['jcartUpdateCart']) || isset($_POST['jcartCheckout'])) {
			$cartUpdated = $this->update_cart();
			if ($cartUpdated !== true) {
				$errorMessage = $config['text']['quantityError'];
			}
		}

		// Remove an item
		/* After an item is removed, its id stays set in the query string,
		preventing the same item from being added back to the cart in
		subsequent POST requests.  As result, it's not enough to check for
		GET before deleting the item, must also check that this isn't a POST
		request. */
		if (isset($_GET['jcartRemove']) && $_GET['jcartRemove'] && !$_POST) {
			$this->remove_item($_GET['jcartRemove']);
		}

		// Empty the cart
		if (isset($_POST['jcartEmpty']) && $_POST['jcartEmpty']) {
			$this->empty_cart();
		}

		// Determine which text to use for the number of items in the cart
		$itemsText = $config['text']['multipleItems'];
		if ($this->itemCount == 1) {
			$itemsText = $config['text']['singleItem'];
		}

		// Determine if this is the checkout page
		/* First we check the request uri against the config checkout (set when
		the visitor first clicks checkout), then check for the hidden input
		sent with Ajax request (set when visitor has javascript enabled and
		updates an item quantity). */
		$isCheckout = strpos(request_uri(), $checkout);
		if ($isCheckout !== false || isset($_REQUEST['jcartIsCheckout']) && $_REQUEST['jcartIsCheckout'] == 'true') {
			$isCheckout = true;
		} else {
			$isCheckout = false;
		}

		// Overwrite the form action to post to gateway.php instead of posting back to checkout page
		if ($isCheckout === true) {

			// Sanititze config path
			$path = filter_var($config['jcartPath'], FILTER_SANITIZE_URL);

			// Trim trailing slash if necessary
			$path = rtrim($path, '/');

			$checkout = $path . '/gateway.php';
		}

		// Default input type
		// Overridden if using button images in config.php
		$inputType = 'submit';

		// If this error is true the visitor updated the cart from the checkout page using an invalid price format
		// Passed as a session var since the checkout page uses a header redirect
		// If passed via GET the query string stays set even after subsequent POST requests
		if (isset($_SESSION['quantityError']) && $_SESSION['quantityError'] === true) {
			$errorMessage = $config['text']['quantityError'];
			unset($_SESSION['quantityError']);
		}

		// Set currency symbol based on config currency code
		$currencyCode = trim(strtoupper($config['currencyCode']));
		switch ($currencyCode) {
			case 'EUR':
				$currencySymbol = '&#128;';
				break;
			case 'GBP':
				$currencySymbol = '&#163;';
				break;
			case 'JPY':
				$currencySymbol = '&#165;';
				break;
			case 'CHF':
				$currencySymbol = 'CHF&nbsp;';
				break;
			case 'SEK':
			case 'DKK':
			case 'NOK':
				$currencySymbol = 'Kr&nbsp;';
				break;
			case 'PLN':
				$currencySymbol = 'z&#322;&nbsp;';
				break;
			case 'HUF':
				$currencySymbol = 'Ft&nbsp;';
				break;
			case 'CZK':
				$currencySymbol = 'K&#269;&nbsp;';
				break;
			case 'ILS':
				$currencySymbol = '&#8362;&nbsp;';
				break;
			case 'TWD':
				$currencySymbol = 'NT$';
				break;
			case 'THB':
				$currencySymbol = '&#3647;';
				break;
			case 'MYR':
				$currencySymbol = 'RM';
				break;
			case 'PHP':
				$currencySymbol = 'Php';
				break;
			case 'BRL':
				$currencySymbol = 'R$';
				break;
			case 'USD':
			default:
				$currencySymbol = '$';
				break;
		}

		////////////////////////////////////////////////////////////////////////
		// Output the cart

		// Return specified number of tabs to improve readability of HTML output
		function tab($n)
		{
			$tabs = null;
			while ($n > 0) {
				$tabs .= "\t";
				--$n;
			}
			return $tabs;
		}
		echo tab(1) . $errorMessage;
		echo tab(1) . '<form method="POST" action="' . $checkout . '">';
		echo '<input type="hidden" name="jcartToken" value="' . $_SESSION['jcartToken'] . '"> ';
		echo '<input type="hidden" id="jcart-total" value="' . $this->itemCount . '"> ';
		echo tab(2) . '<h5 class="p-3 mb-0">' . $config['text']['cartTitle'] . ' <span>(' . $this->itemCount . ' ' . $itemsText . ')</span></h5>';
		echo tab(2) . '<div class="list-group">';
		// If any items in the cart
		if ($this->itemCount > 0) {
			// Display line items
			foreach ($this->get_contents() as $item) {
				echo tab(3) . '<div class="list-group-item list-group-item-action d-flex gap-3 py-3 align-items-center rounded-0">';
				echo '<input name="jcartItemName[]" type="hidden" value="' . $item['name'] . '">';
				echo tab(4) . '<img src="' . $item['thumb'] . '" alt="' . $item['name'] . '" width="75" height="75" class="rounded-3 flex-shrink-0">';
				echo tab(4) . '<div class="d-flex gap-2 w-100 justify-content-between">';
				echo tab(5) . '<div>';
				echo tab(6) . '<h6 class="mb-2">' . $item['name'] . '</h6>';
				echo tab(6) . '<div class="d-flex align-items-center">';
				echo '<input name="jcartItemPrice[]" type="hidden" value="' . $item['price'] . '">';
				echo tab(7) . '<p class="mb-0 opacity-75 me-3">' . number_format($item['subtotal'], $priceFormat['decimals'], $priceFormat['dec_point'], $priceFormat['thousands_sep']) . '</p>';
				echo '<input name="jcartItemId[]" type="hidden" value="' . $item['id'] . '">';
				echo tab(7) . '<input autocomplete="off" type="number" id="jcartItemQty-' . $item['id'] . '" class="form-control" value="' . $item['qty'] . '" name="jcartItemQty[]">';
				echo tab(6) . '</div>';
				echo tab(5) . '</div>';
				echo tab(5) . '<a class="jcart-remove btn text-nowrap text-decoration-none text-danger" href="?jcartRemove=' . $item['id'] . '">' . $config['text']['removeLink'] . '</a>';
				echo tab(4) . '</div>';
				echo tab(3) . '</div>';
			}
		}
		// The cart is empty
		else {
			echo tab(3) . '<small class="text-muted text-center py-3">' . $config['text']['emptyMessage'] . '</small>';
		}
		echo tab(2) . '</div>';
		echo tab(2) . '<div class="d-flex align-items-center justify-content-between p-3">';
		echo tab(3) . '<span>' . $config['text']['subtotal'] . ' : <strong>' . $currencySymbol . number_format($this->subtotal, $priceFormat['decimals'], $priceFormat['dec_point'], $priceFormat['thousands_sep']) . '</strong></span>';
		if ($isCheckout !== true) {
			if ($config['button']['checkout']) {
				$inputType = "image";
				$src = " src='{$config['button']['checkout']}' alt='{$config['text']['checkout']}' title='' ";
			}
			echo tab(3) . '<input type="' . $inputType . '" ' . isset($src) . ' id="jcart-checkout" name="jcartCheckout" class="jcart-button btn btn-primary rounded-0" value="' . $config['text']['checkout'] . '">';
		}
		echo tab(2) . '</div>';
		echo tab(1) . '</form>';
	}
}

// Start a new session in case it hasn't already been started on the including page
if (!session_id()) {
	session_start();
}

// Initialize jcart after session start
$jcart = (isset($_SESSION['jcart'])) ? $_SESSION['jcart'] : false;
if (!is_object($jcart)) {
	$jcart = $_SESSION['jcart'] = new Jcart();
}

// Enable request_uri for non-Apache environments
// See: http://api.drupal.org/api/function/request_uri/7
if (!function_exists('request_uri')) {
	function request_uri()
	{
		if (isset($_SERVER['REQUEST_URI'])) {
			$uri = $_SERVER['REQUEST_URI'];
		} else {
			if (isset($_SERVER['argv'])) {
				$uri = $_SERVER['SCRIPT_NAME'] . '?' . $_SERVER['argv'][0];
			} elseif (isset($_SERVER['QUERY_STRING'])) {
				$uri = $_SERVER['SCRIPT_NAME'] . '?' . $_SERVER['QUERY_STRING'];
			} else {
				$uri = $_SERVER['SCRIPT_NAME'];
			}
		}
		$uri = '/' . ltrim($uri, '/');
		return $uri;
	}
}
