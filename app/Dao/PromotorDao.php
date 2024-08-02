<?php

require_once __DIR__ . '/../config/connection.php';
require_once __DIR__ . '/../Models/Promotor.php';

class PromotorDao
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Método que insere e cria promotor no banco de dados.
    public function create(Promotor $promotor)
    {
        $query = "INSERT INTO promotor (nome, telefone, email) VALUES (:nome, :telefone, :email)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":nome", $promotor->nome());
        $stmt->bindValue(":telefone", $promotor->telefone());
        $stmt->bindValue(":email", $promotor->email());

        //return $stmt->execute();
        //solução sugerida pelo chat gpt
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    // Método que lista promotores do Banco de dados.
    public function read()
    {
        $query = "SELECT * FROM promotor";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $promotores = [];

        foreach ($result as $row) {
            $promotor = new Promotor($row['id'], $row['nome'], $row['telefone'], $row['email']);
            $promotores[] = $promotor;
        }

        return $promotores;
    }
}
