<?php

require_once __DIR__ . '/../config/connection.php';
require_once __DIR__ . '/../Controllers/PromotorController.php';
require_once __DIR__ . '/../Controllers/EnderecoController.php';
require_once __DIR__ . '/../Controllers/DescricaoPessoalController.php';
require_once __DIR__ . '/../Controllers/FotoController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_FILES)) {
    $db = connectDatabase();

    // COMEÇAR TRANSACAO
    try {
        $db->beginTransaction();  // Inicia uma transação, desligando a auto-confirmação

        // Instanciando os controladores
        $promotorController = new PromotorController($db);
        $enderecoController = new EnderecoController($db);
        $descricaoPessoalController = new DescricaoPessoalController($db);
        $fotoController = new FotoController($db);

        // Dados do promotor
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];

        // Criando promotor e obter seu ID
        $promotorId = $promotorController->create($nome, $telefone, $email);


        // Dados de endereço
        $rua = $_POST['endereco'];
        $numero = $_POST['numero'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];

        // Criar endereço
        $enderecoController->create($promotorId, $rua, $numero, $bairro, $cidade, $estado);

        // Dados de descrição pessoal
        $altura = $_POST['altura'];
        $peso = $_POST['peso'];
        $sapato = $_POST['sapato'];
        $manequim = $_POST['manequim'];
        $apresenteSe = $_POST['apresenteSe'];

        // Criar descrição pessoal
        $descricaoPessoalController->create($promotorId, $altura, $peso, $sapato, $manequim, $apresenteSe);

        // Dados de fotos
        // variável que  direciona pra qual local/pasta serão armazenadas as fotos.
        $uploadsDir =  __DIR__ . "/../../public/fotosPromotores/{$promotorId}";

        // se o diretorio não existir é criado
        if (!file_exists($uploadsDir)) {
            mkdir($uploadsDir, 0777, true);
        }
        // é um objeto que permite trabalhar com arquivos
        // instanciando este objeto
        $finfo = new \finfo(FILEINFO_MIME);

        // PARA CADA FOTO, MOVER PARA A PASTA CORRETA E CADASTRAR NO BANCO (LOOP)
        for ($i = 1; $i <= 3; $i++) {
            $idFoto = "foto{$i}";

            if (isset($_FILES[$idFoto]) && $_FILES[$idFoto]['error'] == UPLOAD_ERR_OK) {
                $fotoTemp = $_FILES[$idFoto]['tmp_name'];
                $mimeType = $finfo->file($fotoTemp);


                // Validação do tipo de arquivo
                if (str_starts_with($mimeType, 'image/')) {
                    $novoNome = uniqid() . '_' . pathinfo($_FILES[$idFoto]['name'], PATHINFO_BASENAME);

                    $sucesso = move_uploaded_file($fotoTemp, "$uploadsDir/$novoNome");

                    if ($sucesso) {
                        $fotoController->create($promotorId, $novoNome);
                    }
                }
            }
        }

        // COMMITAR TRANSACAO
        $db->commit();
        // echo "Cadastro realizado com sucesso!";

        header('Location: /public/');
	    return;
    } catch (Exception $e) {
        $db->rollBack();  // Reconhece o erro e reverte as alterações
        echo "Falhou" . $e->getMessage();
    }
}
