<?php

    if($actorflag == 1 && $movieflag == 0){
        $persons = $tmdb->searchPerson($byactor);
        $movies = null;
    }   

    if($actorflag == 1 && $movieflag == 1){
        $persons = $tmdb->searchPerson($byactor);        
        $movies = $tmdb->searchMovie($byactor);
    }   

    if($actorflag == 0 && $movieflag == 1){
        $persons = null;
        $movies = $tmdb->searchMovie($byactor);
    }    

    //var_dump($movies);
    echo '  <div id="results">
            <div><button id="goback" onclick="goBack()">Back</button></div>';

    if($persons != null){
        echo    '<div class="panel-body-list">
                    <h1>Select actor</h1>
                    <ul>';
    }                
    foreach($persons as $person){
        echo '<li><a href="index.php?personid='. 
            $person->getID() .'">'. $person->getName() .'</a></li>';
    }

    echo '          </ul>
                </div>';

    if($movies != null){
        echo    '<div class="panel-body-list">
                    <h1>Select Movie</h1>
                    <ul>';
    }                
            
    foreach($movies as $movie){
        echo '<li><a href="index.php?movieid='. 
            $movie->getID() .'">'. $movie->getTitle() .'</a></li>';
    }

    echo '          </ul>
                </div>

            </div>';
?>