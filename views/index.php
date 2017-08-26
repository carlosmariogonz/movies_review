<?php
    // Desactivar toda notificación de error
    error_reporting(0);

    $apikey = "c94778cf35d2430c0af1511ee281efad";
    $byactor = array_key_exists('byactor', $_GET) ? $_GET['byactor'] : null;
    $personid = array_key_exists('personid', $_GET) ? $_GET['personid'] : null;
    $movieid = array_key_exists('movieid', $_GET) ? $_GET['movieid'] : null;
    $actorflag = array_key_exists('actor', $_GET) ? $_GET['actor'] : null;
    $movieflag = array_key_exists('movie', $_GET) ? $_GET['movie'] : null;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script>
            function goBack() {
                window.history.back()
            }
        </script>

        <style type="text/css">

    .navbar-toggle{
        display:none;
    }

    .navbar-default {
        background-color: #f8f8f8;
        border-color: #e7e7e7;
    }

        button#goback {
            height: 40px !important;
            width: 100px !important;
            border-radius: 6px;
            cursor: default;
            font-family: arial,sans-serif;
            font-size: 13px;
            font-weight: bold;
            margin: 11px 4px;
            min-width: 54px;
            padding: 0 16px;
            text-align: center;
            border: 1px solid #c6c6c6;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            color: #222;
            background-color: #f8f8f8;
            background-image: -webkit-linear-gradient(top,#f8f8f8,#f1f1f1);

            }

            .panel-body-list {
               width: 50%;
                float: left;
            }
            #mov_poster{
                float: left; 
                padding-right: 30px;
        padding-bottom: 20px;
            }
            form#searchbox {
                text-align: center;
                padding-top: 30px;
                padding-bottom: 30px;
            }
            input#byactor {
                width: 80%;
                height: 54px;
                border-radius: 6px;
                padding-left: 10px;
            }
            input.submit-button {
                height: 54px;
                width: 10%;
                border-radius: 6px;
               border-radius: 6px;
                cursor: default;
                font-family: arial,sans-serif;
                font-size: 13px;
                font-weight: bold;
                margin: 11px 4px;
                min-width: 54px;
                padding: 0 16px;
                text-align: center;
                border: 1px solid #c6c6c6;
                box-shadow: 0 1px 1px rgba(0,0,0,0.1);
                color: #222;
                background-color: #f8f8f8;
                background-image: -webkit-linear-gradient(top,#f8f8f8,#f1f1f1);

            }
            #serchbox{    
                text-align: center;    
                padding-bottom: 25px;
            }

            body {
                background-color: #B1B1B1;
        font-size:12px !important;
            }

            #main-container {
                min-height: 550px;
                border-bottom-left-radius: 8px;
                border-bottom-right-radius: 8px;
                padding-top: 60px;
            }

            #page-title {
                margin-top: 0px;
            }

            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
                float: left;
            }

            td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 6px !important;
            }

            th{
                border: 1px solid #dddddd;
                height: 50px;
                text-align: center;
                padding: 6px !important;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }

        div#trailer {
            float: left;
        width: 40px;
            padding-left: 0px;
            padding-top: 0px;
        }

            #logo_img {
                vertical-align: middle;
                width: 40%;
                height: 40%;
                text-align: center;
            }

            div#logo {  
                align-items: center;
                text-align: center;
            padding-top: 8%;
            }
        </style>

        <title>TMDB</title>

        <!-- Bootstrap CSS  -->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Inline CSS -->

    </head>
    <body>
        
        <!-- NavBar -->

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">TMDB: Search Movie Engine by Actor</a>
                </div>
                
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                    </ul>
                </div>
            </nav>

            <!-- Container -->

            <div id="main-container" class="container">
                <div id="logo">
                    <a href="index.php"><img id="logo_img" src="./images/logo.jpg"></a>
                 </div>       
                   <form action="index.php" id="searchbox"  method="GET">
                        <input name='byactor' class='border-radius: 6px;' id='byactor' />
                        <input class="submit-button" type="submit" value="Go" /> 
                        <div id='options'>                        
                            <input type="checkbox" name="actor" value="1" checked /> Search by Actor<br>
                            <input type="checkbox" name="movie" value="1"n/> Search by Movie<br>
                         </div>  
                   </form> 

            <?php

            include("../tmdb-api.php");
            $tmdb = new TMDB();

                if($byactor !== null){
                      include './movies/searchPerson.php';  
                }
                if($personid !== null){
                      include './movies/searchMoviesByPerson.php';  
                }
                if($movieid !== null){
                      include './movies/searchMovieInfo.php';  
                }

            ?>    

        </div>
    </div>
    </body>
</html>

<!-- Bootstrap JS -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>