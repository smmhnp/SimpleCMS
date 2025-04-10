<?php

    define ('SESSION_EXPIRATION', 3600);
    $CurrentUser = null;
    $CurrentUserID = null;

    function GetCurrentUser() {
        global $CurrentUser;
        return $CurrentUser;
    }
    
    function GetCurrentUserID() {
        global $CurrentUserID;
        return $CurrentUserID;
    }

    function UserLoggenIn() {
        global $CurrentUserID;
        if ($CurrentUserID){
            return true;
        }
        return false;
    }

    function ClearUserSession() {  
        unset($_SESSION['last_access']);
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['password']);
    }

    function CheckPreviousLogin() {
        global $CurrentUser;
        global $CurrentUserID;

        $LastAccess = 0;
        if(isset($_SESSION['last_access'])) {
            $LastAccess = $_SESSION['last_access'];
        }

        $expired = (time() - $LastAccess) > SESSION_EXPIRATION;
        if($expired) {
            ClearUserSession();
            return;
        }

        $username = $_SESSION['username'];
        $user = GetUser($username);
        if($user) {
            $UserID = $_SESSION['user_id'];
            if($UserID != $user['id']){
                ClearUserSession();
                return;
            }

            $password = $_SESSION['password'];
            if ($password != $user['password']){
                ClearUserSession();
                return;
            }

            $CurrentUser = $user;
            $CurrentUserID = $user['id'];
        }
    }

    function UserLogout() {
        global $CurrentUser;
        global $CurrentUserID;

        $CurrentUser = null;
        $CurrentUserID = null;

        ClearUserSession();
    }

    function UserLogin($username, $password) {
        global $CurrentUser;
        global $CurrentUserID;
 
        UserLogout();
        
        $user = GetUser($username);
        if(!$user){
            return;
        }
        
        if (sha1($password) != $user['password']){
            return;
        }

        global $current_user;
        global $current_user_id;
        
        $CurrentUser = $user;
        $CurrentUserID = $user['id'];
        

        $_SESSION['last_access'] = time();
        $_SESSION['user_id'] = $CurrentUserID;
        $_SESSION['username'] = $user['username'];
        $_SESSION['password']= $user['password'];
    }