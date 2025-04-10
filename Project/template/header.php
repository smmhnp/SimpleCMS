<!DOCTYPE html>
<html lang="fa">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php
            if (!function_exists('GetTitile')) {
                function GetTitile(){
                    return "APP_TITLE";
                }
            }
        ?>

        <title><?php echo GetTitile(); ?></title>

        <!--Bootstarp-->
        <link rel="stylesheet" href="<?php echo SITE_URL;  ?>includes/bootstrap/css/bootstrap-rtl-theme.css">
        <link rel="stylesheet" href="<?php echo SITE_URL;  ?>includes/bootstrap/css/bootstrap-rtl.css">

        <!--Additional css-->
        <link rel="stylesheet" href="<?php echo SITE_URL;  ?>styles.css">


    </head>
    <body>
        <!--Navigation Bar-->
        <?php include_once ('nav.php'); ?>

        <!--Container-->
        <div class="container">