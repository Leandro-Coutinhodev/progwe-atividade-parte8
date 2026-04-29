<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class= "card">
            <h2><?php 
                if(isset($_GET['id']))
                    echo "Editar Usuário";
                else
                    echo "Cadastro de Usuário";
                ?>
                    </h2>

            <?php if (isset($erro) && $erro): ?>
                <div class="alert error"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>
            <?php
            if (isset($_GET['id'])){
                $id = $_GET['id'];
                $usuario = Usuario::listById($id);
                $_SESSION['usuario_edit'] = $usuario;
            } ?>

            <form action="index.php?action=store<?php 
            if (isset($_GET['id']))
                echo "&id={$_GET['id']}";?>" method="POST">
                <div class="input-group">
                    <label for="nome">Nome Completo:</label>
                    <input type="text" id="nome" name="nome" placeholder="Ex: João Silva" 
                    <?php 
                    if(isset($_SESSION['usuario_edit'])){
                        echo "value='{$_SESSION['usuario_edit']['nome']}'";
                    }
                    ?>>
                </div>

                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Ex: joao.silva@email.com"
                    <?php
                    if(isset($_SESSION['usuario_edit'])){
                        echo "value='{$_SESSION['usuario_edit']['email']}'";
                    }
                    ?>
                    >    
                </div>

                <div class="input-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha"
                    <?php
                    if(isset($_SESSION['usuario_edit'])){
                        echo "value='{$_SESSION['usuario_edit']['senha']}'";
                    }
                    ?>>    
                </div>

                <button type="submit" class="btn primary">Enviar Dados</button>

            </form>
        </div>
    </div>
</body>

</html>

