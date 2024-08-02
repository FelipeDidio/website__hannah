<?php

require_once __DIR__ .  '/../Dao/PromotorDao.php';
require_once __DIR__ .  '/../Models/Promotor.php';

class PromotorController
{
    private $promotorDAO;

    public function __construct($db)
    {
        $this->promotorDAO = new PromotorDao($db);
    }

    public function create($nome, $telefone, $email)
    {
        $promotor = new Promotor(null, $nome, $telefone, $email);
        $id = $this->promotorDAO->create($promotor);
        if ($id) {
            return $id;
        } else {
            return null;
        }
    }

    public function read()
    {
        return $this->promotorDAO->read();
    }
}
