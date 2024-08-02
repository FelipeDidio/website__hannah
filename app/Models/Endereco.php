<?php

require_once __DIR__ . '/../Models/Promotor.php';

class Endereco
{
    private $id;
    private $promotorId;
    private $rua;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;


    public function __construct($id, $promotorId, $rua, $numero, $bairro, $cidade, $estado)
    {
        $this->id = $id;
        $this->promotorId = $promotorId;
        $this->rua = $rua;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
    }

    public function id()
    {
        return $this->id;
    }

    public function promotorId()
    {
        return $this->promotorId;
    }

    public function rua()
    {
        return $this->rua;
    }

    public function numero()
    {
        return $this->numero;
    }

    public function bairro()
    {
        return $this->bairro;
    }
    public function cidade()
    {
        return $this->cidade;
    }

    public function estado()
    {
        return $this->estado;
    }
}
