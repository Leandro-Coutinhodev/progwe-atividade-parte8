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

        function logout(){
            if(confirm("Deseja mesmo encerrar a sessão?")){
                const form =document.getElementById("Frm");
                form.action = "index.php?action=logout";
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
            <h3>Você está logado como: <?php echo $_SESSION['usuario_access']['nome'];?></h3>

            <?php if (isset($erro) && $erro): ?>
                <div class="alert error"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>

            <form id="Frm" method="POST">
            
                <table>
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
                                <td><button class='btn secundary' onclick='editar({$usuario['id']})'>✏️</button></td>
                                <td><button class='btn secundary' onclick='deletar({$usuario['id']})'>❌</button></td>
                                </tr>
                                ";
                            }
                        ?>
                    </tbody>
                </table>
                <button type="submit" class="btn primary" onclick="logout()">Logout</button>

            </form>
        </div>
    </div>
</body>

</html>

