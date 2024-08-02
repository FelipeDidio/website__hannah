<?php

require_once __DIR__ . '/../config/connection.php';
require_once __DIR__ . '/../Models/DescricaoPessoal.php';

class descricaoPessoalDAO
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create(DescricaoPessoal $descricaoPessoal)
    {
        $sql = "INSERT INTO descricao_pessoal (promotor_id, altura, peso, sapato, manequim, apresenteSe) VALUES (:promotor_id, :altura, :peso, :sapato, :manequim, :apresenteSe)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":promotor_id", $descricaoPessoal->promotorId());
        $stmt->bindValue(":altura", $descricaoPessoal->altura());
        $stmt->bindValue(":peso", $descricaoPessoal->peso());
        $stmt->bindValue(":sapato", $descricaoPessoal->sapato());
        $stmt->bindValue(":manequim", $descricaoPessoal->manequim());
        $stmt->bindValue(":apresenteSe", $descricaoPessoal->apresenteSe());

        return $stmt->execute();
    }

    public function read(int $promotor_id)
    {
        $sql = "SELECT * FROM descricao_pessoal WHERE promotor_id = :promotor_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":promotor_id", $promotor_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $descricaoPessoal = new DescricaoPessoal($row['id'], $row['promotor_id'], $row['altura'], $row['peso'], $row['sapato'], $row['manequim'], $row['apresenteSe']);

            return $descricaoPessoal;
        }
        return null;
    }
}
