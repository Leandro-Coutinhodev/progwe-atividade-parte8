<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class= "card">
            <h2>Login</h2>

            <?php if (isset($erro) && $erro): ?>
                <div class="alert error"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>

            <form action="index.php?action=auth" method="POST">
            
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Ex: joao.silva@email.com">    
                </div>

                <div class="input-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" placeholder="Digite a sua senha">    
                </div>

                <button type="submit" class="btn primary">Enviar Dados</button>

            </form>
        </div>
    </div>
</body>

</html>

