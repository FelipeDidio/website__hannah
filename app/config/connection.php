<?php

function connectDatabase()
{
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "hannahrh";
    $dsn = "mysql:host=$servername;dbname=$dbname";


    // Tentando criar uma nova instância de PDO para a conexão
    $pdo = new PDO($dsn, $username, $password);

    // Configurando o modo de erro do PDO para exceção
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Se a conexão for bem-sucedida, retorna objeto PDO.
    return $pdo;
}
