<?php
    //Inicia a sessão para podermos guaradar os
    //dados do usuário temporariamente
    session_start();

    //Carrega as classes necessárias 
    //(em um projeto maior, usaríamos um Autoloader/Composer)
    require_once "../src/Models/Usuario.php";
    require_once "../src/Controllers/UsuarioController.php";

    
    //Define a ação padrão como index
    $action = $_GET['action'] ?? 'index';

    $controller = new UsuarioController();

    //Roteamento simples baseado na ação
    switch ($action) {
        case 'index':
            $controller->login();
            break;
        case 'new':
            $controller->index();
            break;
        case 'store':
            $controller->store();
            break;
        case 'success':
            $controller->success();
            break;
        case 'view':
            $controller->view();
            break;
        case 'auth':
            $controller->auth();
            break;
        case 'list':
            $controller->list();
            break;
        case 'editar':
            $controller->index();
            break;
        case 'deletar':
            $controller->delete();
            break;
        case 'logout':
            $controller->logout();
            break;
        default:
            $controller->index();
            break;
    }
?>

