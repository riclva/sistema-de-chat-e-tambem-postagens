<?php 

      require '../../social/conexao.php';
      require '../../social/user.model.php';
      require '../../social/user.service.php';
      require '../../social/postagem.model.php';
      require '../../social/postagem.service.php';
      require '../../social/seguir.model.php';
      require '../../social/seguir.service.php';
      require '../../social/mensagem.model.php';
      require '../../social/mensagem.service.php';
      require '../../social/notificacao.model.php';
      require '../../social/notificacao.service.php';

      $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

      if ($acao == 'cadastrar') {
            $user = new User();
            $user->__set('email', $_POST['email']);
            $user->__set('senha', $_POST['senha']);

            $conexao = new Conexao();
            
            $userService = new UserService($conexao, $user);
            $userService->efetuar_cadastro();
            header('Location: index.php');
      } else if ($acao == 'logar') {
            
            session_start();

            $usuario_id = null; 

            $user = new User();
            $user->__set('email', $_POST['email']);
            $user->__set('senha', $_POST['senha']);

            $conexao = new Conexao();
            
            $userService = new UserService($conexao, $user);
            
            $usuario_autenticado = $userService->verificar_usuario();
            
            

            if ($usuario_autenticado) {
                  
                  foreach ($usuario_autenticado as $key => $user) {
                       $_SESSION['id'] = $user->id;
                  }

                  $seguir1 = new Seguir();
                  $seguir1->__set('id_logado', $_SESSION['id']);
                  $seguir1->__set('id_seguido', $_SESSION['id']);
            
                  $conexao1 = new Conexao();

                  $seguirService1 = new SeguirService($conexao1, $seguir1);
                  $result = $seguirService1->recuperar_seguicao();  

                  if ($result == false) {
                      
                      $seguir = new Seguir();
                      $seguir->__set('id_logado', $_SESSION['id']);
                      $seguir->__set('id_seguido', $_SESSION['id']);
            
                      $conexao = new Conexao();

                      $seguirService = new SeguirService($conexao, $seguir);
                      $seguirService->seguir();

                  }

                   


                 // $_SESSION['autenticado'] = 'SIM';
                  header('Location: tela.php');
            } else {
               //   $_SESSION['autenticado'] = 'NAO';
                  header('Location: index.php');
                  
            }
            
            

      } else if ($acao == 'recuperar_usuario') {
            $user = new User();
            $conexao = new Conexao();

            $userService = new UserService($conexao, $user);
            $array = $userService->recuperar_usuarios();

            


            $seguir = new Seguir();
            $seguir->__set('id_logado', $_SESSION['id']);
            $conexao = new Conexao();
  
            $seguirService = new SeguirService($conexao, $seguir);
            $array2 = $seguirService->recuperar_seguicao();


      } else if ($acao == 'postar') {
            $postagem = new Postagem();
            $postagem->__set('descricao', $_POST['postagem']);
            $postagem->__set('id_usuario', $_POST['id_usuario']);

            $conexao = new Conexao();

            $postagemService = new PostagemService($conexao, $postagem);
            $postagemService->postar();
            header('Location: tela.php');
      } else if ($acao == 'seguir') {
            session_start();

            if (isset($_POST['s_button'])) {
                  $seguir = new Seguir();
                  $seguir->__set('id_logado', $_SESSION['id']);
                  $seguir->__set('id_seguido', $_POST['id_seguido']);
                  
                  $conexao = new Conexao();

                  $seguirService = new SeguirService($conexao, $seguir);
                  $seguirService->seguir(); 

                  header('Location: todos_os_usuarios.php');

            } else if (isset($_POST['ds_button'])) {
                  $seguir = new Seguir();
                  $seguir->__set('id_logado', $_SESSION['id']);
                  $seguir->__set('id_seguido', $_POST['id_seguido']);
                  
                  $conexao = new Conexao();

                  $seguirService = new SeguirService($conexao, $seguir);
                  $seguirService->deixar_de_seguir(); 

                  header('Location: todos_os_usuarios.php');
            }

            
      } else if ($acao == 'recuperar_postagens') {
          //  session_start();

            $seguir = new Seguir();
            $seguir->__set('id_logado', $_SESSION['id']);

            $conexao = new Conexao();
            $seguirService = new SeguirService($conexao, $seguir);
            $array_de_postagens = $seguirService->recuperar_postagens(); 

            $notificacao = new Notificacao();
            $notificacao->__set('id_que_recebe', $_SESSION['id']);

            $conexao = new Conexao();
            $notificacaoService = new NotificacaoService($conexao, $notificacao);
            $array_notificacoes = $notificacaoService->recuperar_notificacoes();
            
            foreach ($array_notificacoes as $key => $not) {
               $que_envia = $not->id_que_envia;
            }

            $que_envia;

            if (isset($que_envia)) {
               $mensagem = new Mensagem();
                  $mensagem->__set('id_que_envia', $que_envia);
                  $mensagem->__set('id_que_recebe', $_SESSION['id']);
                  $conexao = new Conexao();
                  $mensagemService = new MensagemService($conexao, $mensagem);
                  $ultmen = $mensagemService->recuperar_ultima_mensagem();   
            }

            
             
              



      } else if ($acao == 'deslogar') {
            session_start();

            $seguir = new Seguir();
            $seguir->__set('id_logado', $_SESSION['id']);
            $seguir->__set('id_seguido', $_SESSION['id']);
            
            $conexao = new Conexao();

            $seguirService = new SeguirService($conexao, $seguir);
            $seguirService->deixar_de_seguir();
            
            session_destroy();
            header('Location: index.php');

      } else if ($acao == 'ver_seguicao') {
            echo "Chegamos aqui";

      } else if ($acao == 'mensagem') {
             $mensagem = new Mensagem();
             $mensagem->__set('descricao', $_POST['descricao']);
             $mensagem->__set('id_que_envia', $_POST['id_que_envia']);
             $mensagem->__set('id_que_recebe', $_POST['id_que_recebe']);
            
             $conexao = new Conexao();

             $mensagemService = new MensagemService($conexao, $mensagem);
             $mensagemService->enviar_mensagem();

             $notificacao = new Notificacao();
             $notificacao->__set('id_que_envia', $_POST['id_que_envia']);
             $notificacao->__set('id_que_recebe', $_POST['id_que_recebe']);
             
             $conexao = new Conexao();
             $notificacaoService = new NotificacaoService($conexao, $notificacao);
             $res = $notificacaoService->verificar_notificacoes();

             if ($res == false) {
                
                $notificacao = new Notificacao();
                $notificacao->__set('id_que_recebe', $_POST['id_que_recebe']);
                $notificacao->__set('id_que_envia', $_POST['id_que_envia']);
                $conexao = new Conexao();
                $notificacaoService = new NotificacaoService($conexao, $notificacao);   
                $notificacaoService->inserir_notificacao();

             }

             header('Location: conversa.php?user=' . $_POST['id_que_recebe']);

      } else if ($acao == 'recuperar_mensagens') {
             
             $mensagem = new Mensagem();
             $mensagem->__set('id_que_envia', $_SESSION['id']);
             $mensagem->__set('id_que_recebe', $_GET['user']);
            
             $conexao = new Conexao();

             $mensagemService = new MensagemService($conexao, $mensagem); 
             $array_mensagens = $mensagemService->recuperar_mensagens();
      } else if ($acao == 'tratar_not') {
        
             $notificacao = new Notificacao();
             $notificacao->__set('id', $_POST['id_notificacao']);
             $conexao = new Conexao();
             $notificacaoService = new NotificacaoService($conexao, $notificacao);
             $notificacaoService->remover_notificacao();

             
             header('Location: conversa.php?user=' . $_POST['id_que_envia_not']);
          
      }


      
  
?>