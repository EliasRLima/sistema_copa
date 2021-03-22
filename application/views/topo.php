<!DOCTYPE html>
<html>
	<head>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/topo.css">
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/bootstrap/bootstrap.css">
		<title>COPA!</title>
	</head>
	<body>	
		<div class="topo">
			<div class="topo-esquerda">
				<!--<p class="display-4">Sistema de Controle de Patentes</p>-->
			</div>
			
			<div class="topo-direita">
				
				<?php 
				   if($this->session->has_userdata('LOGIN')){
				?>
				    <a href="logoff" class="btn btn-outline-primary espaco">SAIR</a> 
				<?php 
				   }else{
					   if(isset($login)){
						?>
							<a href="../menu" class="btn btn-dark btn-sm espaco">in&iacute;cio</a>
							<a href="../sobre" class="btn btn-dark btn-sm espaco">sobre</a>
						<?php
					   }else{
						?>
							<a href="menu" class="btn btn-dark btn-sm espaco">in&iacute;cio</a>
							<a href="sobre" class="btn btn-dark btn-sm espaco">sobre</a>
							<a href="acesso/login" class="btn btn-outline-primary espaco">LOGIN</a> 
						<?php
					   }
				
				   }
				?>
				
			</div>
		</div>
	</body>
</html>