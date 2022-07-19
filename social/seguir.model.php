<?php 

     class Seguir {

          private $id_logado;
          private $id_seguido;

          public function __get($atributo) {

              return $this->$atributo;     	   
          }

          public function __set($atributo, $valor) {

              $this->$atributo = $valor;     	   
          }

     }

?>