<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_Patente extends CI_Model {

	public $title;
    public $content;
    public $date;

    public function getTipos()
        {
            error_reporting(0);
            $this->load->database();
            $sql = "SELECT `idtipo`, `descricao` FROM `tipo` ORDER BY `descricao` ASC";
            $query = $this->db->query($sql);
            $tipo['tipo'] = '';
            foreach ($query->result() as $row){
                $tipo['tipo'] .= '"<option value="'.$row->idtipo.'">'.$row->descricao.'</option>";';
            }
            return $tipo;		
            
        }

    public function getIdPatente($nome)
        {
            error_reporting(0);
            $this->load->database();
            $sql = "SELECT MAX(idPatente) as idPatente FROM patente WHERE nome = '".$nome."'";
            $query = $this->db->query($sql);
            $id = '';
            foreach ($query->result() as $row){
                $id = $row->idPatente;
            }
            return $id;;
        }

    public function getPatentesAjustes($cpf)
        {
            error_reporting(0);
            $this->load->database();
            $sql = "SELECT pj.idpatenteajuste, p.nome, pj.dtsolicitacao
                    FROM  patenteajuste pj,
                          usuario u,
                          patenteproprietario pp,
                          patente p
                    where pp.idusuario = u.idUsuario
                    and pp.idpatente = pj.idpatente
                    and u.cpfcnpj = '".$cpf."'
                    and pj.status = 1
                    and p.idPatente = pj.idpatente
                    and p.dtfim is null
                    order by pj.dtsolicitacao asc";
            $query = $this->db->query($sql);
            $ajuste['ajuste'] = '';
            //$ajuste['ajuste'] .= '"<option value="14">Jogo de cartas (até DD/MM/YYYY)</option>";';
            foreach ($query->result() as $row){
                $ajuste['ajuste'] .= '"<option value="'.$row->idpatenteajuste.'">'.$row->nome.' (até '.$row->dtsolicitacao.')</option>";';
            }
        return $ajuste;		
            
    }

    public function getPatentePorAjuste($idajuste)
    {
        error_reporting(0);
            $this->load->database();
            $sql = "SELECT pj.idpatenteajuste, 
                           pj.descricao, 
                           pj.dtsolicitacao, 
                           p.nome, 
                           p.situacao, 
                           p.descricao 
                    FROM patenteajuste pj,
                         patente p
                    WHERE pj.idpatenteajuste = ".$idajuste."
                    and pj.idpatente = p.idPatente";
            $query = $this->db->query($sql);
            $patente = null;
            foreach ($query->result() as $row){
                $data = array(
                    'ajuste' => $row->descricao,
                    'dtajuste' => $row->dtsolicitacao,
                    'patente' => $row->nome,
                    'situacao' => $row->situacao,
                    'descricao' => $row->descricao
                );
                return $data;
            }
            return $patente;		
    }

    public function getSolicitacoes()
        {
            error_reporting(0);
            $this->load->database();
            $sql = "SELECT ps.idsolicitacao, 
                           p.idPatente as idpatente, 
                           p.nome, 
                           p.situacao, 
                           p.descricao, 
                           t.descricao as tipo, 
                           ps.dtsolicitacao
                    FROM patentesolicitacao ps,
                         patente p,
                         tipo t
                    WHERE ps.idpatente = ps.idpatente
                    and ps.status = 1
                    and p.idtipo = t.idtipo
                    order by ps.dtsolicitacao ASC";
            $query = $this->db->query($sql);
            $novo['solicitacoes'] = '"<option value="-1">...</option>";';
            foreach ($query->result() as $row){
                $novo['solicitacoes'] .= '"<option value="'.$row->idsolicitacao.'">'.$row->nome.'</option>";';
            }
            return $novo;		
        }

    public function getSolicitacao($id)
        {
            error_reporting(0);
            $this->load->database();
            $sql = "SELECT ps.idsolicitacao, 
                           p.idPatente as idpatente, 
                           p.nome, 
                           p.situacao, 
                           p.descricao, 
                           t.descricao as tipo, 
                           ps.dtsolicitacao
                    FROM patentesolicitacao ps,
                         patente p,
                         tipo t
                    WHERE ps.idpatente = ps.idpatente
                    and ps.idsolicitacao = ".$id."
                    and ps.status = 1
                    and p.idtipo = t.idtipo
                    order by ps.dtsolicitacao ASC";
            $query = $this->db->query($sql);
            foreach ($query->result() as $row){
                $data = array(
                    'idsolicitacao' => $row->idsolicitacao,
                    'idpatente' => $row->idpatente,
                    'nome' => $row->nome,
                    'situacao' => $row->situacao,
                    'descricao' => $row->descricao,
                    'tipo' => $row->tipo,
                    'dtsolicitacao' => $row->dtsolicitacao
                );
                return $data;
            }
            $novo = array(
                'idsolicitacao' => null,
                'idpatente' => null,
                'nome' => null,
                'situacao' => null,
                'descricao' => null,
                'tipo' => null,
                'dtsolicitacao' => null
            );
            return $novo;	
        }

}