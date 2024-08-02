<?php

require_once __DIR__ .  '/../config/connection.php';
require_once __DIR__ .  '/../Models/Foto.php';

class fotoDAO
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create(Foto $foto)
    {
        $sql = "INSERT INTO foto(promotor_id, foto_path) VALUES (:promotor_id, :foto_path)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":promotor_id", $foto->promotorId());
        $stmt->bindValue(":foto_path", $foto->fotoPath());

        return $stmt->execute();
    }

    public function read($promotorId)
    {
        $query = "SELECT * FROM foto WHERE promotor_id = :promotor_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":promotor_id", $promotorId);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $fotos = [];

        foreach ($result as $row) {
            $foto = new Foto($row['id'], $row['promotor_id'], $row['foto_path']);
            $fotos[] = $foto;
        }

        return $fotos;
    }
}
