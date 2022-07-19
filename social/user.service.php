<?php 

    class UserService {

         private $conexao;
         private $user;

         

         public function __construct(Conexao $conexao, User $user) {
                $this->conexao = $conexao->conectar();
                $this->user = $user;   
         }


            public function efetuar_cadastro() {
               
               $query = 'insert into usuario(email, senha)VALUES(:email, :senha)';
               $stmt = $this->conexao->prepare($query);
               $stmt->bindValue(':email', $this->user->__get('email'));
               $stmt->bindValue(':senha', $this->user->__get('senha'));
               $stmt->execute();
            
            }  


            public function verificar_usuario() {
               
               $query = 'select * from usuario where email = :email and senha = :senha';
               $stmt = $this->conexao->prepare($query);
               $stmt->bindValue(':email', $this->user->__get('email'));
               $stmt->bindValue(':senha', $this->user->__get('senha'));
               $stmt->execute();
               return $stmt->fetchAll(PDO::FETCH_OBJ);
               
            } 

            public function recuperar_usuarios() {
               
               $query = 'select * from usuario';
               $stmt = $this->conexao->prepare($query);
               $stmt->execute();
               return $stmt->fetchAll(PDO::FETCH_OBJ);
               
            } 

    }     


?>