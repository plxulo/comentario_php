<?php
    include("conexao.php");
    session_start();

    if((!isset ($_SESSION['usuario']) == true) and (!isset ($_SESSION['senha']) == true))
    {
      header('location: login_usuario.php');
    }

    $logado = $_SESSION["usuario"];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>

<body>

    <main style="display:flex; flex-direction:column; align-items:center">
        <div class="banner" style="display:flex; flex-direction:column; align-items:center">
            <h1>Olá, <?php echo $logado; ?>!</h1>
            <div align="center">
                <a href="index.php"><-Voltar</a>
                <a href="../admin/login_admin.php">Área do Administrador</a>
                <a href="logout.php">Sair</a>
            </div>
        </div>
        <div style="display:flex; flex-direction:column;align-items:left">
            <form>
                <input type="text" placeholder="Seu nome" name="frm_usuario">
                <br>
                <input type="email" placeholder="Email" name="frm_email">
                <br>
                <input type="date">
                <br>
                <select onchange="exibirImagemFuncionario(this.value);" id="selecionar_func">
                    <?php

                        $selecionar_func = $pdo->prepare("SELECT * FROM funcionarios");
                        $selecionar_func->execute();

                        if($selecionar_func->rowCount() > 0)
                        {
                            $row = $selecionar_func->fetch();
                            $imagem_funcionario = $row["imagem"];
                            $i = base64_encode($imagem_funcionario);
                            while($linhas_func = $selecionar_func->fetch())
                            {
                                $nome_func = $linhas_func["nome"];
                                $id_func = $linhas_func["id"];
                                echo("<option value='$id_func'> Funcionário: " . $nome_func);
                            }
                        }
                        else
                        {
                            echo("<option>Nenhum funcionário cadastrado</option>");
                        }
                    ?>
                </select>
            </form>
            <div id="imagemFuncionario" width="200px" height="200px"></div>
        </div>
    </main>

</body>
<script>

    function exibirImagemFuncionario(idFuncionario) {
        // Atualize o caminho da requisição AJAX para apontar para o script PHP criado
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Crie um elemento de imagem e defina o caminho como o script PHP
                    var imagem = document.createElement('img');
                    imagem.src = 'exibir_imagem.php?id=' + idFuncionario;

                    // Limpe o conteúdo anterior e adicione a nova imagem na div correspondente
                    var imagemFuncionario = document.getElementById("imagemFuncionario");
                    imagemFuncionario.innerHTML = '';
                    imagemFuncionario.appendChild(imagem);
                }
            }
        };

        xhr.open("GET", "exibir_imagem.php?id=" + idFuncionario, true);
        xhr.send();
    }
</script>
</html>