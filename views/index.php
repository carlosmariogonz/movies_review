<?php
    $apikey = "c94778cf35d2430c0af1511ee281efad";
    $byactor = array_key_exists('byactor', $_GET) ? $_GET['byactor'] : null;
    $personid = array_key_exists('personid', $_GET) ? $_GET['personid'] : null;
    $movieid = array_key_exists('movieid', $_GET) ? $_GET['movieid'] : null;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style type="text/css">
            #mov_poster{
                float: left; 
                padding-right: 30px;
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
            }
            input.submit-button {
                height: 54px;
                width: 10%;
                border-radius: 6px;
            }
            #serchbox{    
                text-align: center;    
                padding-bottom: 25px;
            }

            body {
                background-color: #B1B1B1;
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
                    <a class="navbar-brand" href="#">TMDB</a>
                </div>
                
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                    </ul>
                </div>
            </nav>

            <!-- Container -->

            <div id="main-container" class="container">
                   <form action="index.php" id="searchbox"  method="GET">
                        <input name='byactor' class='border-radius: 6px;' id='byactor' />
                        <input class="submit-button" type="submit" value="Submit" />
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