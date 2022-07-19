<?php 

     class Postagem {

          private $id;
          private $descricao;
          private $id_usuario;

          public function __get($atributo) {

              return $this->$atributo;     	   
          }

          public function __set($atributo, $valor) {

              $this->$atributo = $valor;     	   
          }

     }

?>