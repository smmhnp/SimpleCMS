<?php

    function AddOption($option_name, $option_value = null){
        global $db;
        if (!$option_name){
            return;
        }

        if(!$option_value){
            $option_value = '0';
        }

        if (!OptionExists($option_name)) {
            $db->query("
                INSERT INTO option (option_name, option_value) VALUES 
                ('$option_name', '$option_value');                                                               
            ");
        } else {
            $db->query("
                UPDATE option 
                SET option_value = '$option_value' 
                WHERE option_name = '$option_name';                                                               
            ");
        }
    } 

    function GetOption ($option_name, $full_row = false) {
        global $db;
        if (!$option_name) {
            return null;
        }

        $result = $db->query("
            SELECT *
            FROM option
            WHERE option_name = '$option_name';
        ");

        $row = $result->fetch_assoc();

        if ($row) {
            if ($full_row){
                return $row;
            } else {
                return $row['option_value'];
            }
        } else {
            return null;
        }
    }

    function OptionExists ($option_name){
        $row = GetOption($option_name, true);
        return isset ($row['id']);
    }

    function DeleteOption($option_name){
        global $db;
        if(!OptionExists($option_name)){
            return;
        }

        $db -> query("
            DELETE FROM option
            WHERE option_name = '$option_name';
        ");
    }