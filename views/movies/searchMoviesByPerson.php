<?php
    $person = $tmdb->getPerson($personid);

    echo '  <div>

            <h1>Select Film to view more information</h1>
            <button id="goback" onclick="goBack()"> Back</button>

                <div class="panel-body">
                    <ul>';

    $roles = $person->getMovieRoles();
    $roles = $person->orderRoles($roles);

    foreach($roles as $rol){

        //var_dump($rol);
       echo '<li><a href="index.php?movieid='. 
            $rol->get('id') .'">'. $rol->get('title') .' ('.$rol->get('release_date').')'.'</a></li>';


    }
    echo '          </ul>
                </div>
            </div>';
?>