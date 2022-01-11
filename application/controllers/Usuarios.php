<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuario_model', 'usuario');
        $this->load->library('upload');
    }

    public function index()
    {
        $usuarios = $this->usuario->obter();

        echo json_encode($usuarios, JSON_PRETTY_PRINT);
    }

    public function obter($id)
    {
        $usuarios = $this->usuario->obter($id);

        echo json_encode($usuarios, JSON_PRETTY_PRINT);
    }

    public function inserir()
    {
        $dados = json_decode(file_get_contents('php://input'), true);
        $usuario = $this->usuario->inserir($dados);

        echo json_encode($usuario, JSON_PRETTY_PRINT);
    }

    public function uploadFoto()
    {
        $nomeArquivo = $this->input->post('foto');

        $configuracao = array(
            'upload_path'   => "./img",
            'allowed_types' => ['jpg', 'jpeg', 'png'],
            'file_name'     => $nomeArquivo,
            'max_size'      => '150',
            'max_filename_increment' => '0',
            'file_ext_tolower' => TRUE,
        );

        $this->upload->initialize($configuracao);

        if ($this->upload->do_upload('foto')) {
            echo json_encode(["erro" => false, "mensagem" => "Arquivo salvo com sucesso."]);
        } else {
            echo json_encode(["erro" => true, "mensagem" => $this->upload->display_errors()]);
        }
    }

    public function editar($id)
    {
        $dados = json_decode(file_get_contents('php://input'), true);
        $usuario = $this->usuario->editar($dados, $id);

        echo json_encode($usuario, JSON_PRETTY_PRINT);
    }

    public function deletar($id)
    {
        $usuario = $this->usuario->deletar($id);

        echo json_encode($usuario, JSON_PRETTY_PRINT);
    }
}
