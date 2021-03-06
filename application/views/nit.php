<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html class="no-js">
	<head>
        <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/bootstrap/bootstrap.css">
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/background.css">
        <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/pesquisador.css">
	</head>
	<body>
           <div class="pesquisador-esquerda">
                <h2>Bem vindo(a), <?php echo $identificador; ?>!</h2>
                <img src="<?php echo base_url('images/anonimo.jpg'); ?>" /></br>
                <a href="?area=1" class="btn btn-primary btn-lg btn-block">Liberar Patente</a> 
                <a href="?area=2" class="btn btn-primary btn-lg btn-block">Requisitar Ajuste</a>
                <a href="?area=3" class="btn btn-primary btn-lg btn-block">Revogar Patente</a></br></br>
                <a href="acesso/logoff" class="btn btn-danger btn-block" style="margin-top: 30%;">SAIR</a> 

           </div>

           <div class="pesquisador-direita">
               <?php
                  if($aviso != null){
                    ?>
                        <div class="aviso">
                            <button type="button" class="btn btn-warning" disabled>Fique atento!</button>
                            <div class="alert alert-danger" role="alert">
                                        A solicitacao da patente <a href="" class="alert-link">NOME PATENTE</a> vence em 4 dias.
                            </div>
                            
                        </div>
                    <?php
                  }
               ?>

               <div class="pesquisador-direita-livre">
                    <div class="relatorio">
                        <?php
                            if($area == 1){
                                //area de cadastro nova patente
                                ?>
                                    <form id="ajuste" method="POST" action="patente/solicitar" class="p-3 mb-2 bg-dark text-white">
                                        <h3 style="color: #007bff">Enviar patente para aprovacao</h3></br>
                                        <div class="form-group">
                                            <label for="idaprovar">Selecione a patente</label>
                                            <select class="form-control" id="idaprovar" name="idaprovar">
                                                <?php
                                                    echo $solicitacoes;
                                                ?>
                                            </select>
                                        </div>
				                        <input class="btn btn-primary" type="submit" id="bntEfeito1" name="bntEfeito1" value="SELECIONAR" onmouseover = "efeito1()" onmouseout="retirar_efeito1()" />
                                    </form>

                                    <?php
                                        if($selecionado == true){
                                            ?>
                                            <form id="cadastro" method="POST" action="processo/aprovar" class="p-3 mb-2 bg-dark text-white">
                                                <input type="hidden" id="idsolicitacao" name="idsolicitacao" value="<?php echo $patente['idsolicitacao'];?>" /> 
                                                <h3 style="color: #007bff">Patente</h3></br>
				                        
                                                 <div class="form-group">
                                                    <label for="patente_name">Nome da patente</label>
                                                    <input type="text" class="form-control" name="patente_name" id="patente_name" value="<?php echo $patente['nome'];?>" maxlength="100" placeholder="Digite o nome da patente..." disabled/>
                                                 </div>
                                                <div class="form-group">
                                                    <label for="patente_tipo">Tipo da patente</label>
                                                    <select class="form-control" id="patente_tipo" name="patente_tipo" disabled>
                                                        <option value="-1"><?php echo $patente['tipo'];?></option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="patente_descricao">Resumo descritivo</label>
                                                    <textarea class="form-control" id="patente_descricao" name="patente_descricao" rows="10" value="oi" disabled><?php echo $patente['descricao'];?></textarea>
                                                </div>
                                                <a href="processo/recusar?id=<?php echo $patente['idsolicitacao'];?>" class="btn btn-danger btn-sm">Recusar</a>
				                                <input class="btn btn-primary" type="submit" id="bntEfeito1" name="bntEfeito1" value="APROVAR" onmouseover = "efeito1()" onmouseout="retirar_efeito1()" />		
                                            </form>
                                    <?php
                                        }
                                    ?>
                                    
                        
                                <?php 
				                    if($this->session->userdata('key_fail') == "name"){
				                        echo '<label class="cx-label" style="color: red; font-size: 14px;top: 30%;"></br>Ja existe uma patente com esse nome!</label>';
					                    $this->session->set_userdata('key_fail', '');
				                    }else if($this->session->userdata('key_fail') == "sucess"){
                                        echo '<label class="cx-label" style="color: green; font-size: 14px;top: 30%;"></br>Cadastro efetuado.</label>';
                                        $this->session->set_userdata('key_fail', '');
                                    }else if($this->session->userdata('key_fail') == "fail"){
                                        echo '<label class="cx-label" style="color: red; font-size: 14px;top: 30%;"></br>Ouve uma falha ao salvar patente!</label>';
					                    $this->session->set_userdata('key_fail', '');
                                    }
                            }else if($area == 2){
                                echo "requisitar";
                            }else if($area == 3){
                                echo "revogar";
                            }else{
                                //tela inicial
                                $status = $this->session->flashdata('status');
                                if($status == 'rep'){
                                    ?>
                                        <div class="alert alert-primary" role="alert">
                                            A patente foi recusada.
                                        </div>
                                    <?php
                                }else if($status == 'apv'){
                                    ?>
                                        <div class="alert alert-success" role="alert">
                                            A patente foi aprovada.
                                        </div>
                                    <?php
                                }
                                echo "Bem vindo(a)!";
                            }
                        ?>
                    </div>
               </div>
               
           </div> 
	</body>
</html>