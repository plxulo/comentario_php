<?php

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<style>
    .--certo {
        background-color: lightgreen;
    }
    
    .--errado {
        background-color: lightcoral;
    }
</style>
<body>

    <div align="left">
       <a href="../admin/login_admin.php">Área do Administrador</a>
    </div>

    <main align="center">
        <div class="banner">
            <h1>Cadastro</h1>
        </div>

        <!-- Formulário de cadastro -->
        <form action="inserir_usuario.php" method="POST" style="display: flex; flex-direction: column; align-items: center; justify-content: space-between">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" required="">
            <br>
            <label for="email">Email</label>
            <input type="mail" name="email" id="email" required="">
            <br>
            <label for="rua">Rua</label>
            <input type="text" name="rua" id="rua" required="">
            <br>
            <label for="numero">Número</label>
            <input type="text" name="numero" id="numero" required="">
            <br>
            <label for="cep">CEP</label>
            <input type="text" name="cep" id="cep" onkeyup="validar_CEP()" required="">
            <br>
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" required="">
            <br>

            <!-- Enviar os dados do formulário -->
            <button type="submit">Enviar</button>
        </form>
        <a href="form.php">Já tenho conta</a>
    </main>    

</body>
<script>
    function validar_CEP() {
        expressao = /[0-9]{5}-[0-9]{3}$/g;
        texto = cep.value;
        resposta = expressao.test(texto); // RETORNA VALOR TRUE / FALSE

        // VERIFICA LARGURA DO TEXTO
        if (texto.length === 5) {
            cep.value = texto + '-';
        }
        if (resposta == true) {
            cep.classList.remove("--errado");
            cep.classList.add("--certo");
        }
        if (resposta == false) {
            cep.classList.remove("--certo")
            cep.classList.add("--errado")
        }
    }
</script>
</html>