<?php 

     class Mensagem {

          private $id;
          private $descricao;
          private $id_que_envia;
          private $id_que_recebe;

          public function __get($atributo) {

              return $this->$atributo;     	   
          }

          public function __set($atributo, $valor) {

              $this->$atributo = $valor;     	   
          }

     }

?>