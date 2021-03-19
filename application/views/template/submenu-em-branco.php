<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Bem vindo!</title>
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/subpags.css">
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/demo.css">
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/normalize.css"> 
        <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/item-menu-circular.js"></script>

	</head>
	<body>
		<div class="container">
			<!-- Top Navigation -->
			<div class="component">
				<!-- Start Nav Structure -->
				<button class="cn-button" id="cn-button">+</button>
				<div class="cn-wrapper" id="cn-wrapper">
				    <ul>
				      <li><a href=""><span class="icon-off"></span></a></li>
				      <li><a href=""><span class="icon-book"></span></a></li>
				      <li><a href="menu"><span class="icon-home"></span></a></li>
				      <li><a href=""><span class="icon-file"></span></a></li>
				      <li><a href=""><span class="icon-phone"></span></a></li>
				     </ul>
				</div>
				<div id="cn-overlay" class="cn-overlay"></div>
				<!-- End Nav Structure -->
			</div>
		</div><!-- /container -->

		<script type = 'text/javascript' src = "<?php echo base_url(); ?>js/menu-circular.js"></script>
		<script type = 'text/javascript' src = "<?php echo base_url(); ?>js/submenu-texto.js"></script>
		<!-- For the demo ad only -->   
	</body>
</html>