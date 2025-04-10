<?php	
    session_start();
    
    define ('SITE_URL', "http://localhost/Project/");
    define ('SITE_PATH', __DIR__ . DIRECTORY_SEPARATOR);
    define ('APP_TITLE', "برنامه");

    define ('MYSQL_SERVER', 'localhost');
    define ('MYSQL_DATABASE', 'cms');
    define ('MYSQL_USERNAME', 'mahdiyar');
    define ('MYSQL_PASSWORD', 'Ijnhr1384');

    foreach (glob('lib/*.php') as $LibFile){
        include_once ($LibFile);
    }

    //CreateTable(); 
    //InitializeUser();