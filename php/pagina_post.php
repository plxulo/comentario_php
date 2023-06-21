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

        <!-- Exibir posts: -->
        <div style="display:flex; flex-direction:column; width: 25%; text-align:left">
            <?php
                // Recebe o valor da URL definido no index.php por meio do $_GET (está na URL né) e passa o valor para a variável $id_post:
                $id_post = $_GET["id"];
                $_SESSION["id_post"] = $id_post;
                // Utilizando o ID recebido realizamos uma consulta no banco de dados!
                $selecionar_posts = $pdo->prepare
                ("SELECT app_posts.*, usuarios_admin.nome
                FROM app_posts INNER JOIN usuarios_admin
                ON app_posts.id_admin = usuarios_admin.id
                WHERE app_posts.id = :id
                ");
                $selecionar_posts->bindValue(":id", $id_post);
                $selecionar_posts->execute();
                $post = $selecionar_posts->fetch();

                if ($post)
                {
                    $id_post = $post["id"];
                    $titulo = $post["titulo"];
                    $nome_admin = $post["nome"];
                    $conteudo = $post["conteudo"];
                    $imagem = $post["imagem"];
                    $i = base64_encode($imagem);

                    // Cada DIV é um post:
                    echo("<div>");
                        echo("<h3 style='margin-bottom:0'>" . $titulo . "</h3>");
                        echo("<p style='margin-top:0'>Criador: " . $nome_admin . "</p>");
                        echo("<br>");
                        echo("<img src='data:image/jpeg;base64," . $i . "' style='width:100%; height:auto;' alt='Imagem do post'>");
                        echo("<br>");
                        echo("<p style='margin-top:0'>" . $conteudo . "</p>");
                    echo("</div>");
                }
                else
                {
                    echo("<p>Nenhum post no momento.</p>");
                }

            ?>
            <div aria-label="Avaliação">
                <label for="avaliacao">Avalie este post:</label>
                <input type="range" min="0" max="5" id="slider" step="1">
                <p id="slider_value">Valor:</p>
            </div>
            <div style="display:flex; flex-direction:column; align-items:left">
                <!-- Formulário de comentários: -->
                <form action="processar_comentario.php" method="POST" class="frm_comentario" style="text-align: left;">
                    <label class="texto_formulario" for="nome">Nome:</label><br>
                    <input type="text" class="frm_nome" name="frm_nome" id="nome">
                    <br>
                    <label class="texto_formulario" for="email">Email:</label><br>
                    <input type="text" class="frm_email" name="frm_email" id="email">
                    <br>
                    <label class="texto_formulario" for="comentario">Comentário:</label><br>
                    <input type="text" class="frm_comentario" name="frm_comentario" id="comentario">
                    <br>
                    <input type="submit" name="frm_submit" id="frm_submit" class="frm_submit" value="Comentar">
                </form>
                <button onclick="abrir_agendamento();">Faça um agendamento!</button>
            </div>

            <div>
                <!-- Exibir comentários: -->
                <?php
                    // Selecionar o nome do usuário que enviou comentário por chave estrangeira:
                    $selecionar_comentario = $pdo->prepare
                    ("SELECT app_comentarios.*, usuarios.nome 
                    FROM app_comentarios INNER JOIN usuarios 
                    ON app_comentarios.id_usuario = usuarios.id 
                    WHERE app_comentarios.id_post = :id_post
                    ");
                    $selecionar_comentario->bindValue(":id_post", $id_post);
                    $selecionar_comentario->execute();

                    if($selecionar_comentario->rowCount() == 0)
                    {
                        echo("<p>Nenhum comentário no momento.</p>");
                    }
                    else
                    {
                        while($row_comentario = $selecionar_comentario->fetch())
                        {
                            // Caso deseje exibir o nome do usuário na sessão sem definir
                            // Uma entrada de input "nome" para o mesmo, utilize a tabela e sessão.
                            $nome = $row_comentario["nome"];

                            // Nesse caso, como eu possuo uma entrada para o nome e desejo exibir
                            // O nome de cada entrada, eu utilizarei o seguinte código
                            // Para atribuir o valor da entrada nome para a variável e exibi-lá:
                            $comentario = $row_comentario["comentario"];

                            echo("<h2 style='margin-bottom:0'>" . $nome . "</h2>");
                            echo("<br>");
                            echo("<p style='margin-top:0'>" . $comentario . "</p>");
                        }
                    }
                ?>
            </div>
        </div>
    </main>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  var slider = document.getElementById("slider");
  var sliderValue = document.getElementById("slider_value");

  // Atualiza o valor do slider
  slider.addEventListener("input", function() {
    sliderValue.textContent = "Valor: " + slider.value;
  });

  function abrir_agendamento() {
    window.open("agendamento.php");
  }

    $(document).ready(function() {
    $('#slider').on('input', function() {
        var valorSlider = $(this).val();

        // Envie o valor do slider para o script PHP usando uma solicitação AJAX
            $.ajax({
                url: 'inserir_valor.php',
                method: 'POST',
                data: { valorSlider: valorSlider },
                success: function(response) {
                    console.log(response);
                    // Faça algo com a resposta do servidor, se necessário
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    // Lide com erros, se ocorrerem
                }
            });
        });
    });

</script>
</html>