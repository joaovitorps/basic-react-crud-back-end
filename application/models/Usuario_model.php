<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario_model extends CI_Model
{
    private $tabela = 'usuario';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function obter($id = null)
    {
        if (isset($id)) {
            $this->db->where('id', $id);
            $dados = $this->db->get($this->tabela)->row_array();
        } else {
            $dados = $this->db->get($this->tabela)->result_array();
        }

        return $dados;
    }

    public function inserir($dados = [])
    {
        $itemInserido = $this->db->insert($this->tabela, $dados);
        return $itemInserido;
    }

    public function editar($dados = [], $id = 0)
    {
        $this->db->set($dados);
        $this->db->where('id', $id);
        $foiEditado = $this->db->update($this->tabela);

        return $foiEditado;
    }

    public function deletar($id = 0)
    {
        $this->db->where('id', $id);
        $foiDeletado = $this->db->delete($this->tabela);

        return $foiDeletado;
    }
}
