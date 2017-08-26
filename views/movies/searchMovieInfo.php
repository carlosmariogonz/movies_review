<?php
    $movie = $tmdb->getMovie($movieid);

    //var_dump($movie);
    echo '  <div id="results">
            <h1>'.$movie->getTitle().'</h1>
                <div><button id="goback" onclick="goBack()"> Back</button></div>
                <div class="panel-body">
                <div id="mov_poster">
                    <image src="http://image.tmdb.org/t/p/w185/'.$movie->get('poster_path').'"> 
                </div>    
                    <div id="trailer">    
                        <iframe width="265" height="278" src="https://www.youtube.com/embed/'.$movie->getTrailer().'">
                        </iframe>   
                     </div>   

                    <table>
                        <tr>
                            <th>Field</th>
                            <th>Info</th>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td>'.$movie->getTitle().'</td>
                        </tr>
                        <tr>
                            <td>Overview</td>
                            <td>'.$movie->get('overview').'</td>
                        </tr>
                        <tr>
                            <td>Original Language</td>
                            <td>'.$movie->get('original_language').'</td>
                        </tr>
                        <tr>
                            <td>Original Title</td>
                            <td>'.$movie->get('original_title').'</td>
                        </tr>
                        <tr>
                            <td>Rating</td>
                            <td>'.$movie->get('vote_average').'</td>
                        </tr>
                    </table> 
                </div>
            </div>';
?>