<?php 

    class SeguirService {

         private $seguir;
         private $conexao;

         
         public function __construct(Conexao $conexao, Seguir $seguir) {
                $this->conexao = $conexao->conectar();
                $this->seguir = $seguir;   
         }


            public function recuperar_seguicao() {
               
        $query = 'select * from seguir where id_logado = :id_logado and id_seguido = :id_seguido';
               $stmt = $this->conexao->prepare($query);
               $stmt->bindValue(':id_logado', $this->seguir->__get('id_logado'));
               $stmt->bindValue(':id_seguido', $this->seguir->__get('id_seguido'));
               $stmt->execute();
               return $stmt->fetchAll(PDO::FETCH_OBJ);
            } 

            public function seguir() {
               
               $query = 'insert into seguir(id_logado, id_seguido)VALUES(:id_logado, :id_seguido)';
               $stmt = $this->conexao->prepare($query);
               $stmt->bindValue(':id_logado', $this->seguir->__get('id_logado'));
               $stmt->bindValue(':id_seguido', $this->seguir->__get('id_seguido'));
               $stmt->execute();
            
            }  

            public function deixar_de_seguir() {
               
            $query = 'delete from seguir where id_logado = :id_logado and id_seguido = :id_seguido';
               $stmt = $this->conexao->prepare($query);
               $stmt->bindValue(':id_logado', $this->seguir->__get('id_logado'));
               $stmt->bindValue(':id_seguido', $this->seguir->__get('id_seguido'));
               $stmt->execute();
            
            } 

            public function recuperar_postagens() {
               
            $query = 'select p.id, id_logado, id_seguido, descricao, email from seguir as s left join postagem as p on (s.id_seguido = p.id_usuario) left join usuario as u on (u.id = s.id_seguido) where id_logado = :id_logado order by id desc';
            
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_logado', $this->seguir->__get('id_logado'));
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            
            }  

    }     


?>