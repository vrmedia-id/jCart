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

// This file demonstrates a basic checkout page

// If your page calls session_start() be sure to include jcart.php first
include_once('jcart/jcart.php'); ?>
<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>jCart - Free Ajax/PHP Shopping Cart</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="jcart/css/jcart.min.css">
</head>

<body>
	<div id="wrapper">
		<!-- HEADER -->
		<header class="navbar navbar-expand-lg bg-primary navbar-dark sticky-top mb-5">
			<div class="container p-2">
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<a class="navbar-brand fw-bolder" href="#!">JCART</a>
				<div class="collapse navbar-collapse order-md-1" id="navbarText">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
						<li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
						<li class="nav-item"><a class="nav-link" href="checkout.php">Checkout</a></li>
						<li class="nav-item"><a class="nav-link" href="jcart/server-test.php">Server Test</a></li>
					</ul>
				</div>
			</div>
		</header>
		<!-- HEADER END -->

		<div id="content">
			<div id="jcart"><?php $jcart->display_cart(); ?></div>

			<p><a href="index.php">&larr; Continue shopping</a></p>

			<?php
			//echo '<pre>';
			//var_dump($_SESSION['jcart']);
			//echo '</pre>';
			?>
		</div>

		<div class="clear"></div>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script type="text/javascript" src="jcart/js/jcart.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>