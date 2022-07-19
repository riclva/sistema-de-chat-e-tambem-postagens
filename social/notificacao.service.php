<?php 

    class NotificacaoService {

         private $conexao;
         private $notificacao;

         

         public function __construct(Conexao $conexao, Notificacao $notificacao) {
                $this->conexao = $conexao->conectar();
                $this->notificacao = $notificacao;   
         }


            public function verificar_notificacoes() {
               
              $query = 'select * from notificacao where id_que_envia = :id_que_envia and id_que_recebe = :id_que_recebe';
                 $stmt = $this->conexao->prepare($query);
                 $stmt->bindValue(':id_que_envia', $this->notificacao->__get('id_que_envia'));
                 $stmt->bindValue(':id_que_recebe', $this->notificacao->__get('id_que_recebe'));
                 $stmt->execute();
                 return $stmt->fetchAll(PDO::FETCH_OBJ);

            } 

            public function inserir_notificacao() {
               
      $query = 'insert into notificacao(id_que_envia, id_que_recebe)VALUES(:id_que_envia, :id_que_recebe)';
              $stmt = $this->conexao->prepare($query);
              $stmt->bindValue(':id_que_recebe', $this->notificacao->__get('id_que_recebe'));
              $stmt->bindValue(':id_que_envia', $this->notificacao->__get('id_que_envia'));
              $stmt->execute();
            } 

              
              public function recuperar_notificacoes() {
               
$query = 'select n.id, id_que_envia, id_que_recebe, email from notificacao as n left join usuario as u on (n.id_que_envia = u.id) where id_que_recebe = :id_que_recebe';
              $stmt = $this->conexao->prepare($query);
              $stmt->bindValue(':id_que_recebe', $this->notificacao->__get('id_que_recebe'));
              $stmt->execute();
              return $stmt->fetchAll(PDO::FETCH_OBJ);
            } 

    

            public function remover_notificacao() {
               
                   $query = 'delete from notificacao where id = :id';
                   $stmt = $this->conexao->prepare($query);
                   $stmt->bindValue(':id', $this->notificacao->__get('id'));
                   $stmt->execute();

            } 
           

         

    }     


?>