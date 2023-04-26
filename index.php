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

// This file demonstrates a basic store setup
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
	<!-- HEADER -->
	<header class="navbar navbar-expand-lg bg-primary navbar-dark sticky-top mb-5">
		<div class="container p-2">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand fw-bolder" href="#!">JCART</a>
			<div class="btn-group order-md-2">
				<button type="button" class="position-relative border-0 bg-transparent" data-bs-display="static" data-bs-offset="10,20" data-bs-toggle="dropdown" aria-expanded="false">
					<svg fill="#fff" width="30" height="30" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" d="m20.946 2 .994 17.89a2 2 0 0 1-1.886 2.107l-.111.003H4.057a2 2 0 0 1-2-2c0-.055 0-.055.003-.11L3.054 2h17.892Zm-16 2-.889 16h15.886l-.889-16H4.946ZM7 6h2v2.5c0 1.248 1.385 2.5 3 2.5s3-1.252 3-2.5V6h2v2.5c0 2.4-2.323 4.5-5 4.5s-5-2.1-5-4.5V6Z" />
					</svg>
					<span class="position-absolute top-0 translate-middle badge rounded-pill bg-danger" id="jcart-count"></span>
				</button>
				<ul class="dropdown-menu dropdown-menu-end rounded-0 p-0" style="min-width:350px">
					<div id="jcart">
						<?php
						$jcart = $_SESSION['jcart'];
						if (!is_object($jcart)) {
							$jcart = $_SESSION['jcart'] = new jcart();
						}
						$jcart->display_cart();
						?>
					</div>
				</ul>
			</div>
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
	<!-- MAIN -->
	<main class="container">
		<div class="row">
			<div class="col-md-12 order-2">
				<div class="row">
					<!-- ITEM 1 -->
					<div class="col-md-3 col-6">
						<div class="card mb-4">
							<div class="card-content">
								<form method="post" action="" class="jcart">
									<!-- VALUE -->
									<input type="hidden" name="jcartToken" value="<?= $_SESSION['jcartToken']; ?>">
									<input type="hidden" name="my-item-id" value="JCART-001">
									<input type="hidden" name="my-item-name" value="Product 1">
									<input type="hidden" name="my-item-url" value="">
									<input type="hidden" name="my-item-price" value="25.00">
									<input type="hidden" name="my-item-thumb" value="https://images.unsplash.com/photo-1542291026-7eec264c27ff?=&fit=crop&w=500&h=500">
									<!-- VALUE END -->
									<img class="card-img-top img-fluid" src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?=&fit=crop&w=500&h=500" alt="Product 1">
									<div class="card-body">
										<h4 class="card-title">Product 1</h4>
										<p class="card-text">
											Lorem ipsum dolor sit amet consectetur adipisicing.
										</p>
									</div>
									<div class="card-footer bg-white">
										<div class="row align-items-center mb-2 border-bottom pb-2">
											<div class="col-7">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">QTY</span>
													</div>
													<input type="number" aria-label="QTY" class="form-control" name="my-item-qty" value="1">
												</div>
											</div>
											<div class="col-5">
												<span class="h5">$25.00</span>
											</div>
										</div>
										<button type="submit" name="my-add-button" value="Add To Cart" class="add-to-cart btn btn-primary rounded-0 w-100">Add To Cart</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- ITEM 2 -->
					<div class="col-md-3 col-6">
						<div class="card mb-4">
							<div class="card-content">
								<form method="post" action="" class="jcart">
									<!-- VALUE -->
									<input type="hidden" name="jcartToken" value="<?= $_SESSION['jcartToken']; ?>">
									<input type="hidden" name="my-item-id" value="JCART-002">
									<input type="hidden" name="my-item-name" value="Product 2">
									<input type="hidden" name="my-item-url" value="">
									<input type="hidden" name="my-item-price" value="32.00">
									<input type="hidden" name="my-item-thumb" value="https://images.unsplash.com/photo-1512990414788-d97cb4a25db3?=format&fit=crop&w=500&h=500">
									<!-- VALUE END -->
									<img class="card-img-top img-fluid" src="https://images.unsplash.com/photo-1512990414788-d97cb4a25db3?=format&fit=crop&w=500&h=500" alt="Product 2">
									<div class="card-body">
										<h4 class="card-title">Product 2</h4>
										<p class="card-text">
											Lorem ipsum dolor sit, amet consectetur adipisicing.
										</p>
									</div>
									<div class="card-footer bg-white">
										<div class="row align-items-center mb-2 border-bottom pb-2">
											<div class="col-7">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">QTY</span>
													</div>
													<input type="number" aria-label="QTY" class="form-control" name="my-item-qty" value="1">
												</div>
											</div>
											<div class="col-5">
												<span class="h5">$32.00</span>
											</div>
										</div>
										<button type="submit" name="my-add-button" value="Add To Cart" class="add-to-cart btn btn-primary rounded-0 w-100">Add To Cart</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- ITEM 3 -->
					<div class="col-md-3 col-6">
						<div class="card mb-4">
							<div class="card-content">
								<form method="post" action="" class="jcart">
									<!-- VALUE -->
									<input type="hidden" name="jcartToken" value="<?= $_SESSION['jcartToken']; ?>">
									<input type="hidden" name="my-item-id" value="JCART-003">
									<input type="hidden" name="my-item-name" value="Product 3">
									<input type="hidden" name="my-item-url" value="">
									<input type="hidden" name="my-item-price" value="15.00">
									<input type="hidden" name="my-item-thumb" value="https://images.unsplash.com/photo-1543163521-1bf539c55dd2?=format&fit=crop&w=500&h=500">
									<!-- VALUE END -->
									<img class="card-img-top img-fluid" src="https://images.unsplash.com/photo-1543163521-1bf539c55dd2?=format&fit=crop&w=500&h=500" alt="Product 3">
									<div class="card-body">
										<h4 class="card-title">Product 3</h4>
										<p class="card-text">
											Lorem ipsum dolor sit amet consectetur adipisicing.
										</p>
									</div>
									<div class="card-footer bg-white">
										<div class="row align-items-center mb-2 border-bottom pb-2">
											<div class="col-7">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">QTY</span>
													</div>
													<input type="number" aria-label="QTY" class="form-control" name="my-item-qty" value="1">
												</div>
											</div>
											<div class="col-5">
												<span class="h5">$15.00</span>
											</div>
										</div>
										<button type="submit" name="my-add-button" value="Add To Cart" class="add-to-cart btn btn-primary rounded-0 w-100">Add To Cart</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- ITEM 4 -->
					<div class="col-md-3 col-6">
						<div class="card mb-4">
							<div class="card-content">
								<form method="post" action="" class="jcart">
									<!-- VALUE -->
									<input type="hidden" name="jcartToken" value="<?= $_SESSION['jcartToken']; ?>">
									<input type="hidden" name="my-item-id" value="JCART-004">
									<input type="hidden" name="my-item-name" value="Product 4">
									<input type="hidden" name="my-item-url" value="">
									<input type="hidden" name="my-item-price" value="19.00">
									<input type="hidden" name="my-item-thumb" value="https://images.unsplash.com/photo-1534653299134-96a171b61581?=format&fit=crop&w=500&h=500">
									<!-- VALUE END -->
									<img class="card-img-top img-fluid" src="https://images.unsplash.com/photo-1534653299134-96a171b61581?=format&fit=crop&w=500&h=500" alt="Product 4">
									<div class="card-body">
										<h4 class="card-title">Product 4</h4>
										<p class="card-text">
											Lorem ipsum dolor sit amet consectetur adipisicing.
										</p>
									</div>
									<div class="card-footer bg-white">
										<div class="row align-items-center mb-2 border-bottom pb-2">
											<div class="col-7">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">QTY</span>
													</div>
													<input type="number" aria-label="QTY" class="form-control" name="my-item-qty" value="1">
												</div>
											</div>
											<div class="col-5">
												<span class="h5">$19.00</span>
											</div>
										</div>
										<button type="submit" name="my-add-button" value="Add To Cart" class="add-to-cart btn btn-primary rounded-0 w-100">Add To Cart</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="position-relative p-5 text-center text-muted">
			<h1 class="text-body-emphasis">Having trouble?</h1>
			<p class="col-lg-6 mx-auto mb-4">
				Test your server settings.
			</p>
			<a class="btn btn-primary px-5 mb-5" href="jcart/server-test.php">
				Test Server
			</a>
		</div>
	</main>
	<!-- MAIN END -->
	<!-- FOOTER -->
	<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top bg-primary" data-bs-theme="dark">
		<div class="container">
			<div class="row">
				<div class="col-6 d-flex align-items-center">
					<span class="mb-3 mb-md-0 text-white">© <?= date('Y'); ?> jCart, Rebuilt by VRMedia Indonesia</span>
				</div>

				<ul class="nav col-6 justify-content-end list-unstyled d-flex">
					<li class="ms-3">
						<a class="text-body-secondary" href="#" target="_blank">
							<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#fff">
								<path d="M22 5.8a8.49 8.49 0 0 1-2.36.64 4.13 4.13 0 0 0 1.81-2.27 8.21 8.21 0 0 1-2.61 1 4.1 4.1 0 0 0-7 3.74 11.64 11.64 0 0 1-8.45-4.29 4.16 4.16 0 0 0-.55 2.07 4.09 4.09 0 0 0 1.82 3.41 4.05 4.05 0 0 1-1.86-.51v.05a4.1 4.1 0 0 0 3.3 4 3.93 3.93 0 0 1-1.1.17 4.9 4.9 0 0 1-.77-.07 4.11 4.11 0 0 0 3.83 2.84A8.22 8.22 0 0 1 3 18.34a7.93 7.93 0 0 1-1-.06 11.57 11.57 0 0 0 6.29 1.85A11.59 11.59 0 0 0 20 8.45v-.53a8.43 8.43 0 0 0 2-2.12Z" />
							</svg>
						</a>
					</li>
					<li class="ms-3">
						<a class="text-body-secondary" href="https://www.instagram.com/im_perii/" target="_blank">
							<svg width="24" height="24" viewBox="-2 -2 24 24" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin" fill="#fff" class="jam jam-instagram">
								<path d="M14.017 0h-8.07A5.954 5.954 0 0 0 0 5.948v8.07a5.954 5.954 0 0 0 5.948 5.947h8.07a5.954 5.954 0 0 0 5.947-5.948v-8.07A5.954 5.954 0 0 0 14.017 0zm3.94 14.017a3.94 3.94 0 0 1-3.94 3.94h-8.07a3.94 3.94 0 0 1-3.939-3.94v-8.07a3.94 3.94 0 0 1 3.94-3.939h8.07a3.94 3.94 0 0 1 3.939 3.94v8.07z" />
								<path d="M9.982 4.819A5.17 5.17 0 0 0 4.82 9.982a5.17 5.17 0 0 0 5.163 5.164 5.17 5.17 0 0 0 5.164-5.164A5.17 5.17 0 0 0 9.982 4.82zm0 8.319a3.155 3.155 0 1 1 0-6.31 3.155 3.155 0 0 1 0 6.31z" />
								<circle cx="15.156" cy="4.858" r="1.237" />
							</svg>
						</a>
					</li>
					<li class="ms-3">
						<a class="text-body-secondary" href="https://www.facebook.com/iam.perii/" target="_blank">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="#fff" xmlns="http://www.w3.org/2000/svg" class="icon flat-color">
								<path d="M14 6h3a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-3a5 5 0 0 0-5 5v3H7a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2v7a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-7h2.22a1 1 0 0 0 1-.76l.5-2a1 1 0 0 0-1-1.24H13V7a1 1 0 0 1 1-1Z" />
							</svg>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</footer>
	<!-- FOOTER END -->
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script type="text/javascript" src="jcart/js/jcart.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>