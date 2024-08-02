<?php

require_once __DIR__ . '/../Dao/DescricaoPessoalDao.php';

class DescricaoPessoalController
{
    private $descricaoPessoalDAO;

    public function __construct($db)
    {
        $this->descricaoPessoalDAO = new DescricaoPessoalDao($db);
    }

    public function create($promotorId, $altura, $peso, $sapato, $manequim, $apresenteSe)
    {
        $descricaoPessoal = new DescricaoPessoal(null, $promotorId, $altura, $peso, $sapato, $manequim, $apresenteSe);
        return $this->descricaoPessoalDAO->create($descricaoPessoal);
    }

    public function read($promotorId)
    {
        return $this->descricaoPessoalDAO->read($promotorId);
    }
}
