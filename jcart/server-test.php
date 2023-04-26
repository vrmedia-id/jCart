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

session_start(); ?>

<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
	<title>jCart - Server Test</title>
</head>

<body>
	<main class="container">
		<div class="px-4 py-5 my-5 text-center">
			<h1 class="display-5 fw-bold text-body-emphasis">jCart - Server Test</h1>
			<div class="col-lg-6 mx-auto">
				<p class="lead mb-4">Server Test is a process to evaluate the functionality, reliability, and security of a server. It is essential to configure the server with the right settings to ensure its optimum performance. Below are the Required and Recommended Settings for a successful Server Test.</p>
				<div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
					<a href="../index.php" class="btn btn-primary btn-lg px-4 gap-3">Back To Homepage</a>
					<a href="https://conceptlogic.com/jcart/" target="_blank" class="btn btn-outline-secondary btn-lg px-4">Documentation</a>
				</div>
			</div>
		</div>
		<div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center">
			<div class="list-group">
				<h5 class="mb-3 fw-bold">Required Settings</h5>
				<?php $phpVersion = phpversion();
				if ($phpVersion >= 5.2) { ?>
					<label class="list-group-item d-flex gap-2">
						<input class="form-check-input flex-shrink-0" type="checkbox" <?= $class = 'checked'; ?> value="" disabled>
						<span>
							PHP VERSION
							<small class="d-block text-body-secondary">Requires version 5.2 or newer, this server is using version <strong class="text-success"><?= $phpVersion; ?></strong></small>
						</span>
					</label>
				<?php }
				$_SESSION['support'] = true; ?>
				<label class="list-group-item d-flex gap-2">
					<?php if ($_SESSION['support'] === true) { ?>
						<input class="form-check-input flex-shrink-0" type="checkbox" value="" checked disabled>
						<span>
							Session Support
							<small class="d-block text-body-secondary"><strong class="text-success">Enabled</strong></small>
						</span>
					<?php } else { ?>
						<input class="form-check-input flex-shrink-0" type="checkbox" value="" disabled>
						<span>
							Session Support
							<small class="d-block text-body-secondary"><strong class="text-danger">Not Enabled</strong></small>
						</span>
					<?php } ?>
				</label>
			</div>

			<div class="list-group">
				<h5 class="mb-3 fw-bold">Recommended Settings</h5>
				<?php $registerGlobals = ini_get('register_globals'); ?>
				<label class="list-group-item d-flex gap-2">
					<?php if ($registerGlobals) { ?>
						<input class="form-check-input flex-shrink-0" type="checkbox" value="" checked disabled>
						<span>
							Register Globals
							<small class="d-block text-body-secondary"><strong class="text-success">On</strong></small>
						</span>
					<?php } else { ?>
						<input class="form-check-input flex-shrink-0" type="checkbox" value="" disabled>
						<span>
							Register Globals
							<small class="d-block text-body-secondary"><strong class="text-danger">Off</strong></small>
						</span>
					<?php } ?>
				</label>
				<?php $errorReporting = ini_get('error_reporting'); ?>
				<label class="list-group-item d-flex gap-2">
					<?php if ($errorReporting) { ?>
						<input class="form-check-input flex-shrink-0" type="checkbox" value="" checked disabled>
						<span>
							Display Errors
							<small class="d-block text-body-secondary"><strong class="text-success">On</strong></small>
						</span>
					<?php } else { ?>
						<input class="form-check-input flex-shrink-0" type="checkbox" value="" disabled>
						<span>
							Display Errors
							<small class="d-block text-body-secondary"><strong class="text-danger">Off</strong></small>
						</span>
					<?php } ?>
				</label>
			</div>
		</div>
	</main>
</body>

</html>