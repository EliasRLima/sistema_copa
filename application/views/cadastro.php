<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html class="no-js">
	<head>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/background.css">
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/form.css">
                <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/efeito-botao.js"></script>
                <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/jquery.js"></script>
                <script type = 'text/javascript' src = "<?php echo base_url(); ?>js/jquery-mask.js"></script>
        <script>
                var options = {
                        onKeyPress: function (cpf, ev, el, op) {
                                var masks = ['000.000.000-000', '00.000.000/0000-00'];
                                $('#usercopa').mask((cpf.length > 14) ? masks[1] : masks[0], op);
                        }
                }
                $('#usercopa').length > 11 ? $('#usercopa').mask('00.000.000/0000-00', options) : $('#usercopa').mask('000.000.000-00#', options);
        </script>
	</head>
        <body class="center-form">
                <div class="center2-form">
                        <form id="login" method="POST" action="incluir" class="form">
				            <input type="text" name="usercopa" id="usercopa" value="<?php echo $cpf;?>" placeholder="CPF ou CNPJ..." autofocus/>
                            <input type="text" name="nome" id="nome" value="<?php echo $nome;?>" placeholder="Nome..."/>
                            <input type="text" name="sobrenome" id="sobrenome" value="<?php echo $sobrenome;?>" placeholder="Sobrenome..."/>
                            <input type="text" name="email" id="email" value="<?php echo $email;?>" placeholder="Email..."/>
				            <input type="password" name="pass" id="pass" value="" placeholder="Senha..."/>
                            <input type="password" name="passconfirm" id="passconfirm" value="" placeholder="Confirme sua senha..."/>
                            <a href="acesso/login" class="btn btn-secondary btn-sm">Voltar</a>
				            <input class="btn btn-primary" type="submit" id="bntEfeito1" name="bntEfeito1" value="CADASTRAR" onmouseover = "efeito1()" onmouseout="retirar_efeito1()" />		
                            <?php 
				                if($this->session->userdata('key_fail') == "cpfcnpj"){
				                    echo '<label class="cx-label" style="color: red; font-size: 14px;top: 30%;"></br>ESSE CPF JA FOI CADASTRADO!<a class="btn btn-warning btn-sm" style="left: 20%;color: black;" >recuperar a senha</a></label>';
					                $this->session->set_userdata('key_fail', '');
				                }else if($this->session->userdata('key_fail') == "pass"){
				                    echo '<label class="cx-label" style="color: red; font-size: 14px;top: 30%;"></br>SENHAS DIVERGENTES</label>';
					                $this->session->set_userdata('key_fail', '');
				                }else if($this->session->userdata('key_fail') == "invalid"){
				                    echo '<label class="cx-label" style="color: red; font-size: 14px;top: 30%;"></br>CPF OU CNPJ invalido.</label>';
					                $this->session->set_userdata('key_fail', '');
				                }else if($this->session->userdata('key_fail') == "bd"){
				                    echo '<label class="cx-label" style="color: red; font-size: 14px;top: 30%;"></br>Falha ao inserir no banco de dados.</label>';
					                $this->session->set_userdata('key_fail', '');
				                }else if($this->session->userdata('key_fail') == "sucess"){
				                    echo '<label class="cx-label" style="color: green; font-size: 14px;top: 30%;"></br>Cadastro efetuado.</label>';
					                $this->session->set_userdata('key_fail', '');
				                }
	                        ?>
                        </form>
                </div>
	</body>
</html>