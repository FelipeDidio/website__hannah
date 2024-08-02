<?php

require_once __DIR__ . '/../Dao/FotoDao.php';

class FotoController
{
    private $fotoDAO;

    public function __construct($db)
    {
        $this->fotoDAO = new FotoDao($db);
    }

    public function create($promotorId, $fotoPath)
    {
        $fotoObj = new Foto(null, $promotorId, $fotoPath);
        return $this->fotoDAO->create($fotoObj);
    }

    public function read($promotorId)
    {
        return $this->fotoDAO->read($promotorId);
    }
}
