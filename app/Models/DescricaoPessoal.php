<?php

require_once __DIR__ . '/../Models/Promotor.php';

class DescricaoPessoal
{
    private $id;
    private $promotorId;
    private $altura;
    private $peso;
    private $sapato;
    private $manequim;
    private $apresenteSe;

    function __construct($id, $promotorId, $altura, $peso, $sapato, $manequim, $apresenteSe)
    {
        $this->id = $id;
        $this->promotorId = $promotorId;
        $this->altura = $altura;
        $this->peso = $peso;
        $this->sapato = $sapato;
        $this->manequim = $manequim;
        $this->apresenteSe = $apresenteSe;
    }

    public function id()
    {
        return $this->id;
    }

    public function promotorId()
    {
        return $this->promotorId;
    }

    public function altura()
    {
        return $this->altura;
    }

    public function peso()
    {
        return $this->peso;
    }

    public function sapato()
    {
        return $this->sapato;
    }

    public function manequim()
    {
        return $this->manequim;
    }

    public function apresenteSe()
    {
        return $this->apresenteSe;
    }
}
