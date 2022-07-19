<?php 

    class MensagemService {

         private $conexao;
         private $mensagem;

         

         public function __construct(Conexao $conexao, Mensagem $mensagem) {
                $this->conexao = $conexao->conectar();
                $this->mensagem = $mensagem;   
         }


            public function enviar_mensagem() {
               
               $query = 'insert into mensagem(id_que_envia, id_que_recebe, descricao)VALUES(:id_que_envia, :id_que_recebe, :descricao)';
               
               $stmt = $this->conexao->prepare($query);
               
               $stmt->bindValue(':id_que_envia', $this->mensagem->__get('id_que_envia'));
               
               $stmt->bindValue(':id_que_recebe', $this->mensagem->__get('id_que_recebe'));
               
               $stmt->bindValue(':descricao', $this->mensagem->__get('descricao'));
               $stmt->execute();

               
               
               
            
           
            }  

            public function recuperar_mensagens() {
               
               $query = 'select id_que_envia, id_que_recebe, email, descricao FROM mensagem as m LEFT JOIN usuario as u on (m.id_que_envia = u.id) WHERE id_que_envia = :id_que_envia AND id_que_recebe = :id_que_recebe or id_que_envia = :id_que_recebe AND id_que_recebe = :id_que_envia';
               $stmt = $this->conexao->prepare($query);
               $stmt->bindValue(':id_que_envia', $this->mensagem->__get('id_que_envia'));
               $stmt->bindValue(':id_que_recebe', $this->mensagem->__get('id_que_recebe'));
               $stmt->execute();
               return $stmt->fetchAll(PDO::FETCH_OBJ);
            
           
            } 

            public function recuperar_ultima_mensagem() {
               
     $query = 'select max(id) as id from mensagem where id_que_envia = :id_que_envia and id_que_recebe = :id_que_recebe';
               $stmt = $this->conexao->prepare($query);
               $stmt->bindValue(':id_que_envia', $this->mensagem->__get('id_que_envia'));
               $stmt->bindValue(':id_que_recebe', $this->mensagem->__get('id_que_recebe'));
               $stmt->execute();
               return $stmt->fetchAll(PDO::FETCH_OBJ);
            
           
            } 

            public function recuperar_descricao() {
               
     $query = 'select descricao from mensagem where id = :id';
               $stmt = $this->conexao->prepare($query);
               $stmt->bindValue(':id', $this->mensagem->__get('id'));
               $stmt->execute();
               return $stmt->fetchAll(PDO::FETCH_OBJ);
            
           
            } 
               


               }

           

         

     


?>