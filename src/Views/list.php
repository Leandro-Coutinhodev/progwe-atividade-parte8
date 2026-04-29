<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function editar(id){
            const form = document.getElementById("Frm");
            form.action = "index.php?action=editar&id=" + id;
            form.method = "POST";
            form.submit();
        }

        function deletar(id){
            if(confirm("Deseja mesmo excluir este usuário?")){
            const form = document.getElementById("Frm");
            form.action = "index.php?action=deletar&id=" + id;
            form.method = "POST";
            form.submit();
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <div class= "card">
            <h2>Lista de Usuários</h2>
            <h3>Bem vindo, <?php echo $_SESSION['usuario_access']['nome'];?></h3>

            <?php if (isset($erro) && $erro): ?>
                <div class="alert error"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>

            <form id="Frm" method="POST">
            
                <table border="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>EMAIL</th>
                            <th colspan="2">AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $usuarios = Usuario::list();
                            foreach ($usuarios as $usuario){
                                echo "
                                
                                <tr>
                                <td>{$usuario['id']}</td>
                                <td>{$usuario['nome']}</td>
                                <td>{$usuario['email']}</td>
                                <td><button onclick='editar({$usuario['id']})'>✏️</button></td>
                                <td><button onclick='deletar({$usuario['id']})'>❌</button></td>
                                </tr>
                                ";
                            }
                        ?>
                    </tbody>
                </table>

            </form>
        </div>
    </div>
</body>

</html>

