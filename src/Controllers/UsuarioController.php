<?php

class UsuarioController
{

    //Exibe o formulário de inicial
    public function index()
    {
        //Limpa possíveis mensagens de erro anteriores da sessão
        if ($_GET['action'] == 'new') {
            $erro = $_SESSION['erro'] ?? null;
            unset($_SESSION['erro']);
            require '../src/Views/form.php';

        }else{
            $erro = $_SESSION['erro'] ?? null;
            unset($_SESSION['erro']);

        require '../src/Views/forms.php';
        }
    }

    public function list()
    {
        if (isset($_SESSION['usuario_access'])) {
            $erro = $_SESSION['erro'] ?? null;
            unset($_SESSION['erro']);

            require '../src/Views/list.php';
        } else {
            $_SESSION['erro'] = "Você não tem permissão para acessar esta página";
            header('Location: index.php?action=index');
        }
    }

    public function logout()
    {
        if (isset($_SESSION['usuario_access'])) {
            session_destroy();
            header('Location: index.php?action=index');
            exit;
        }
    }

    public function login()
    {
        $erro = $_SESSION['erro'] ?? null;
        unset($_SESSION['erro']);

        require '../src/Views/login.php';
    }

    public function auth()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $senha = trim($_POST['senha'] ?? '');


            //Validação simples dos dados
            if (empty($email) || empty($senha)) {
                $_SESSION['erro'] = "Todos os campos são obrigatórios.";
                header("Location: index.php?action=index");
                exit;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['erro'] = "Email inválido.";
                header("Location: index.php?action=index");
                exit;
            }

            //Instancia o Model (cria o objeto Usuario)
            $usuario = Usuario::login($email, $senha);

            //Salva usando PDO no banco de dados
            if ($usuario) {
                $_SESSION['usuario_access'] = [
                    'id' => $usuario['id'],
                    'nome' => $usuario['nome'],
                    'email' => $usuario['email'],
                    'cpf' => $usuario['cpf']
                ];
                header("Location: index.php?action=list");
                exit;
            } else {
                $_SESSION['erro'] = "Email ou senha incorretos.";
                header("Location: index.php?action=index");
                exit;
            }

            // //Guarda o usuário na sessão para exibição após o cadastro
            // $_SESSION['usuario'] = [
            //     'nome' => $usuario->getNome(),
            //     'email' => $usuario->getEmail(),
            //     'senha' => $usuario->getSenha()
            // ];

            // //Redireciona para a página de sucesso
            // header("Location: index.php?action=success");
            // exit;
        }
    }

    public function delete()
    {
        $erro = $_SESSION['erro'] ?? null;
        unset($_SESSION['erro']);

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if (!Usuario::delete($id)) {
                $_SESSION['erro'] = "Erro ao deletar este registro.";
                header("Location: index.php?action=list");
                exit;
            } else {
                header("Location: index.php?action=list");
                exit;
            }
        }

    }

    //Processa os dados enviados pelo formulário
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $senha = trim($_POST['senha'] ?? '');
            $cpf = trim($_POST['cpf'] ?? '');


            //Validação simples dos dados
            if ((empty($nome) || empty($email) || empty($senha) || empty($cpf)) && isset($_GET['id'])) {
                $id = $_GET['id'];
                $_SESSION['erro'] = "Todos os campos são obrigatórios.";
                header("Location: index.php?action=editar&id={$id}");
                exit;
            } elseif ((empty($nome) || empty($email) || empty($senha) || empty($cpf))) {
                $_SESSION['erro'] = "Todos os campos são obrigatórios.";
                header("Location: index.php?action=new");
                exit;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL) && isset($_GET['id'])) {
                $id = $_GET['id'];
                $_SESSION['erro'] = "Email inválido.";
                header("Location: index.php?action=editar&id={$id}");
                exit;
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['erro'] = "Email inválido.";
                header("Location: index.php?action=new");
                exit;
            }

            $cpf = str_replace(['.', '-'], '', $cpf);

            //Instancia o Model (cria o objeto Usuario)
            $usuario = new Usuario($nome, $email, $senha, $cpf);

            if (isset($_GET['id'])) {
                if (isset($_SESSION['usuario_access'])) {

                    $id = $_GET['id'];

                    if (!$usuario->update($id)) {
                        $_SESSION['erro'] = "Erro ao atualizar usuário.";
                        header("Location: index.php?action=editar&id={$id}");
                        exit;
                    }

                } else {
                    $_SESSION['erro'] = "Você não tem permissão para esta ação.";
                    header('Location: index.php?action=index');
                    exit;
                }
                header("Location: index.php?action=list");

            } else {

                //Salva usando PDO no banco de dados
                if (!$usuario->save()) {
                    $_SESSION['erro'] = "Erro ao salvar no banco de dados.";
                    header("Location: index.php?action=new");
                    exit;
                }

                //Guarda o usuário na sessão para exibição após o cadastro
                $_SESSION['usuario'] = [
                    'nome' => $usuario->getNome(),
                    'email' => $usuario->getEmail(),
                    'senha' => $usuario->getSenha(),
                    'cpf' => $usuario->getCpf()
                ];

                //Redireciona para a página de sucesso
                header("Location: index.php?action=success");
                exit;
            }
        }
    }

    //Exibe a tela com as opções após o cadastro
    public function success()
    {
        //Se não houver usuário na sessão, volta para o início
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?action=new");
            exit;
        }

        require '../src/Views/success.php';
    }

    //Exibe os dados do usuário
    public function view()
    {
        //Se não houver usuário na sessão, volta para o início
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?action=new");
            exit;
        }

        $usuario = $_SESSION['usuario'];
        require '../src/Views/viewData.php';
    }

}

?>