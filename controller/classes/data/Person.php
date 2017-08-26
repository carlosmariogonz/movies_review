<?php

class Person{

    //------------------------------------------------------------------------------
    // Class Constants
    //------------------------------------------------------------------------------

    const MEDIA_TYPE_PERSON = 'person';

    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    private $_data;

    /**
     *  Construct Class
     *
     *  @param array $data An array with the data of the Person
     */
    public function __construct($data) {
        $this->_data = $data;
    }

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /** 
     *  Get the Person's name
     *
     *  @return string
     */
    public function getName() {
        return $this->_data['name'];
    }

    /** 
     *  Get the Person's id
     *
     *  @return int
     */
    public function getID() {
        return $this->_data['id'];
    }


    /**
     *  Get the Person's MovieRoles
     *
     *  @return MovieRole[]
     */
    public function getMovieRoles() {
        $movieRoles = array();

        foreach($this->_data['movie_credits']['cast'] as $data){
            $movieRoles[] = new MovieRole($data, $this->getID());
        }

        return $movieRoles;
    }

    public function  orderRoles($arrayRoles){
        function my_sort($a,$b)
        {
            if ($a->getMovieReleaseDate()==$b->getMovieReleaseDate()) return 0;
            return ($a->getMovieReleaseDate()>$b->getMovieReleaseDate())?-1:1;
        }

        usort($arrayRoles,"my_sort");
        return $arrayRoles;
    }


    /**
     *  Get Generic.<br>
     *  Get a item of the array, you should not get used to use this, better use specific get's.
     *
     *  @param string $item The item of the $data array you want
     *  @return array
     */
    public function get($item = ''){
        return (empty($item)) ? $this->_data : $this->_data[$item];
    }

    //------------------------------------------------------------------------------
    // Export
    //------------------------------------------------------------------------------

    /**
     *  Get the JSON representation of the Episode
     *
     *  @return string
     */
    public function getJSON() {
        return json_encode($this->_data, JSON_PRETTY_PRINT);
    }


    /**
     * @return string
     */
    public function getMediaType(){
        return self::MEDIA_TYPE_PERSON;
    }
}
?>