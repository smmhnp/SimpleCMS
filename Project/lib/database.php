<?php

    global $db;
    //$db = new SQLite3 (DB_FILENAME);
    //$db = new mysqli (MYSQL_SERVER, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
    try {
        $db = new mysqli (MYSQL_SERVER, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE, 3308);
    } catch (mysqli_sql_exception $e) {
        die('Connection Error: ' . $e->getMessage());
    }

    $db -> set_charset("utf8");
    
    
/*
    function CreateTable (){
        global $db;

        $db -> query("
            CREATE TABLE IF NOT EXISTS option (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                option_name TEXT NOT NULL,
                option_value TEXT NOT NULL
            );
        ");

        $db -> query("
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT NOT NULL,
                password TEXT NOT NULL,
                firstname TEXT NOT NULL,
                lastname TEXT NOT NULL
            );
        ");
    }
*/