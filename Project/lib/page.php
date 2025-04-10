<?php

    function RenderPage (){
        include_once('template/header.php');

        if (function_exists('ProccessInput')){
            ProccessInput();
        }
        
        ShowNotic();

        if(function_exists('GetContent')){
            GetContent();
        }

        include_once('template/footer.php');
    }

    function LoadPage (){
        $page = GetPageName(); 

        if (empty($page)){
            $page = 'home';
        }

        if (UserLoggenIn() && $page == 'loign'){
            ReDirectory(SetUrl());
        }

        $page_file = "template/module/$page.php";

        if(file_exists($page_file)){
            require_once ($page_file);
            CheckAuthenticationRequirement ();

        } else if (PageExistsBySlug($page)){
            global $CurrentPage;
            $CurrentPage = GetPageBySlug($page);

            if (!$CurrentPage['hidden']){
                require_once ("template/module/PageLoader.php"); 
            } else {
                Notic('آدرس وارد شده صحیح نیست!', 'error');
                require_once ("template/module/home.php");
            }
                       
        } else {
            Notic('آدرس وارد شده صحیح نیست!', 'error');
            require_once ("template/module/home.php");
        }   
        
        RenderPage();
    }
    
    $messages = array();

    function Notic ($message = null, $type = 'error'){
        if(!$message){
            return;
        }

        global $messages;
        $messages[] = array(
            'message' => $message,
            'type' => $type,
        );
    }

    function ShowNotic (){
          global $messages;
          if(empty($messages)){
            return;
        }

        foreach ($messages as $item){
            $message = $item['message'];
            $type = $item['type'];

            if ($type == 'error'){
                $type = 'danger';
            }

            ?>
                <div class="alert alert-<?php echo $type; ?> alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true" >&times;</span>
                    </button>
                    <?php echo $message; ?>
                </div>
            <?php
        }
    }

    function is_AuthenticationRequire (){
        if (function_exists('AuthenticationRequire')){
            return AuthenticationRequire();
        }
        return false;
    }