<?php

require_once __DIR__ . '/../Database.php';

    class Usuario { 
        //Atributos privados para garantir o encapsulamento
        private $nome;
        private $email;
        private $senha;
        private $cpf;

        //Construtor para inicializar os atributos  
        public function __construct($nome, $email, $senha, $cpf) {
            $this->nome = $nome;
            $this->email = $email;
            $this->senha = $senha;
            $this->cpf = $cpf;
        }

        //Getters para acessar as propriedades de forma controlada
        public function getNome() {
            return $this->nome;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getSenha(){
            return $this->senha;
        }

        public function getCpf(){
            return $this->cpf;
        }

        //Salva o usuário no banco de dados usando PDO
        public function save(): bool {
            try {
                $pdo = Database::getConnection();
                $stmt = $pdo->prepare('INSERT INTO usuario (nome, email, senha, cpf) VALUES (:nome, :email, :senha, :cpf)');
                return $stmt->execute([
                    ':nome' => $this->nome,
                    ':email' => $this->email,
                    ':senha' => md5($this->senha),
                    ':cpf' => $this->cpf
                ]);
            } catch (PDOException $e) {
                return false;
            }
        }

        public static function login($email, $senha){
            try{
                $pdo = Database::getConnection();
                $passhash = md5($senha);
                $stmt = $pdo->prepare("SELECT id, nome, email FROM usuario WHERE email = :email AND senha = :senha");
                $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                $stmt->bindParam(":senha", $passhash, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                return $result;

            }catch (PDOException $e) {
                // var_dump($e);
                // die();
                return false;
            }
        }

        public static function list(){
            try{
                $pdo = Database::getConnection();
                $stmt = $pdo->query("SELECT id, nome, email FROM usuario;");
                $stmt->execute();
                $result = $stmt->fetchAll();

                return $result;

            }catch (PDOException $e) {
                return false;
            }
        }

        public static function listById($id){
            try{
                $pdo = Database::getConnection();
                $stmt = $pdo->prepare("SELECT * FROM usuario WHERE id = :id;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                return $result;
                
            }catch (PDOException $e) {
                return false;
            }
        }

        public function update($id){
            try{
                $pdo = Database::getConnection();
                $passhash = md5($this->senha);
                $stmt = $pdo->prepare("UPDATE usuario SET nome = :nome, email = :email, senha = :senha, cpf = :cpf WHERE id = :id;");
                $stmt->bindParam(":nome", $this->nome, PDO::PARAM_STR);
                $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
                $stmt->bindParam(":senha", $passhash, PDO::PARAM_STR);
                $stmt->bindParam(":cpf", $this->cpf, PDO::PARAM_STR);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();

                return true;
            }catch(PDOException $e){
                return false;
            }
        }

        public static function delete($id){
            try{
                $pdo = Database::getConnection();
                $stmt = $pdo->prepare("DELETE FROM usuario WHERE id = :id;");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();

                return true;

            }catch (PDOException $e){
                return false;
            }
        }
        }

    

?>

