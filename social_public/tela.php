<?php 

   session_start();

   if (!isset($_SESSION['id'])) {
       header('Location: index.php');
   }

   $acao = 'recuperar_postagens';

   require '../../social/controller.php';
  
  // echo "<pre>"; 
  // print_r($array_de_postagens);
  // echo "</pre>"; 

            
  
          //  echo "<pre>"; 
          //  print_r($array_notificacoes);
          //  echo "</pre>"; 
              
            //  if (isset($ultmen)) {
              //    echo "<pre>"; 
               //   print_r($ultmen);
                //  echo "</pre>";  
             // } 
              



?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    
    <body>

                <!-- As a link -->
        <nav class="navbar navbar-dark bg-dark">
          <a href="controller.php?acao=deslogar" style="color: white;">Sair</a>
          <a href="todos_os_usuarios.php" style="color: white;">Todos os Usuários</a>
          <button class="btn btn-light">notificações</button> 
        </nav>
         
        <div style="position: absolute;">
            
        <? foreach ($array_notificacoes as $key => $not) { ?>
            
            
            <form method="POST" action="controller.php?acao=tratar_not">
                
                <input type="hidden" name="id_notificacao" value="<?= $not->id ?>">
                <input type="hidden" name="id_que_envia_not" value="<?= $not->id_que_envia ?>">

                <button class="btn btn-warning" style="border: red solid 1px; margin-left: 66.34em; height: 5em; margin-bottom: 0em; width: 18em;">
           
                    <h6><?= $not->email ?></h6> 

                    <?php 
                       
                         $mensagem = new Mensagem();
                         $mensagem->__set('id_que_envia', $not->id_que_envia);
                         $mensagem->__set('id_que_recebe', $not->id_que_recebe);
                        
                         $conexao = new Conexao();

                         $mensagemService = new MensagemService($conexao, $mensagem);   
                         $ultmen = $mensagemService->recuperar_ultima_mensagem();

                      //   echo "<pre>"; 
                      //   print_r($ultmen);
                      //   echo "</pre>";

                         foreach ($ultmen as $key => $ult) {
                            $ult = $ult->id;                                            
                         }
                         
                         $mensagem = new Mensagem();
                         $mensagem->__set('id', $ult);                       
                         $conexao = new Conexao();

                         $mensagemService = new MensagemService($conexao, $mensagem);  
                         $ultdesc = $mensagemService->recuperar_descricao();
                    
                         foreach ($ultdesc as $key => $ud) {
                            $desc = $ud->descricao;                                            
                         }

                       

                         ?> 

                         <h7><?= $desc ?></h7>  

                </button>

            </form>

            
                    
                

        <? } ?>

        </div>
        
        
        
        
        
        <br>

        <br>
        <br>
        
        <form method="POST" action="controller.php?acao=postar">
            
            <textarea class="form-control" name="postagem" style="width: 70%; margin-left: 1em; position: absolute;"></textarea>
            <input type="hidden" name="id_usuario" value="<?= $_SESSION['id'] ?>">
            <br>
            <button class="btn btn-dark" style="margin-top: 3em; margin-left: 1em; position: absolute;">Postar</button>
        
        </form>
            
        
           <br>
           <br>
           <br>
           <br>
        <? foreach ($array_de_postagens as $key => $posts) { ?>
           
           <? if ($posts->descricao != '') { ?>
                  
            <div style="width: 50%; margin-left: 12em; height: 6em; background-color: whitesmoke;">
               <div class="container">
                 
                 <h4><?= $posts->email ?></h4>
                 <h7><?= $posts->descricao ?></h7>
                 
               </div> 
           </div>
           <br>
           <br>

           <? } ?>

           
        <? } ?>
   

    </body>
</html>