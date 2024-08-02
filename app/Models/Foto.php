<?php

require_once __DIR__ . '/../Models/Promotor.php';

class Foto
{
    private $id;
    private $promotorId;
    private $fotoPath;

    public function __construct($id, $promotorId, $fotoPath)
    {
        $this->id = $id;
        $this->promotorId = $promotorId;
        $this->fotoPath = $fotoPath;
    }

    public function id()
    {
        return $this->id;
    }

    public function promotorId()
    {

        return $this->promotorId;
    }

    public function fotoPath()
    {
        return $this->fotoPath;
    }
}
