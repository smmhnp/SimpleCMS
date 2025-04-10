<?php

    function UserCount (){
        global $db;
        $result = $db -> query("
            SELECT *
            FROM users
        ");

        return $result -> num_rows;
    }

    function GetUser ($username) {
        global $db;
        if (!$username) {
            return null;
        }

        $result = $db -> query("
            SELECT *
            FROM users
            WHERE username = '$username'
        ");

        $row = $result -> fetch_assoc();
        return $row;
    }
/*
    function InitializeUser (){
        global $db;
        $defulte_pw = sha1('Ijnhr1384');
        if (UserCount () == 0){
            $db -> query("
                INSERT INTO users (username, password, firstname, lastname) VALUES
                ('smmhnp', '$defulte_pw', 'mahdiyar', 'nematpour');
            ");
        }
    }
*/
    function UserExists ($username){
        $user = GetUser($username);
        return isset($user['id']);
    }

    function AddUser ($userdata){
        global $db;
        $username = $userdata['username'];
        if (!$username){
            return;
        }

        $password = sha1($userdata['password']);
        $firstname = $userdata['firstname'];
        $lastname = $userdata['lastname'];

        if (!UserExists($username)){
            $db -> query("
                INSERT INRO users (username, password, firstname, lastname)
                VALUES ('$username', '$password', 'firstname', 'lastname');                
            ");
        } else {
            UpdateUser($userdata);
        }
    }


    function UpdateUser ($userdata){
        global $db;
        $username = $userdata['username'];
        if (!$username){
            return;
        }

        $password = sha1($userdata['password']);
        $firstname = $userdata['firstname'];
        $lastname = $userdata['lastname'];

        if(UserExists($username)){
            $db -> query("
                UPDATE users
                SET password = '$password',
                    firstname = '$firstname',
                    lastname = '$lastname'
                WHERE username = '$username';
            ");
        }
    }

    function DeleteUser ($username){
        global $db;
        if (!UserExists($username)){
            return;
        }

        $db -> query("
            DELETE FROM users
            WHERE username = '$username';
        ");
    }