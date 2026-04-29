<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados do Usuário - MVC</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Informações do Usuário</h2>
            <div class="data-display">
                <p><strong>Nome:</strong> <?= htmlspecialchars($usuario['nome']) ?></p>
                <p><strong>E-mail:</strong> <?= htmlspecialchars($usuario['email']) ?></p>
                <p><strong>Senha:</strong> <?= htmlspecialchars($usuario['senha']) ?></p>
            </div>
            
            <div class="button-group" style="margin-top: 20px;">
                <a href="index.php?action=index" class="btn primary">Preencher novo usuário</a>
            </div>
        </div>
    </div>
</body>
</html>