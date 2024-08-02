<?php

require_once __DIR__ . '/../Models/Endereco.php';
require_once __DIR__ . '/../Dao/EnderecoDao.php';

class EnderecoController
{
    private $enderecoDAO;

    public function __construct($db)
    {
        $this->enderecoDAO = new EnderecoDao($db);
    }

    public function create($promotorId, $rua, $numero, $bairro, $cidade, $estado)
    {
        $endereco = new Endereco(null, $promotorId, $rua, $numero, $bairro, $cidade, $estado);
        return $this->enderecoDAO->create($endereco);
    }

    public function read($promotorId)
    {
        return $this->enderecoDAO->read($promotorId);
    }
}
