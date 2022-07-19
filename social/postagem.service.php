<?php 

    class PostagemService {

         private $conexao;
         private $postagem;

         

         public function __construct(Conexao $conexao, Postagem $postagem) {
                $this->conexao = $conexao->conectar();
                $this->postagem = $postagem;   
         }


            public function postar() {
               
               $query = 'insert into postagem(descricao, id_usuario)VALUES(:descricao, :id_usuario)';
               $stmt = $this->conexao->prepare($query);
               $stmt->bindValue(':descricao', $this->postagem->__get('descricao'));
               $stmt->bindValue(':id_usuario', $this->postagem->__get('id_usuario'));
               $stmt->execute();
            
            }  

           

         

    }     


?>