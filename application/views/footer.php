<!DOCTYPE html>
<html>
	<head>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/footer.css"> 

	</head>
	<body>	
			<div class="footer">

				<?php 
					echo $this->session->userdata('FOOTER');//$_SESSION['FOOTER'];
				?>
			</div>
	</body>
</html>