<?php 

   session_start();

   if (!isset($_SESSION['id'])) {
   	   header('Location: index.php');
   }

   $acao = 'recuperar_usuario'; 
   

   require '../../social/controller.php';

  /* echo "<pre>";
   print_r($array);
   echo "</pre>";

   echo "<pre>";
   print_r($array2);
   echo "</pre>";
  */
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	


   </head>
	
	<body>

         <nav class="navbar navbar-dark bg-dark">
          <a href="controller.php?acao=deslogar" style="color: white;">Sair</a>
          <a href="tela.php" style="color: white;">Tela principal</a>
        
        </nav>

        
        
        
        
        <? foreach ($array as $key => $user) { ?>
            
             

            <?php 
               
               

               $seguicao = new Seguir();
               $seguicao->__set('id_logado', $_SESSION['id']);
               $seguicao->__set('id_seguido', $user->id);
               
               $conexao = new Conexao();

               $seguirService = new SeguirService($conexao, $seguicao);
               $resultado = $seguirService->recuperar_seguicao();

            
            ?>
            
             

            <? if ($user->id != $_SESSION['id']) { ?>
               
               <form method="POST" action="controller.php?acao=seguir" align='center'>
               <hr style="width: 80%;">
               <a href="conversa.php?user=<?=$user->id?>">Chamar para conversar</a>
               <h4><?=$user->email?></h4>
               <input type="hidden" name="id_logado" value="<?= $_SESSION['id'] ?>">
               <input type="hidden" name="id_seguido" value="<?= $user->id ?>">
               
               <? if ($resultado) { ?>
                   <button class="btn btn-danger" name="ds_button">Deixar de seguir</button> 
               <? } else { ?>
                   <button class="btn btn-danger" name="s_button">Seguir</button>  
               <? } ?>
               
               </form> 

            <? } ?>

            
            
            
        <? } ?>


	</body>
</html>