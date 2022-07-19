<?php 

  session_start();
  
  if (!isset($_SESSION['id'])) {
       header('Location: index.php');
   }

  $acao = 'recuperar_mensagens';
  require '../../social/controller.php';

  

  // echo "<pre>";
  // print_r($array_mensagens);
  // echo "</pre>";

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>

        <nav class="navbar navbar-dark bg-dark">
          <a href="controller.php?acao=deslogar" style="color: white;">Sair</a>
          <a href="todos_os_usuarios.php" style="color: white;">Todos os Usuários</a>
        
        </nav>

        <? foreach ($array_mensagens as $key => $msg) { ?>
        	
        	<div style="width: 50%; margin-left: 12em; height: 1em;">
               <div class="container">
                 
                 
                 <? if ($_SESSION['id'] == $msg->id_que_envia) { ?>
                 	  <h7 style="float: right; border-radius: 10px; background-color: lightskyblue;"><?= $msg->descricao ?></h7>
                 <? } else { ?>
                      <h7 style="border-radius: 10px; background-color: lightgray;"><?= $msg->descricao ?></h7>
                 <? } ?>
                  
                 

                 
               </div> 
            </div>
            <br>

        <? } ?> 


        <form method="POST" action="controller.php?acao=mensagem">
        	<textarea style="margin-left: 12em; margin-top: 2em; width: 50%; height: 6em;" name="descricao"></textarea>
        	<input type="hidden" name="id_que_envia" value="<?= $_SESSION['id'] ?>">
        	<input type="hidden" name="id_que_recebe" value="<?= $_GET['user'] ?>">
            <br>
	        <button class="btn btn-dark" style="margin-left: 50em;">Enviar</button>
        </form>	    

	    

	</body>
</html>