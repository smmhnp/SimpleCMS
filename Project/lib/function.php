<?php

    function SetUrl ($path = null) {
        if(!$path || $path == '/'){
            return SITE_URL;
        }
        return SITE_URL . $path;
    }

    function GetPageName() {
        $url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        $request = str_replace(SITE_URL, '', $url);

        $FindQuestionMark = strpos($request, '?');
        if($FindQuestionMark !== false) {
            $request = substr($request, 0, $FindQuestionMark);
        }
        
        return $request;
    }

    function is_valid_url($url) {
        if(empty($url)) {
            return false;
        }
        
        return (filter_var($url, FILTER_VALIDATE_URL) !== false);
    }
    function ReDirectory ($url){
        if(!is_valid_url($url)) {
            return;
        }

        header("Location: $url");
        die(); 
    }

    function CheckAuthenticationRequirement (){
        if (is_AuthenticationRequire() && !UserLoggenIn()){
                $login_url = SetUrl('login');
                ReDirectory($login_url);  
        }
    }


    function GetInput ($array, $data){
        if (!isset($array[$data])){
            return null;
        }
        
        return trim(htmlspecialchars(stripslashes($array[$data])));
    }