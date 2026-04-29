<?php
if($_GET['action'] == 'editar') {
    if(!isset($_SESSION['usuario_access'])){
        $_SESSION['erro'] = "Você não tem permissão para acessar esta página";
        header('Location: index.php?action=index');
        exit;
    }
}
?>
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
                    <label for="email">Cpf:</label>
                    <input type="text" id="cpf" name="cpf" placeholder=""
                    <?php
                    if(isset($_SESSION['usuario_edit'])){
                        echo "value='{$_SESSION['usuario_edit']['cpf']}'";
                    }
                    ?>
                    oninput="mascaraCPF(this)"
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
                <?php
                if($_GET['action'] == 'new'){
                    echo "<a href='index.php?action=index'>Já possui cadastro?Faça seu login.</a>";
                }
                ?>
            </form>
        </div>
    </div>

    <script>
        function mascaraCPF(input) {
            let valor = input.value;

            // remove tudo que não é número
            valor = valor.replace(/\D/g, '');

            // limita a 11 dígitos
            valor = valor.substring(0, 11);

            // aplica a máscara
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

            input.value = valor;
        }
    </script>
</body>

</html>

