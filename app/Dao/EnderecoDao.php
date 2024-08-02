<?php

require_once __DIR__ .  '/../config/connection.php';
require_once __DIR__ .  '/../Models/Endereco.php';

class EnderecoDAO
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function create(Endereco $endereco)
    {
        $sql = "INSERT INTO endereco (promotor_id, rua, numero, bairro, cidade, estado) VALUES (:promotor_id, :rua, :numero, :bairro, :cidade, :estado)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":promotor_id", $endereco->promotorId());
        $stmt->bindValue(":rua", $endereco->rua());
        $stmt->bindValue(":numero", $endereco->numero());
        $stmt->bindValue(":bairro", $endereco->bairro());
        $stmt->bindValue(":cidade", $endereco->cidade());
        $stmt->bindValue(":estado", $endereco->estado());

        return $stmt->execute();
    }

    public function read(int $promotor_id)
    {
        $sql = "SELECT * FROM endereco WHERE promotor_id = :promotor_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":promotor_id", $promotor_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $endereco = new Endereco($row['id'], $row['promotor_id'], $row['rua'], $row['numero'], $row['bairro'], $row['cidade'], $row['estado']);
            return $endereco;
        }
        return null;
    }
}
